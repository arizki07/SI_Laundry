<?php

namespace App\Http\Controllers\_02_Penjualan;

use App\Http\Controllers\Controller;
use App\Models\ResiHistoryModel;
use App\Models\SalesModel;
use Illuminate\Http\Request;

class ResiController extends Controller
{
    public function resi()
    {
        $sales = SalesModel::join('customers', 'sales.customer_id', '=', 'customers.id')
            ->select('sales.*', 'customers.no_cust', 'customers.nama');

        return view('products._02_Penjualan.resi', [
            'judul' => 'Resi History',
            'active' => 'Resi',
            'sales' => $sales,
        ]);
    }

    public function updateResi(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:resi_historys,id',
            'status' => 'required|string',
            'catatan' => 'nullable|string',
        ]);

        $resi = ResiHistoryModel::find($request->input('id'));
        $resi->status = $request->input('status');
        $resi->catatan = $request->input('catatan');
        $resi->save();

        return response()->json(['message' => 'Data berhasil diperbarui'], 200);
    }
}
