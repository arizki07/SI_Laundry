<?php

namespace App\Http\Controllers\_02_Penjualan;

use App\Http\Controllers\Controller;
use App\Models\CustomerModel;
use App\Models\ResiHistoryModel;
use App\Models\SalesItemModel;
use App\Models\SalesModel;
use Illuminate\Http\Request;

class ResiController extends Controller
{
    public function resi()
    {
        $resi = ResiHistoryModel::all();
        // dd($sales);
        return view('products._02_Penjualan.resi', [
            'judul' => 'Resi History',
            'active' => 'Resi',
            'resi' => $resi,
        ]);
    }

    public function updateResi(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string',
            'catatan' => 'nullable|string',
        ]);

        $resi = ResiHistoryModel::find($id);
        $resi->status = $request->input('status');
        $resi->catatan = $request->input('catatan');
        $resi->save();

        if ($request->input('status') === 'success') {
            $this->sendWhatsApp($resi);
        }

        return redirect()->back()->with('success', 'Resi history berhasil di update');
    }

    private function sendWhatsApp($resi)
    {
        $sales = SalesModel::where('no_resi', $resi->no_resi)->first();

        if ($sales) {
            $customer = CustomerModel::find($sales->customer_id);
            $salesItems = SalesItemModel::where('sale_id', $sales->id)->get();

            $itemsDetail = $salesItems->map(function ($item) {
                $totalItem = $item->qty * $item->harga_per_qty;
                return "- Produk ID: {$item->product_id}, Qty: {$item->qty}, Harga: Rp. " . number_format($item->harga_per_qty, 0, ',', '.') . ", Total: Rp. " . number_format($totalItem, 0, ',', '.');
            })->implode("\n");

            $message = "
Halo *{$customer->nama}*,

Terima kasih telah mempercayakan layanan cucian Anda kepada *Indah Laundry*. Pesanan Anda telah selesai diproses dan siap untuk dikirimkan/dijemput. Berikut adalah detail pesanan Anda:

$itemsDetail
--------------------------------
*Sub Total:* Rp. " . number_format($sales->total_harga, 0, ',', '.') . "

*Alamat:*
{$customer->alamat}

Apabila ada pertanyaan lebih lanjut atau Anda membutuhkan bantuan, jangan ragu untuk menghubungi kami melalui nomor ini. Kami senantiasa berkomitmen memberikan pelayanan terbaik untuk Anda.

Jangan lupa untuk memberikan ulasan tentang layanan kami di aplikasi atau media sosial, ya! Pendapat Anda sangat berarti bagi kami untuk terus berkembang.

Sekali lagi, terima kasih telah memilih Indah Laundry. Kami berharap dapat melayani Anda kembali di masa mendatang. 😊

Salam hangat,  
*Indah Laundry*
";

            $this->sendViaFonnte($customer->no_hp, $message);
        }
    }


    private function sendViaFonnte($to, $message)
    {
        $token = 'vTpsx9SNM6F4JTAwgcEy';
        $url = 'https://api.fonnte.com/send';

        $data = [
            'target' => $to,
            'message' => $message,
            'countryCode' => '62',
        ];

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => http_build_query($data),
            CURLOPT_HTTPHEADER => [
                "Authorization: $token",
            ],
        ]);

        $response = curl_exec($curl);
        curl_close($curl);

        if (!$response) {
            \Log::error("Failed to send WhatsApp message via Fonnte.");
        } else {
            \Log::info("WhatsApp message sent via Fonnte: $response");
        }
    }
}
