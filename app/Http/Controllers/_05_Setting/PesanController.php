<?php

namespace App\Http\Controllers\_05_Setting;

use App\Http\Controllers\Controller;
use App\Models\PesanModel;
use Illuminate\Http\Request;

class PesanController extends Controller
{
    public function pesan()
    {
        $pesan = PesanModel::all();
        return view('products._05_Setting.pesan', [
            'judul' => 'Halaman Pesan',
            'active' => 'Pesan',
            'pesan' => $pesan
        ]);
    }

    public function destroy($id)
    {
        $product = PesanModel::findOrFail($id);
        $product->delete();
        return redirect()->back()->with('success', 'Pesan berhasil di hapus');
    }
}
