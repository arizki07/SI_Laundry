<?php

namespace App\Http\Controllers;

use App\Models\LogsModel;
use App\Models\SalesModel;
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
            ]);
        }

        return redirect('/')->withSuccess('Opps! You do not have access');
    }
}
