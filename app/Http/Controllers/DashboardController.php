<?php

namespace App\Http\Controllers;

use App\Models\LogsModel;
use App\Models\SalesModel;
use App\Models\PengeluaranModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::check()) {
            $month = $request->input('month', date('m'));
            $year = $request->input('year', date('Y'));

            $sales = SalesModel::selectRaw('SUM(total_harga) as total_sales, DATE(created_at) as date')->whereYear('created_at', $year)->whereMonth('created_at', $month)->where('status_pembayaran', 'berhasil')->groupBy('date')->orderBy('date', 'ASC')->get();
            // dd($sales->toArray());

            $sales_data = $sales->map(function ($sale) {
                return [
                    'date' => $sale->date,
                    'total_sales' => (int) $sale->total_sales,
                ];
            });

            $pemasukanData = $this->SalesPemasukan($sales, $month, $year);
            $pengeluaranData = $this->Pengeluaran($month, $year);

            $transaction_status = SalesModel::selectRaw(
                '
                COUNT(CASE WHEN status_pembayaran = "pending" THEN 1 END) as pending,
                COUNT(CASE WHEN status_pembayaran = "gagal" THEN 1 END) as gagal,
                COUNT(CASE WHEN status_pembayaran = "berhasil" THEN 1 END) as berhasil,
                COUNT(CASE WHEN status_pembayaran = "refund" THEN 1 END) as refund
            ',
            )
                ->whereYear('created_at', $year)
                ->whereMonth('created_at', $month)
                ->first();

            $logs = LogsModel::orderBy('created_at', 'DESC')->limit(50)->get();
            $logs_config = LogsModel::orderBy('created_at', 'DESC')
                ->where('user_id', Auth::user()->id)
                ->where('path', 'postLogin')
                ->first();
            

            return view('products.dashboard', [
                'judul' => 'Dashboard',
                'active' => 'Home',
                'sales' => $sales_data,
                'logs' => $logs,
                'config' => $logs_config,
                'current_month' => $month,
                'current_year' => $year,
                'transaction_status' => $transaction_status,
                'pemasukan' => $pemasukanData['pemasukan'],
                'persentase' => $pemasukanData['persentase'],
                'pengeluaran' => $pengeluaranData['pengeluaran'],
                'chart_out' => $pengeluaranData['chart_out'],
                'persentase_out' => $pengeluaranData['persentase_out'],
                'pengeluaran_bulan_lalu' => $pengeluaranData['pengeluaran_bulan_lalu'],
                'sales_bulan_lalu' => $pemasukanData['sales_bulan_lalu'],
            ]);
        }

        return redirect('/')->withSuccess('Opps! You do not have access');
    }

    private function SalesPemasukan($sales, $month, $year)
    {
        $pemasukan = $sales->sum('total_sales');
        $bulan_lalu = Carbon::create($year, $month, 1)->subMonth();
        $sales_bulan_lalu = SalesModel::whereYear('created_at', $bulan_lalu->year)
            ->whereMonth('created_at', $bulan_lalu->month)
            ->where('status_pembayaran', 'berhasil')
            ->sum('total_harga');

        $persentase = ($sales_bulan_lalu > 0)
            ? (($pemasukan - $sales_bulan_lalu) / $sales_bulan_lalu) * 100
            : 0;

        return [
            'pemasukan' => $pemasukan,
            'persentase' => $persentase,
            'sales_bulan_lalu' => $sales_bulan_lalu,
        ];
    }

    private function Pengeluaran($month, $year)
    {
        $out = PengeluaranModel::selectRaw('SUM(jumlah) as total_pengeluaran, DATE(tanggal_pengeluaran) as date')->whereYear('tanggal_pengeluaran', $year)->whereMonth('tanggal_pengeluaran', $month)->where('status', 1)->groupBy('date')->orderBy('date', 'ASC')->get();

        $chart_out = $out->map(function ($cout) {
            return [
                'date' => $cout->date,
                'total_pengeluaran' => (int) $cout->total_pengeluaran,
            ];
        });

        $pengeluaran = $out->sum('total_pengeluaran');
        $bulan_lalu = Carbon::create($year, $month, 1)->subMonth();
        $pengeluaran_bulan_lalu = PengeluaranModel::whereYear('tanggal_pengeluaran', $bulan_lalu->year)
            ->whereMonth('tanggal_pengeluaran', $bulan_lalu->month)
            ->where('status', 1)
            ->sum('jumlah');

        $persentase_out = ($pengeluaran_bulan_lalu > 0)
            ? (($pengeluaran - $pengeluaran_bulan_lalu) / $pengeluaran_bulan_lalu) * 100
            : 0;

        return [
            'pengeluaran' => $pengeluaran,
            'persentase_out' => $persentase_out,
            'pengeluaran_bulan_lalu' => $pengeluaran_bulan_lalu,
            'chart_out' => $chart_out,
        ];
    }
}
