<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::controller(LandingController::class)->group(function () {
    Route::get('/', 'index')->name('landing.home');
    Route::get('hubungi-kami', 'contact')->name('landing.hubungi-kami');
    Route::get('tentang-kami', 'about')->name('landing.tentang-kami');
    Route::get('daftar-harga', 'list')->name('landing.daftar-harga');
    Route::get('cek-resi', 'resi')->name('landing.cek-resi');
    Route::get('bantuan', 'bantuan')->name('landing.bantuan');
    Route::get('syarat-ketentuan', 'syarat_ketentuan')->name('landing.syarat-ketentuan');
});

Route::controller(AuthController::class)->group(function () {
    Route::get('login', 'index')->name('login');
    Route::post('postlogin', 'postLogin')->name('post.login');
    Route::get('logout', 'logout');
});

Route::middleware(['auth'])->group(function () {
    Route::controller(DashboardController::class)->group(function () {
        Route::get('dashboard', 'index');
    });
});
