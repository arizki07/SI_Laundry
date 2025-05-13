<?php

namespace App\Http\Controllers\_01_Produk;

use App\Http\Controllers\Controller;
use App\Models\CategoriesModel;
use App\Models\ProductModel;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function produk()
    {
        $categori = CategoriesModel::all();
        $products = ProductModel::all();
        // dd($categori);
        return view('products._01_Produk.produk', [
            'judul' => 'Produk',
            'active' => 'Product',
            'categori' => $categori,
            'products' => $products,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_kategori_layanan' => 'required',
            'category' => 'required',
            'nama_produk' => 'required',
            'harga' => 'required',
            'type' => 'nullable',
            'flag' => 'required',
            'foto_produk' => 'nullable|mimes:png,jpg,jpeg|max:2048',
            'deskripsi' => 'required',
        ]);

        if ($request->hasFile('foto_produk')) {
            $fotoProduk = $request->file('foto_produk');
            $fotoName = uniqid() . '.' . $fotoProduk->getClientOriginalExtension();
            $fotoProduk->storeAs('public/produk', $fotoName);
            $fotoPath = $fotoName;
        }

        $produk = ProductModel::create([
            'id_kategori_layanan' => $request->id_kategori_layanan,
            'category' => $request->category,
            'nama_produk' => $request->nama_produk,
            'harga' => $request->harga,
            'type' => $request->type,
            'flag' => $request->flag,
            'foto_produk' => $fotoPath,
            'deskripsi' => $request->deskripsi
        ]);

        if ($produk) {
            return redirect()->back()->with('success', 'Produk berhasil di tambahkan');
        } else {
            return redirect()->back()->with('error', 'Produk gagal di tambahkan');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_kategori_layanan' => 'required',
            'category' => 'required',
            'nama_produk' => 'required',
            'harga' => 'required',
            'type' => 'required',
            'flag' => 'required',
            'foto_produk' => 'nullable|mimes:png,jpg,jpeg|max:2048',
            'deskripsi' => 'required',
        ]);

        $product = ProductModel::findOrFail($id);

        if ($request->hasFile('foto_produk')) {
            if ($product->foto_produk && file_exists(storage_path('app/public/produk/' . $product->foto_produk))) {
                unlink(storage_path('app/public/produk/' . $product->foto_produk));
            }

            $fotoProduk = $request->file('foto_produk');
            $fotoName = uniqid() . '.' . $fotoProduk->getClientOriginalExtension();
            $fotoProduk->storeAs('public/produk', $fotoName);
            $fotoPath = $fotoName;
        } else {
            $fotoPath = $product->foto_produk;
        }

        $product->update([
            'id_kategori_layanan' => $request->id_kategori_layanan,
            'category' => $request->category,
            'nama_produk' => $request->nama_produk,
            'harga' => $request->harga,
            'type' => $request->type,
            'flag' => $request->flag,
            'foto_produk' => $fotoPath,
            'deskripsi' => $request->deskripsi
        ]);

        return redirect()->back()->with('success', 'Produk berhasil di update');
    }


    public function destroy($id)
    {
        $product = ProductModel::findOrFail($id);
        if ($product->foto_produk && file_exists(storage_path('app/public/produk/' . $product->foto_produk))) {
            unlink(storage_path('app/public/produk/' . $product->foto_produk)); // Delete the image
        }
        $product->delete();
        return redirect()->back()->with('success', 'Data produk berhasil di hapus');
    }
}
