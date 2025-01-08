<?php

namespace App\Http\Controllers\_02_Penjualan;

use App\Models\RatingModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RatingController extends Controller
{
    public function index()
    {
        $rating = RatingModel::all();
        return view('products._02_Penjualan.rating', [
            'judul' => 'Rating',
            'active' => 'rating',
            'rating' => $rating,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'komentar' => 'required|string|max:500',
            'rating' => 'required|numeric|min:1|max:5',
            'status' => 'required',
            'no_hp_cust' => 'required|numeric|digits_between:10,15',
        ]);

        $rating = RatingModel::updateOrCreate(
            ['no_hp_cust' => $request->no_hp_cust],
            [
                'komentar' => $request->komentar,
                'rating' => $request->rating,
                'status' => $request->status,
            ],
        );

        if ($rating) {
            return redirect()->back()->with('success', 'Data rating berhasil ditambahkan atau diperbarui!');
        } else {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menambahkan atau memperbarui data rating.');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'komentar' => 'required|string|max:500',
            'rating' => 'required|numeric|min:1|max:5',
            'status' => 'required',
            'no_hp_cust' => 'required|numeric|digits_between:10,15',
        ]);

        $ratings = RatingModel::findOrFail($id);

        $update = $ratings->update([
            'komentar' => $request->komentar,
            'rating' => $request->rating,
            'status' => $request->status,
            'no_hp_cust' => $request->no_hp_cust,
        ]);

        if ($update) {
            return redirect()->back()->with('success', 'Data rating berhasil diperbaharui!');
        } else {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat update data rating.');
        }
    }

    public function destroy($id)
    {
        $rating = RatingModel::findOrFail($id);
        $rating->delete();
        if ($rating) {
            return redirect()->back()->with('success', 'Data rating berhasil dihapus!');
        } else {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat hapus data rating.');
        }
    }
}
