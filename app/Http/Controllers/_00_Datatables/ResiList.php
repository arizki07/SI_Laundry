<?php

namespace App\Http\Controllers\_00_Datatables;

use App\Models\SalesModel;
use Illuminate\Http\Request;
use App\Models\ResiHistoryModel;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class ResiList extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('resi_historys as r1')
                ->select('r1.*', 'customers.nama as nama_customer')
                ->join(DB::raw('(
                        SELECT no_resi, MAX(updated_at) as max_created
                        FROM resi_historys
                        GROUP BY no_resi
                    ) as r2'), function ($join) {
                    $join->on('r1.no_resi', '=', 'r2.no_resi')
                        ->on('r1.updated_at', '=', 'r2.max_created');
                })
                ->join('customers', 'r1.no_cust', '=', 'customers.no_cust')
                ->orderBy('r1.updated_at', 'desc')
                ->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $isLocked = $row->locked == 1;
                    $isSelesai = strtolower($row->status) === 'selesai';

                    $btn = '
    <button class="btn btn-sm btn-link align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="fa-solid fa-gear"></i>
    </button>
    <div class="dropdown-menu dropdown-menu-end">';

                    if (Auth::user()->role === 'admin') {
                        $btn .= '
            <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modal-edit' . $row->id . '" data-id="' . $row->id . '">
                <i class="fa fa-edit me-2"></i> Perbaharui Status
            </a>';

                        if ($isLocked) {
                            $btn .= '
                <a href="' . route('resi.unlock', $row->id) . '" class="dropdown-item text-danger" onclick="return confirm(\'Yakin ingin membuka kunci data ini?\')">
                    <i class="fa fa-unlock me-2"></i> Buka Kunci
                </a>';
                        }
                    } else {
                        if ($isSelesai && $isLocked) {
                            $btn .= '
                <span class="dropdown-item text-muted" style="cursor:not-allowed;">
                    <i class="fa fa-lock me-2"></i> Terkunci
                </span>';
                        } else {
                            $btn .= '
                <a href="#" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modal-edit' . $row->id . '" data-id="' . $row->id . '">
                    <i class="fa fa-edit me-2"></i> Perbaharui Status
                </a>';
                        }
                    }

                    $btn .= '</div>';
                    return $btn;
                })
                ->editColumn('created_at', function ($row) {
                    return Carbon::parse($row->created_at)->locale('id')->translatedFormat('d F Y H:i');
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}
