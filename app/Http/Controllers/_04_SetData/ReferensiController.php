<?php

namespace App\Http\Controllers\_04_SetData;

use App\Http\Controllers\Controller;
use App\Models\ReferensiModel;
use Illuminate\Http\Request;

class ReferensiController extends Controller
{
    public function referensi()
    {
        $referensi = ReferensiModel::all();
        return view('products._04_SetData.referensi', [
            'judul' => 'Referensi',
            'active' => 'Referensi',
            'referensi' => $referensi
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
        ]);

        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $kode = substr(str_shuffle($characters), 0, 10);

        $referensis = ReferensiModel::create([
            'nama' => $request->nama,
            'kode' => $kode,
        ]);

        if ($referensis) {
            return redirect()->back()->with('success', 'Referensi berhasil di tambahkan');
        } else {
            return redirect()->back()->with('error', 'Referensi berhasil gagal di tambahkan');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
        ]);

        $referensi = ReferensiModel::findOrFail($id);

        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $kode = substr(str_shuffle($characters), 0, 10);

        $referensi->update([
            'nama' => $request->nama,
            'kode' => $kode,
        ]);

        if ($referensi) {
            return redirect()->back()->with('success', 'Referensi berhasil di update');
        } else {
            return redirect()->back()->with('error', 'Referensi berhasil gagal di update');
        }
    }

    public function destroy($id)
    {
        $referensi = ReferensiModel::findOrFail($id);
        $referensi->delete();
        if ($referensi) {
            return redirect()->back()->with('success', 'Referensi berhasil di hapus');
        } else {
            return redirect()->back()->with('error', 'Referensi berhasil gagal di hapus');
        }
    }
}
