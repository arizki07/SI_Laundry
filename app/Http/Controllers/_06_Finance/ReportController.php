<?php

namespace App\Http\Controllers\_06_Finance;

use Carbon\Carbon;
use App\Models\SalesModel;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\PengeluaranModel;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('products._02_Penjualan.finance.report', [
            'judul' => 'Report',
            'active' => 'Report',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $start = Carbon::parse($request->tanggal_mulai)->startOfDay();
        $end = Carbon::parse($request->tanggal_sampai)->endOfDay();

        $jumlahPemasukan = SalesModel::whereBetween('created_at', [$start, $end])->where('status_pembayaran', 'lunas')->count();
        $totalPemasukan = SalesModel::whereBetween('created_at', [$start, $end])->where('status_pembayaran', 'lunas')->sum('total_harga');

        $jumlahPengeluaran = PengeluaranModel::whereBetween('tanggal_pengeluaran', [$start, $end])->where('status', 1)->count();
        $totalPengeluaran = PengeluaranModel::whereBetween('tanggal_pengeluaran', [$start, $end])->where('status', 1)->sum('jumlah');

        $keuntungan = max($totalPemasukan - $totalPengeluaran, 0);
        $kerugian = max($totalPengeluaran - $totalPemasukan, 0);
        $totalAkhir = $totalPemasukan - $totalPengeluaran;

        return response()->json([
            'jumlahPemasukan' => $jumlahPemasukan,
            'totalPemasukan' => number_format($totalPemasukan, 0, ',', '.'),
            'jumlahPengeluaran' => $jumlahPengeluaran,
            'totalPengeluaran' => number_format($totalPengeluaran, 0, ',', '.'),
            'keuntungan' => number_format($keuntungan, 0, ',', '.'),
            'kerugian' => number_format($kerugian, 0, ',', '.'),
            'totalAkhir' => number_format($totalAkhir, 0, ',', '.'),
        ]);
    }

    public function detailPemasukan(Request $request)
    {
        $start = Carbon::parse($request->tanggal_mulai)->startOfDay();
        $end = Carbon::parse($request->tanggal_sampai)->endOfDay();
        $sales = SalesModel::whereBetween('created_at', [$start, $end])->where('status_pembayaran', 'lunas')->get();

        if ($sales->isEmpty()) {
            return '<div class="alert alert-warning text-center">Tidak ada data pemasukan ditemukan.</div>';
        }

        return view('products._02_Penjualan.finance.partials.report-in', compact('sales'));
    }

    public function detailPengeluaran(Request $request)
    {
        $start = Carbon::parse($request->tanggal_mulai)->startOfDay();
        $end = Carbon::parse($request->tanggal_sampai)->endOfDay();

        $pengeluarans = PengeluaranModel::whereBetween('tanggal_pengeluaran', [$start, $end])->where('status', 1)->get();

        if ($pengeluarans->isEmpty()) {
            return '<div class="alert alert-warning text-center">Tidak ada data pengeluaran ditemukan.</div>';
        }

        return view('products._02_Penjualan.finance.partials.report-out', compact('pengeluarans'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function exportPdf(Request $request)
    {
        $start = Carbon::parse($request->tanggal_mulai)->startOfDay();
        $end = Carbon::parse($request->tanggal_sampai)->endOfDay();

        $jumlahPemasukan = SalesModel::whereBetween('created_at', [$start, $end])->where('status_pembayaran', 'lunas')->count();
        $totalPemasukan = SalesModel::whereBetween('created_at', [$start, $end])->where('status_pembayaran', 'lunas')->sum('total_harga');

        $jumlahPengeluaran = PengeluaranModel::whereBetween('tanggal_pengeluaran', [$start, $end])->where('status', 1)->count();
        $totalPengeluaran = PengeluaranModel::whereBetween('tanggal_pengeluaran', [$start, $end])->where('status', 1)->sum('jumlah');

        $keuntungan = max($totalPemasukan - $totalPengeluaran, 0);
        $kerugian = max($totalPengeluaran - $totalPemasukan, 0);
        $totalAkhir = $totalPemasukan - $totalPengeluaran;

        $pdf = Pdf::loadView('products._02_Penjualan.finance.partials.report-export', compact(
            'jumlahPemasukan',
            'totalPemasukan',
            'jumlahPengeluaran',
            'totalPengeluaran',
            'keuntungan',
            'kerugian',
            'totalAkhir',
            'start',
            'end'
        ));

        $filename = 'laporan-keuangan_' . $start->format('dmy') . '_sampai_' . $end->format('dmy') . '.pdf';
        return $pdf->download($filename);
    }
}
