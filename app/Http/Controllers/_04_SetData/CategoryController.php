<?php

namespace App\Http\Controllers\_04_SetData;

use App\Http\Controllers\Controller;
use App\Models\CategoriesModel;
use App\Models\ReferensiModel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function Categories()
    {
        $ref = ReferensiModel::all();
        $cat = CategoriesModel::all();
        // dd($ref);
        return view('products._04_SetData.category', [
            'judul' => 'Categories',
            'active' => 'Kategori',
            'cat' => $cat,
            'ref' => $ref,
        ]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
            'kode' => 'required',
        ]);

        $cat = CategoriesModel::create([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'kode' => $request->kode,
            'created_at' => Carbon::now(),
        ]);

        if ($cat) {
            return redirect()->back()->with('success', 'Kategori berhasil ditambahkan!');
        } else {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menambahkan kategori.');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
            'kode' => 'required',
        ]);

        $cat = CategoriesModel::findOrFail($id);

        $update = $cat->update([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'kode' => $request->kode,
        ]);

        if ($update) {
            return redirect()->back()->with('success', 'Kategori berhasil diupdate!');
        } else {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat update kategori.');
        }
    }

    public function destroy($id)
    {
        $cat = CategoriesModel::findOrFail($id);
        $cat->delete();
        if ($cat) {
            return redirect()->back()->with('success', 'Kategori berhasil dihapus!');
        } else {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat hapus kategori.');
        }
    }
}
