<?php

namespace App\Http\Controllers\_06_Finance;

use App\Http\Controllers\Controller;
use App\Models\PengeluaranModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengeluaranController extends Controller
{
    public function pengeluaran()
    {
        $pengeluarans = PengeluaranModel::all();
        return view('products._02_Penjualan.finance.pengeluaran', [
            'judul' => 'Pengeluaran',
            'active' => 'Pengeluaran',
            'pengeluarans' => $pengeluarans
        ]);
    }

    public function storePengeluaran(Request $request)
    {
        $request->validate([
            'no_pengeluaran' => 'required',
            'tanggal_pengeluaran' => 'required',
            'kategori_pengeluaran' => 'required',
            'metode_pembayaran' => 'required',
            'jumlah' => 'required',
            'bukti_pengeluaran' => 'nullable|mimes:jpg,png,jpeg|max:2048',
            'deskripsi' => 'required',
        ]);

        $fileName = null;
        if ($request->hasFile('bukti_pengeluaran')) {
            $file = $request->file('bukti_pengeluaran');
            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('finance/pengeluaran', $fileName, 'public');
        }

        PengeluaranModel::create([
            'no_pengeluaran' => $request->no_pengeluaran,
            'tanggal_pengeluaran' => $request->tanggal_pengeluaran,
            'kategori_pengeluaran' => $request->kategori_pengeluaran,
            'metode_pembayaran' => $request->metode_pembayaran,
            'jumlah' => $request->jumlah,
            'bukti_pengeluaran' => $fileName,
            'deskripsi' => $request->deskripsi,
            'status' => 'Pending',
            'created_by' => Auth::user()->username,
        ]);

        return redirect()->back()->with('success', 'Pengeluaran successfully created');
    }

    public function updatePengeluaran(Request $request, $id)
    {
        $request->validate([
            'no_pengeluaran' => 'required',
            'tanggal_pengeluaran' => 'required',
            'kategori_pengeluaran' => 'required',
            'metode_pembayaran' => 'required',
            'jumlah' => 'required',
            'bukti_pengeluaran' => 'nullable|mimes:jpg,png,jpeg|max:2048',
            'deskripsi' => 'required',
        ]);

        $pengeluaran = PengeluaranModel::findOrFail($id);

        $fileName = $pengeluaran->bukti_pengeluaran;
        if ($request->hasFile('bukti_pengeluaran')) {
            // Hapus bukti lama jika ada
            if ($fileName && \Storage::disk('public')->exists('finance/pengeluaran/' . $fileName)) {
                \Storage::disk('public')->delete('finance/pengeluaran/' . $fileName);
            }

            $file = $request->file('bukti_pengeluaran');
            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('finance/pengeluaran', $fileName, 'public');
        }

        $pengeluaran->update([
            'no_pengeluaran' => $request->no_pengeluaran,
            'tanggal_pengeluaran' => $request->tanggal_pengeluaran,
            'kategori_pengeluaran' => $request->kategori_pengeluaran,
            'metode_pembayaran' => $request->metode_pembayaran,
            'jumlah' => $request->jumlah,
            'bukti_pengeluaran' => $fileName,
            'deskripsi' => $request->deskripsi,
            'created_by' => Auth::user()->username,
        ]);

        return redirect()->back()->with('success', 'Pengeluaran successfully updated');
    }

    public function destroyPengeluaran($id)
    {
        $pengeluaran = PengeluaranModel::findOrFail($id);

        if ($pengeluaran->bukti_pengeluaran && \Storage::disk('public')->exists('finance/pengeluaran/' . $pengeluaran->bukti_pengeluaran)) {
            \Storage::disk('public')->delete('finance/pengeluaran/' . $pengeluaran->bukti_pengeluaran);
        }

        $pengeluaran->delete();

        return redirect()->back()->with('success', 'Pengeluaran successfully deleted');
    }
}
