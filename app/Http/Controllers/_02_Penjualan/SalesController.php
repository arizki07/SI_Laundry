<?php

namespace App\Http\Controllers\_02_Penjualan;

use App\Http\Controllers\Controller;
use App\Models\CustomerModel;
use App\Models\KontakModel;
use App\Models\ProductModel;
use App\Models\ResiHistoryModel;
use App\Models\SalesItemModel;
use App\Models\SalesModel;
use App\Models\StatusModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class SalesController extends Controller
{
    // PROSES MENAMPILKAN HALAMAN SALES
    public function sales()
    {
        $kontak = KontakModel::all();
        $sales = SalesModel::with(['customer', 'items.product'])->get();
        return view('products._02_Penjualan.sales', [
            'judul' => 'Sales',
            'active' => 'sales',
            'sales' => $sales,
            'kontak' => $kontak
        ]);
    }

    // PROSES MENAMPILKAN HALAMAN TAMBAH SALES
    public function create()
    {
        $cust = CustomerModel::all();
        $product = ProductModel::all();
        // dd($status);
        return view('products._02_Penjualan.sales_create', [
            'judul' => 'Tambah Sales',
            'active' => 'sales',
            'cust' => $cust,
            'product' => $product,
        ]);
    }

    // PROSES TAMBAH DATA SALES
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'products' => 'required|array',
            'products.*' => 'exists:products,id',
            'qty' => 'required|array',
            'qty.*' => 'numeric|min:0.1',
            'file_bukti' => 'nullable|file|mimes:jpg,png,pdf|max:2048',
            'status_pembayaran' => 'required|string',
            'metode_pembayaran' => 'required|string',
            'pembayaran' => 'nullable',
            'round_up' => 'nullable|array',
            'round_up.*' => 'boolean',
        ]);

        $noResi = 'RESI' . strtoupper(bin2hex(random_bytes(5)));
        $noInvoice = 'INVC' . strtoupper(bin2hex(random_bytes(5)));

        $fileName = null;
        if ($request->hasFile('file_bukti')) {
            $file = $request->file('file_bukti');
            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('sales/bukti', $fileName, 'public');
        }

        $customer = CustomerModel::findOrFail($validated['customer_id']);
        $noCust = $customer->no_cust;

        $sales = SalesModel::create([
            'customer_id' => $validated['customer_id'],
            'no_resi' => $noResi,
            'no_invoice' => $noInvoice,
            'total_harga' => 0,
            'status_pembayaran' => $validated['status_pembayaran'],
            'metode_pembayaran' => $validated['metode_pembayaran'],
            'file_bukti' => $fileName,
            'pembayaran' => ($validated['status_pembayaran'] === 'dp') ? $validated['pembayaran'] : null,
            'created_at' => now(),
        ]);

        $totalHarga = 0;

        foreach ($validated['products'] as $index => $productId) {
            $product = ProductModel::findOrFail($productId);
            $qty = $validated['qty'][$index];

            $roundUp = isset($validated['round_up'][$index]) && $validated['round_up'][$index];
            $qtyRounded = $roundUp ? ceil($qty) : floor($qty);

            $hargaPerQty = $product->harga;
            $total = $qtyRounded * $hargaPerQty;

            $sales->items()->create([
                'product_id' => $productId,
                'qty' => $qtyRounded,
                'harga_per_qty' => $hargaPerQty,
                'total' => $total,
            ]);

            $totalHarga += $total;
        }

        // Update total harga
        $sales->update(['total_harga' => $totalHarga]);

        // Cek jika pembayaran DP melebihi total harga
        if ($validated['status_pembayaran'] === 'dp' && $validated['pembayaran'] > $totalHarga) {
            return redirect()->back()->withErrors(['pembayaran' => 'DP tidak boleh lebih besar dari total harga.']);
        }

        // Update pembayaran hanya jika DP valid
        if ($validated['status_pembayaran'] === 'dp') {
            $sales->update(['pembayaran' => $validated['pembayaran']]);
        }

        ResiHistoryModel::create([
            'no_cust' => $noCust,
            'no_resi' => $noResi,
            'status' => $validated['status_pembayaran'],
            'catatan' => null,
            'foto_final' => null,
            'created_by' => Auth::user()->name,
        ]);

        // Kirim WhatsApp ke pelanggan
        $this->sendWhatsApp($sales);

        return redirect()->route('sales.index')->with('success', 'Sales berhasil dibuat');
    }

    /**
     * Mengirim pesan WhatsApp ke pelanggan menggunakan API Fonnte
     */
    private function sendWhatsApp($sales)
    {
        $customer = CustomerModel::find($sales->customer_id);
        $salesItems = SalesItemModel::where('sale_id', $sales->id)->get();

        if (!$customer || $salesItems->isEmpty()) {
            Log::error("WhatsApp gagal dikirim: Data customer atau sales item tidak ditemukan.");
            return;
        }

        // Buat detail item pesanan
        $itemsDetail = $salesItems->map(function ($item) {
            $totalItem = $item->qty * $item->harga_per_qty;
            return "- Produk ID: {$item->product_id}, Qty: {$item->qty}, Harga: Rp. " . number_format($item->harga_per_qty, 0, ',', '.');
        })->implode("\n");

        // Format pesan WhatsApp
        $message = "
Halo *{$customer->nama}*,

Terima kasih telah mempercayakan layanan cucian Anda kepada *Indah Laundry*. Silahkan Anda cek proses cucian anda dengan nomor resi *{$sales->no_resi}*. Berikut adalah detail pesanan Anda:

$itemsDetail
--------------------------------
*Total Harga:* Rp. " . number_format($sales->total_harga, 0, ',', '.') . "

*Alamat:*
{$customer->alamat}

Apabila ada pertanyaan lebih lanjut, silakan hubungi kami. Kami berkomitmen memberikan pelayanan terbaik untuk Anda.

Terima kasih telah memilih *Indah Laundry*! 😊

Salam hangat,  
*Indah Laundry*
";

        // Kirim pesan via API Fonnte
        $this->sendViaFonnte($customer->no_hp, $message);
    }

    /**
     * Mengirim pesan WhatsApp menggunakan API Fonnte
     */
    private function sendViaFonnte($to, $message)
    {
        $token = 'vTpsx9SNM6F4JTAwgcEy'; // Ganti dengan token Fonnte asli
        $url = 'https://api.fonnte.com/send';

        $data = [
            'target' => $to,
            'message' => $message,
            'countryCode' => '62', // Indonesia
        ];

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => http_build_query($data),
            CURLOPT_HTTPHEADER => [
                "Authorization: $token",
            ],
        ]);

        $response = curl_exec($curl);
        curl_close($curl);

        if (!$response) {
            Log::error("Gagal mengirim pesan WhatsApp via Fonnte.");
        } else {
            Log::info("Pesan WhatsApp berhasil dikirim: $response");
        }
    }


    // PROSES MENAMPILKAN HALAMAN EDIT SALES
    public function edit($id)
    {
        $sales = SalesModel::findOrFail($id);

        $customers = CustomerModel::all();
        $products = ProductModel::all();
        $statuses = StatusModel::all();
        return view('products._02_Penjualan.sales_edit', [
            'sales' => $sales,
            'customers' => $customers,
            'products' => $products,
            'statuses' => $statuses,
            'judul' => 'Edit Sales',
            'active' => 'Sales',
        ]);
    }

    // PROSES UPDATE SALES
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'products' => 'required|array',
            'products.*' => 'exists:products,id',
            'qty' => 'required|array',
            'qty.*' => 'numeric|min:0.1',
            'file_bukti' => 'nullable|file|mimes:jpg,png,pdf|max:2048',
            'status_pembayaran' => 'required|string',
            'metode_pembayaran' => 'required|string',
            'pembayaran' => 'nullable|numeric|min:0',
            'round_up' => 'nullable|array',
            'round_up.*' => 'boolean',
        ]);

        $sales = SalesModel::findOrFail($id);

        // Cek apakah ada file bukti baru
        $fileName = $sales->file_bukti;
        if ($request->hasFile('file_bukti')) {
            $file = $request->file('file_bukti');
            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('sales/bukti', $fileName, 'public');
        }

        // Hapus semua items lama sebelum update
        $sales->items()->delete();

        $totalHarga = 0;

        foreach ($validated['products'] as $index => $productId) {
            $product = ProductModel::findOrFail($productId);
            $qty = $validated['qty'][$index];

            // Cek apakah perlu pembulatan
            $roundUp = isset($validated['round_up'][$index]) && $validated['round_up'][$index];
            $qtyRounded = $roundUp ? ceil($qty) : floor($qty);

            $hargaPerQty = $product->harga;
            $total = $qtyRounded * $hargaPerQty;

            $sales->items()->create([
                'product_id' => $productId,
                'qty' => $qtyRounded,
                'harga_per_qty' => $hargaPerQty,
                'total' => $total,
            ]);

            $totalHarga += $total;
        }

        // Validasi DP tidak boleh lebih besar dari total harga
        if ($validated['status_pembayaran'] === 'dp' && isset($validated['pembayaran']) && $validated['pembayaran'] > $totalHarga) {
            return redirect()->back()->withErrors(['pembayaran' => 'DP tidak boleh lebih besar dari total harga.']);
        }

        // Update sales record
        $sales->update([
            'customer_id' => $validated['customer_id'],
            'status_pembayaran' => $validated['status_pembayaran'],
            'metode_pembayaran' => $validated['metode_pembayaran'],
            'file_bukti' => $fileName,
            'total_harga' => $totalHarga,
            'pembayaran' => ($validated['status_pembayaran'] === 'dp') ? $validated['pembayaran'] : null,
        ]);

        return redirect()->route('sales.index')->with('success', 'Sales berhasil diperbarui');
    }


    // PROSES HAPUS DATA SALES
    public function destroy($id)
    {
        $sales = SalesModel::findOrFail($id);

        if ($sales->file_bukti) {
            Storage::disk('public')->delete('sales/bukti/' . $sales->file_bukti);
        }

        $sales->items()->delete();

        $sales->delete();

        return redirect()->back()->with('success', 'Data penjualan dan item terkait berhasil dihapus.');
    }
}
