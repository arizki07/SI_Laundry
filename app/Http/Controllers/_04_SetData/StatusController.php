<?php

namespace App\Http\Controllers\_04_SetData;

use App\Http\Controllers\Controller;
use App\Models\ReferensiModel;
use App\Models\StatusModel;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    public function status()
    {
        $status = StatusModel::all();
        $referensi = ReferensiModel::all();
        return view('products._04_SetData.status', [
            'judul' => 'Status',
            'active' => 'Status',
            'referensi' => $referensi,
            'status' => $status,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'kode' => 'required',
            'deskripsi' => 'required'
        ]);

        $status = StatusModel::create([
            'nama' => $request->nama,
            'kode' => $request->kode,
            'deskripsi' => $request->deskripsi
        ]);

        if ($status) {
            return redirect()->back()->with('success', 'Status berhasil di tambahkan');
        } else {
            return redirect()->back()->with('success', 'Status berhasil gagal di tambahkan');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'kode' => 'required',
            'deskripsi' => 'required'
        ]);

        $status = StatusModel::findOrFail($id);
        $status->update([
            'nama' => $request->nama,
            'kode' => $request->kode,
            'deskripsi' => $request->deskripsi
        ]);

        if ($status) {
            return redirect()->back()->with('success', 'Status berhasil di update');
        } else {
            return redirect()->back()->with('success', 'Status berhasil gagal di update');
        }
    }

    public function destroy($id)
    {
        $status = StatusModel::findOrFail($id);
        $status->delete();
        if ($status) {
            return redirect()->back()->with('success', 'Status berhasil di hapus');
        } else {
            return redirect()->back()->with('success', 'Status berhasil gagal di hapus');
        }
    }
}
