<?php

namespace App\Http\Controllers\_00_Datatables;

use App\Models\SalesModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class SalesList extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('sales')
                    ->join('customers', 'sales.customer_id', '=', 'customers.id')
                    ->select('sales.*', 'customers.nama as nama_customer', 'customers.no_cust')
                    ->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '
                        <button class="btn btn-sm btn-link align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown" aria-expanded="false">
                                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="1.5"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-dots-vertical"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /><path d="M12 19m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /><path d="M12 5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /></svg>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" style="">
                                    <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modal-view' . $row->id . '" data-id="' . $row->id . '">
                                        <svg style="margin-right:5px;" xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-eye"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" /></svg>
                                        View
                                    </a>
                                    <a href="' . route('edit.sales', $row->id) . '" class="dropdown-item" data-id="' . $row->id . '">
                                        <svg style="margin-right:5px;" xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="1.5"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-edit"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" /></svg>
                                        Edit
                                    </a>
                                    <a href="#" class="dropdown-item remove" data-bs-toggle="modal" data-bs-target="#modal-hapus" data-id="' . $row->id . '">
                                        <svg style="margin-right:5px;" xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon text-danger icon-tabler icons-tabler-outline icon-tabler-trash"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                                        Hapus
                                    </a>
                                </div>
                    ';
                    return $btn;
                })
                ->addColumn('status_pembayaran', function ($row) {
                    if ($row->status_pembayaran == 'Berhasil') {
                        return '<span class="badge bg-green-lt" style="font-size:11px"><i class="fa-solid fa-check me-2"></i>'.$row->status_pembayaran.'</span>';
                    } elseif ($row->status_pembayaran == 'Pending') {
                        return '<span class="badge bg-orange-lt" style="font-size:11px"><i class="fa-solid fa-clock me-2"></i>'.$row->status_pembayaran.'</span>';
                    } elseif ($row->status_pembayaran == 'Gagal') {
                        return '<span class="badge bg-danger-lt" style="font-size:11px"><i class="fa-solid fa-xmark me-2"></i>'.$row->status_pembayaran.'</span>';
                    } elseif ($row->status_pembayaran == 'Refund') {
                        return '<span class="badge bg-blue-lt" style="font-size:11px"><i class="fa-solid fa-rotate me-2"></i>'.$row->status_pembayaran.'</span>';
                    } 
                })
                ->rawColumns(['action', 'status_pembayaran'])
                ->make(true);
        }

        return view('products._02_Penjualan.sales');
    }
}
