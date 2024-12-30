<?php

namespace App\Http\Controllers\_01_Master;

use App\Http\Controllers\Controller;
use App\Models\CategoriesModel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function Categories()
    {
        $cat = CategoriesModel::all();
        return view('products._01_Master.category', [
            'judul' => 'Categories',
            'cat' => $cat,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
            'for' => 'required',
        ]);

        $cat = CategoriesModel::create([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'for' => $request->for,
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
            'for' => 'required',
        ]);

        $cat = CategoriesModel::findOrFail($id);

        $update = $cat->update([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'for' => $request->for,
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
