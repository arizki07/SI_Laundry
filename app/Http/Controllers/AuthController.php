<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login', [
            'judul' => 'Login'
        ]);
    }

    public function postLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                "status" => false,
                "message" => $validator->errors(),
            ]);
        }

        $remember = $request->has('remember');
        if (Auth::attempt($request->only(["username", "password"]), $remember)) {
            $user = Auth::user();

            if ($user->status == 0) {
                Auth::logout();
                return response()->json([
                    "status" => false,
                    "message" => ["Your account is not active"],
                ]);
            }

            return response()->json([
                "status" => true,
                "redirect" => url("dashboard"),
            ]);
        } else {
            return response()->json([
                "status" => false,
                "message" => ["Invalid Credentials"],
            ]);
        }
    }

    public function logout()
    {
        Session::flush();
        Auth::logout();

        return redirect('/');
    }
}
