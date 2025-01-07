<?php

namespace App\Http\Controllers\_05_Setting;

use App\Models\FaqsModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FaqsController extends Controller
{
    public function faqs()
    {
        $faqs = FaqsModel::all();
        return view('products._05_Setting.faqs', [
            'judul' => 'Faqs',
            'active' => 'faqs',
            'faqs' => $faqs
        ]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
        ]);

        $faqs = FaqsModel::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi
        ]);

        if ($faqs) {
            return redirect()->back()->with('success', 'Data faqs berhasil ditambahkan!');
        } else {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menambahkan data faqs.');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
        ]);

        $faqs = FaqsModel::findOrFail($id);

        $update = $faqs->update([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
        ]);

        if ($update) {
            return redirect()->back()->with('success', 'Data faqs berhasil diperbaharui!');
        } else {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat update data faqs.');
        }
    }

    public function destroy($id)
    {
        $faqs = FaqsModel::findOrFail($id);
        $faqs->delete();
        if ($faqs) {
            return redirect()->back()->with('success', 'Data faqs berhasil dihapus!');
        } else {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat hapus data faqs.');
        }
    }
}
