<?php

namespace App\Http\Controllers\_05_Setting;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function users()
    {
        $user = User::all();
        return view('products._05_Setting.users', [
            'judul' => 'Users',
            'active' => 'Users',
            'user' => $user
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required',
            'email' => 'required',
            'password' => 'required',
            'role' => 'required'
        ]);

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make('password'),
            'role' => $request->role,
        ]);

        if ($user) {
            return redirect()->back()->with('success', 'User berhasil di tambahkan');
        } else {
            return redirect()->back()->with('error', 'User berhasil gagal di tambahkan');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required',
            'email' => 'required',
            'password' => 'required',
            'role' => 'required'
        ]);

        $user = User::findOrFail($id);

        $user->update([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make('password'),
            'role' => $request->role,
        ]);

        if ($user) {
            return redirect()->back()->with('success', 'User berhasil di update');
        } else {
            return redirect()->back()->with('error', 'User berhasil gagal di update');
        }
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        if ($user) {
            return redirect()->back()->with('success', 'User berhasil di hapus');
        } else {
            return redirect()->back()->with('error', 'User berhasil gagal di hapus');
        }
    }
}
