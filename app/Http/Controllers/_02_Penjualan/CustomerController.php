<?php

namespace App\Http\Controllers\_02_Penjualan;

use App\Http\Controllers\Controller;
use App\Models\CustomerModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function customer()
    {
        $customer = CustomerModel::all();
        return view('products._02_Penjualan.customer', [
            'judul' => 'Customer',
            'active' => 'Customer',
            'customer' => $customer
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required',
            'no_hp' => 'required',
            'alamat' => 'required',
        ]);

        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $no_cust = 'CUST' . substr(str_shuffle($characters), 0, 10);
        $customer = CustomerModel::create([
            'no_cust' => $no_cust,
            'nama' => $request->nama,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'created_by' => Auth::user()->name
        ]);

        if ($customer) {
            return redirect()->back()->with('success', 'Customer berhasil di tambahkan');
        } else {
            return redirect()->back()->with('error', 'Customer gagal di tambahkan');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required',
            'no_hp' => 'required',
            'alamat' => 'required',
        ]);

        $customer = CustomerModel::findOrFail($id);

        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $no_cust = 'CUST' . substr(str_shuffle($characters), 0, 10);

        $customer->update([
            'no_cust' => $no_cust,
            'nama' => $request->nama,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'created_by' => Auth::user()->name
        ]);

        if ($customer) {
            return redirect()->back()->with('success', 'Customer berhasil di update');
        } else {
            return redirect()->back()->with('error', 'Customer gagal di update');
        }
    }

    public function destroy($id)
    {
        $customer = CustomerModel::findOrFail($id);
        $customer->delete();
        if ($customer) {
            return redirect()->back()->with('success', 'Customer berhasil di hapus');
        } else {
            return redirect()->back()->with('error', 'Customer gagal di hapus');
        }
    }
}
