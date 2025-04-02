<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\FaqsModel;
use App\Models\RatingModel;
use Illuminate\Http\Request;
use App\Models\ResiHistoryModel;
use Illuminate\Support\Facades\DB;

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

    public function checkResi(Request $request)
    {
        $resi = $request->input('resi');
        $data = DB::table('resi_historys as A')
                ->join('customers as B', 'A.no_cust', '=', 'B.no_cust')
                ->select('A.*', 'B.nama')
                ->where('A.no_resi', $resi)
                ->first();
                // dd($data);

        if ($data) {
            $formattedData = [
                'nama_cust' => $data->nama,
                'no_resi' => $data->no_resi,
                'no_cust' => $data->no_cust,
                'status' => $data->status,
                'updated_at' => Carbon::parse($data->updated_at)->translatedFormat('D, d M Y H:i') . ' WIB',
            ];
    
            return response()->json([
                'status' => 'success',
                'data' => $formattedData,
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Nomor resi tidak ditemukan!',
        ]);

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
        $testimoni = RatingModel::all();
        return view('landing.testimoni', ['title' => 'Testimoni Pelanggan', 'act' => 'testimoni', 'testimoni' => $testimoni]);
    }
}
