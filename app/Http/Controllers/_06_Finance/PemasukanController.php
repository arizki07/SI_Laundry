<?php

namespace App\Http\Controllers\_06_Finance;

use App\Models\SalesModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\KontakModel;

class PemasukanController extends Controller
{
    public function pemasukan()
    {
        $pemasukan = SalesModel::with(['customer', 'items.product'])->get();
        $kontak = KontakModel::first(); // ambil data kontak pertama

        return view('products._02_Penjualan.finance.pemasukan', [
            'judul' => 'Pemasukan Keuangan',
            'active' => 'pemasukan',
            'sales' => $pemasukan,
            'kontak' => $kontak
        ]);
    }
}
