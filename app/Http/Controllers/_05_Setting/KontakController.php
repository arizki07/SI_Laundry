<?php

namespace App\Http\Controllers\_05_Setting;

use App\Models\KontakModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class KontakController extends Controller
{
    public function index()
    {
        $kontak = KontakModel::orderBy('created_at', 'asc')->first();
        return view('products._05_Setting.kontak', [
            'judul' => 'Profile & Bantuan',
            'active' => 'kontak',
            'kontak' => $kontak,
        ]);
    }

    public function update(Request $request)
    {
        $kontak = KontakModel::orderBy('created_at', 'asc')->first();
        $request->validate([
            'head_first' => 'required|string|max:500',
            'head_two' => 'required|string|max:500',
            'logo' => $kontak ? 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048' : 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'alamat' => 'required|string|max:500',
            'deskripsi' => 'required|string|max:1000',
            'maps' => 'nullable|url',
            'no_hp' => 'required|numeric|digits_between:10,15',
            'email' => 'nullable|email|max:255',
            'instagram' => 'nullable|url|max:255',
            'facebook' => 'nullable|url|max:255',
            'twitter' => 'nullable|url|max:255',
            'youtube' => 'nullable|url|max:255',
        ]);

        if ($kontak) {
            if ($request->hasFile('logo')) {
                if ($kontak->logo) {
                    Storage::delete($kontak->logo);
                }
                $newLogo = $request->file('logo')->store('public/logo');
            } else {
                $newLogo = $kontak->logo;
            }
            $kontak->update([
                'head_first' => $request->head_first,
                'head_two' => $request->head_two,
                'logo' => $newLogo,
                'alamat' => $request->alamat,
                'deskripsi' => $request->deskripsi,
                'maps' => $request->maps,
                'no_hp' => $request->no_hp,
                'email' => $request->email,
                'instagram' => $request->instagram,
                'facebook' => $request->facebook,
                'twitter' => $request->twitter,
                'youtube' => $request->youtube,
            ]);

            return redirect()->back()->with('success', 'Kontak berhasil diupdate');
        } else {
            KontakModel::create([
                'head_first' => $request->head_first,
                'head_two' => $request->head_two,
                'logo' => $request->hasFile('logo') 
                ? $request->file('logo')->store('public/logo') 
                : null,
                'alamat' => $request->alamat,
                'deskripsi' => $request->deskripsi,
                'maps' => $request->maps,
                'no_hp' => $request->no_hp,
                'email' => $request->email,
                'instagram' => $request->instagram,
                'facebook' => $request->facebook,
                'twitter' => $request->twitter,
                'youtube' => $request->youtube,
            ]);

            return redirect()->back()->with('success', 'Kontak berhasil dibuat');
        }
    }
}
