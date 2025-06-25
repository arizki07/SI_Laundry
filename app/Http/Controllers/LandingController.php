<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\FaqsModel;
use App\Models\PesanModel;
use App\Models\SalesModel;
use App\Models\RatingModel;
use App\Models\ProductModel;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\ResiHistoryModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class LandingController extends Controller
{
    public function index()
    {
        return view('landing.index', ['title' => 'Laundry Instan dan Cepat', 'act' => 'home', 'testimoni' => RatingModel::all()]);
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
        // $data = DB::table('resi_historys as A')
        //         ->join('customers as B', 'A.no_cust', '=', 'B.no_cust')
        //         ->select('A.*', 'B.nama')
        //         ->where('A.no_resi', $resi)
        //         ->first();
        $data = DB::table('resi_historys as A')->join('customers as B', 'A.no_cust', '=', 'B.no_cust')->select('A.*', 'B.nama')->where('A.no_resi', $resi)->orderBy('A.updated_at', 'asc')->get();
        // dd($data);

        if ($data->isNotEmpty()) {
            $latest = $data->last();
            // $formattedData = [
            //     'nama_cust' => $data->nama,
            //     'no_resi' => $data->no_resi,
            //     'no_cust' => $data->no_cust,
            //     'status' => $data->status,
            //     'updated_at' => Carbon::parse($data->updated_at)->translatedFormat('D, d M Y H:i') . ' WIB',
            // ];
            $formattedData = [
                'nama_cust' => $latest->nama,
                'no_resi' => $latest->no_resi,
                'no_cust' => $latest->no_cust,
                'status' => $latest->status,
                'updated_at' => Carbon::parse($latest->updated_at)->translatedFormat('D, d M Y H:i') . ' WIB',
                'history' => $data->map(function ($item) {
                    return [
                        'status' => $item->status,
                        'catatan' => $item->catatan,
                        'created_at' => Carbon::parse($item->created_at)->translatedFormat('l, d M Y H:i'),
                    ];
                }),
            ];

            return response()->json([
                'status' => 'success',
                'data' => $formattedData,
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Nomor resi tidak ditemukan!',
            ]);
        }

        return view('landing.cek-resi', ['title' => 'Cek Nomor Resi', 'act' => 'resi']);
    }

    public function list()
    {
        $produk = ProductModel::where('flag', 1)->get();
        return view('landing.services', ['title' => 'Daftar Harga Laundry', 'act' => 'services', 'produk' => $produk]);
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

    public function post_rating(Request $request)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'message' => 'required|string|max:255',
            'resi' => [
                'required',
                'string',
                'max:30',
                Rule::exists('sales', 'no_resi'),
                Rule::unique('ratings', 'no_resi'),
            ],
        ], [
            'resi.exists' => 'Resi tidak ditemukan. Pastikan Anda memasukkan nomor resi yang valid.',
            'resi.unique' => 'Resi ini sudah pernah diberi rating.',
        ]);

        $cari = SalesModel::join('customers', 'sales.customer_id', '=', 'customers.id')
            ->where('sales.no_resi', $request->resi)
            ->select('customers.no_hp')->first();
        // dd($cari);

        $rating = new RatingModel();
        $rating->rating = $request->rating;
        $rating->komentar = $request->message;
        $rating->status = 1;
        $rating->no_hp_cust = $cari->no_hp ?? '0';
        $rating->no_resi = $request->resi;
        $rating->save();

        return redirect()->back()->with('success', 'Terima kasih atas testimoni Anda!');
    }

    public function send(Request $request)
    {
        $request->validate([
            'nama'    => 'required|string|max:255',
            'email'   => 'required|email',
            'subject' => 'required|string',
            'message' => 'required|string',
        ]);

        PesanModel::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
        ]);

        // Mail::send('emails.contact', ['data' => $data], function ($message) use ($data) {
        //     $message->to('webcrafser@gmail.com')
        //             ->subject('Pesan Baru dari Kontak: ' . $data['subject']);
        // });

        // Mail::send('emails.confirmation', ['data' => $data], function ($message) use ($data) {
        //     $message->to($data['email'])
        //             ->subject('Konfirmasi Pesan Anda: ' . $data['subject']);
        // });

        return back()->with('success', 'Pesan berhasil dikirim!');
    }
}
