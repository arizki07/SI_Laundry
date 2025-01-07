<?php

namespace App\Http\Controllers\_02_Penjualan;

use App\Http\Controllers\Controller;
use App\Models\CustomerModel;
use App\Models\ProductModel;
use App\Models\ResiHistoryModel;
use App\Models\SalesModel;
use App\Models\StatusModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SalesController extends Controller
{
    public function sales()
    {
        $sales = SalesModel::with(['customer', 'items.product'])->get();
        return view('products._02_Penjualan.sales', [
            'judul' => 'Sales',
            'active' => 'sales',
            'sales' => $sales
        ]);
    }

    public function create()
    {
        $cust = CustomerModel::all();
        $product = ProductModel::all();
        $status = StatusModel::where('kode', 'sales')->get();
        // dd($status);
        return view('products._02_Penjualan.sales_create', [
            'judul' => 'Tambah Sales',
            'active' => 'sales',
            'cust' => $cust,
            'product' => $product,
            'status' => $status,
        ]);
    }

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
        ]);

        $totalHarga = 0;

        foreach ($validated['products'] as $index => $productId) {
            $product = ProductModel::findOrFail($productId);
            $qty = $validated['qty'][$index];
            $qtyRounded = round($qty * 2) / 2;
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

        $sales->update(['total_harga' => $totalHarga]);

        ResiHistoryModel::create([
            'no_cust' => $noCust,
            'no_resi' => $noResi,
            'status' => $validated['status_pembayaran'],
            'catatan' => null,
            'foto_final' => null,
            'created_by' => Auth::user()->name,
        ]);

        return redirect()->route('sales.index')->with('success', 'Sales berhasil dibuat');
    }


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
        ]);

        $sales = SalesModel::findOrFail($id);

        // Update file if provided
        $fileName = $sales->file_bukti;
        if ($request->hasFile('file_bukti')) {
            $file = $request->file('file_bukti');
            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('sales/bukti', $fileName, 'public');
        }

        // Update sales data
        $sales->update([
            'customer_id' => $validated['customer_id'],
            'status_pembayaran' => $validated['status_pembayaran'],
            'metode_pembayaran' => $validated['metode_pembayaran'],
            'file_bukti' => $fileName,
        ]);

        // Delete existing items
        $sales->items()->delete();

        // Add new items
        $totalHarga = 0;
        foreach ($validated['products'] as $index => $productId) {
            $product = ProductModel::findOrFail($productId);
            $qty = $validated['qty'][$index];
            $qtyRounded = round($qty * 2) / 2;
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

        // Update total price
        $sales->update(['total_harga' => $totalHarga]);

        return redirect()->route('sales.index')->with('success', 'Sales berhasil diperbarui');
    }

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
