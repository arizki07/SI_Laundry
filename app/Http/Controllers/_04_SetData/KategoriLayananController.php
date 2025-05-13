<?php

namespace App\Http\Controllers\_04_SetData;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\KategoriLayananModel;

class KategoriLayananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = KategoriLayananModel::all();
        // dd($ref);
        return view('products._04_SetData.kategori_layanan', [
            'judul' => 'Kategori Layanan',
            'active' => 'kategori_layanan',
            'cat' => $data,
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
        $request->validate([
            'nama_kategori_layanan' => 'required|string|max:255',
            'type_durasi' => 'required|in:hari,jam',
            'durasi' => 'required|integer|min:1',
            'deskripsi' => 'required|string',
            'harga' => 'required|numeric|min:0',
            'flag' => 'required|boolean',
        ]);

        $cat = KategoriLayananModel::create([
            'nama_kategori_layanan' => $request->nama_kategori_layanan,
            'type_durasi' => $request->type_durasi,
            'durasi' => $request->durasi,
            'deskripsi' => $request->deskripsi,
            'harga' => $request->harga,
            'flag' => $request->flag,
        ]);

        if ($cat) {
            return redirect()->back()->with('success', 'Data  berhasil ditambahkan!');
        } else {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menambahkan data.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kategori_layanan' => 'required|string|max:255|unique:kategori_layanans,nama_kategori_layanan,' . $id,
            'type_durasi' => 'required|in:hari,jam',
            'durasi' => 'required|integer|min:1',
            'deskripsi' => 'required|string',
            'harga' => 'required|numeric|min:0',
            'flag' => 'required|boolean',
        ]);

        $cat = KategoriLayananModel::find($id);

        if (!$cat) {
            return redirect()->back()->with('error', 'Data tidak ditemukan.');
        }

        $cat->nama_kategori_layanan = $request->nama_kategori_layanan;
        $cat->type_durasi = $request->type_durasi;
        $cat->durasi = $request->durasi;
        $cat->deskripsi = $request->deskripsi;
        $cat->harga = $request->harga;
        $cat->flag = $request->flag;

        if ($cat->save()) {
            return redirect()->route('kategori-layanan.index')->with('success', 'Data berhasil diperbarui!');
        } else {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui data.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $cat = KategoriLayananModel::findOrFail($id);
        $cat->delete();
        if ($cat) {
            return redirect()->back()->with('success', 'Kategori berhasil dihapus!');
        } else {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat hapus kategori.');
        }
    }
}
