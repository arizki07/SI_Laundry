<?php

use App\Http\Controllers\_00_Datatables\CategoryList;
use App\Http\Controllers\_00_Datatables\CustomerList;
use App\Http\Controllers\_00_Datatables\ProductList;
use App\Http\Controllers\_01_Produk\ProductController;
use App\Http\Controllers\_02_Penjualan\CustomerController;
use App\Http\Controllers\_04_SetData\CategoryController;
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
    Route::get('/', 'index')->name('home.pages');
});

Route::controller(AuthController::class)->group(function () {
    Route::get('login', 'index')->name('login');
    Route::post('postlogin', 'postLogin')->name('post.login');
    Route::get('logout', 'logout');
});

Route::middleware(['auth'])->group(function () {
    Route::resource('getCategories', CategoryList::class);
    Route::resource('getProduk', ProductList::class);
    Route::resource('getCustomer', CustomerList::class);

    Route::controller(DashboardController::class)->group(function () {
        Route::get('dashboard', 'index');
    });

    Route::controller(ProductController::class)->group(function () {
        Route::get('produk', 'produk');
        Route::post('produk/store', 'store')->name('produk.store');
        Route::post('produk/update/{id}', 'update')->name('produk.update');
        Route::delete('produk/destroy/{id}', 'destroy');
    });

    Route::controller(CustomerController::class)->group(function () {
        Route::get('customer', 'customer');
        Route::post('customer/store', 'store')->name('customer.store');
        Route::post('customer/update/{id}', 'update')->name('customer.update');
        Route::delete('customer/destroy/{id}', 'destroy');
    });

    Route::controller(CategoryController::class)->group(function () {
        Route::get('categories', 'Categories');
        Route::post('categories', 'store')->name('categories.store');
        Route::post('categories/update/{id}', 'update')->name('categories.update');
        Route::delete('categories/destroy/{id}', 'destroy');
    });
});
