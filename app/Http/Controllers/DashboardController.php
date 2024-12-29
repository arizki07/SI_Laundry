<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return view('products.dashboard');
        }

        return redirect('/')->withSuccess('Opps! You do not have access');
    }
}
