<?php

namespace App\Http\Controllers\_05_Setting;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function users()
    {
        $user = User::paginate(4);
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
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'status' => 1,
        ]);

        if ($user) {
            return redirect()->back()->with('success', 'User berhasil di tambahkan');
        } else {
            return redirect()->back()->with('error', 'User berhasil gagal di tambahkan');
        }
    }

    public function update(Request $request, $id)
    {
        $update = $request->query('update');
        if ($update === 'pass') {
            $validated = $request->validate([
                'password_saat_ini' => 'required|string',
                'password_baru' => [
                    'required',
                    'string',
                    'min:8',
                    'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/',
                    'confirmed',
                ],
            ]);

            if (Hash::check($request->password_saat_ini, Auth::user()->password)) {
                if (Hash::check($request->password_baru, Auth::user()->password)) {
                    return back()->withErrors(['password_baru' => 'Password baru tidak boleh sama dengan password lama.']);
                }
                Auth::user()->update([
                    'password' => Hash::make($request->password_baru),
                ]);

                return redirect()->back()->with('success', 'Password berhasil diperbarui');
            } else {
                return back()->withErrors(['password_saat_ini' => 'Password saat ini salah']);
            }
        }

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

    public function updateStatus(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['success' => false, 'message' => 'User tidak ditemukan.'], 404);
        }

        $user->status = $request->status;
        $user->save();

        return response()->json(['success' => true, 'message' => 'Status berhasil diperbarui.']);
    }


    public function destroy($id)
    {
        $user = User::find($id);

        if ($user) {
            $user->delete();
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Data tidak ditemukan.'], 404);
    }
}
