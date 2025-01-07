<?php

namespace App\Http\Controllers;

use App\Models\FaqsModel;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        return view('landing.index', ['title' => 'Laundry Instan dan Cepat', 'act' => 'home']);
    }

    public function contact()
    {
        return view('landing.contact', ['title' => 'Hubungi Kami', 'act' => 'contact']);
    }

    public function about()
    {
        return view('landing.about', ['title' => 'Tentang Kami', 'act' => 'about']);
    }

    public function resi()
    {
        return view('landing.cek-resi', ['title' => 'Cek Nomor Resi', 'act' => 'resi']);
    }

    public function list()
    {
        return view('landing.services', ['title' => 'Daftar Harga Laundry', 'act' => 'services']);
    }

    public function bantuan()
    {
        $faqs = FaqsModel::all();
        return view('landing.bantuan', ['title' => 'Perlu Bantuan', 'act' => 'bantuan', 'faqs' => $faqs]);
    }

    public function syarat_ketentuan()
    {
        return view('landing.syarat-ketentuan', ['title' => 'Syarat dan Ketentuan', 'act' => 'syarat']);
    }

    public function testimoni()
    {
        return view('landing.testimoni', ['title' => 'Testimoni Pelanggan', 'act' => 'testimoni']);
    }
}
