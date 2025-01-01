<?php

namespace App\Http\Controllers\_02_Penjualan;

use App\Http\Controllers\Controller;
use App\Models\CustomerModel;
use App\Models\ProductModel;
use App\Models\SalesModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SalesController extends Controller
{
    public function sales()
    {
        $sales = SalesModel::with(['customer', 'items.product'])->get();
        return view('products._02_Penjualan.sales', [
            'judul' => 'Sales',
            'active' => 'Sales',
            'sales' => $sales
        ]);
    }

    public function create()
    {
        $cust = CustomerModel::all();
        $product = ProductModel::all();
        return view('products._02_Penjualan.sales_create', [
            'judul' => 'Tambah Sales',
            'active' => 'Sales',
            'cust' => $cust,
            'product' => $product,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'products' => 'required|array',
            'products.*' => 'exists:products,id',
            'qty' => 'required|array',
            'qty.*' => 'integer|min:1',
            'file_bukti' => 'nullable|file|mimes:jpg,png,pdf|max:2048',
        ]);

        $noResi = 'RESI' . strtoupper(bin2hex(random_bytes(5)));
        $noInvoice = 'INVC' . strtoupper(bin2hex(random_bytes(5)));

        $fileName = null;
        if ($request->hasFile('file_bukti')) {
            $file = $request->file('file_bukti');
            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('sales/bukti', $fileName, 'public');
        }

        $sales = SalesModel::create([
            'customer_id' => $validated['customer_id'],
            'no_resi' => $noResi,
            'no_invoice' => $noInvoice,
            'total_harga' => 0,
            'status_pembayaran' => 'pending',
            'metode_pembayaran' => 'cash',
            'file_bukti' => $fileName,
        ]);

        $totalHarga = 0;

        foreach ($validated['products'] as $index => $productId) {
            $product = ProductModel::findOrFail($productId);
            $qty = $validated['qty'][$index];
            $hargaPerQty = $product->harga;
            $total = $qty * $hargaPerQty;

            $sales->items()->create([
                'product_id' => $productId,
                'qty' => $qty,
                'harga_per_qty' => $hargaPerQty,
                'total' => $total,
            ]);

            $totalHarga += $total;
        }

        $sales->update(['total_harga' => $totalHarga]);

        return redirect()->route('sales.index')->with('success', 'Sales berhasil dibuat');
    }

    public function edit($id)
    {
        $sales = SalesModel::findOrFail($id);

        $cust = CustomerModel::all();
        $product = ProductModel::all();

        return view('products._02_Penjualan.sales_edit', [
            'sales' => $sales,
            'cust' => $cust,
            'product' => $product,
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
            'qty.*' => 'integer|min:1',
            'file_bukti' => 'nullable|file|mimes:jpg,png,pdf|max:2048',
        ]);

        $sales = SalesModel::findOrFail($id);

        $fileName = $sales->file_bukti;
        if ($request->hasFile('file_bukti')) {
            $file = $request->file('file_bukti');
            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('sales/bukti', $fileName, 'public');
        }

        $sales->update([
            'customer_id' => $validated['customer_id'],
            'file_bukti' => $fileName,
        ]);

        $totalHarga = 0;
        foreach ($validated['products'] as $index => $productId) {
            $product = ProductModel::findOrFail($productId);
            $qty = $validated['qty'][$index];
            $hargaPerQty = $product->harga;
            $total = $qty * $hargaPerQty;

            $sales->items()->updateOrCreate(
                ['product_id' => $productId],
                ['qty' => $qty, 'harga_per_qty' => $hargaPerQty, 'total' => $total]
            );

            $totalHarga += $total;
        }

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
