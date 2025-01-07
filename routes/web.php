<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\_00_Datatables\FaqsList;
use App\Http\Controllers\_00_Datatables\LogsList;
use App\Http\Controllers\_00_Datatables\ResiList;
use App\Http\Controllers\_00_Datatables\SalesList;
use App\Http\Controllers\_00_Datatables\StatusList;
use App\Http\Controllers\_00_Datatables\ProductList;
use App\Http\Controllers\_05_Setting\FaqsController;
use App\Http\Controllers\_05_Setting\LogsController;
use App\Http\Controllers\_00_Datatables\CategoryList;
use App\Http\Controllers\_00_Datatables\CustomerList;
use App\Http\Controllers\_05_Setting\UsersController;
use App\Http\Controllers\_00_Datatables\PemasukanList;
use App\Http\Controllers\_00_Datatables\ReferensiList;
use App\Http\Controllers\_01_Produk\ProductController;
use App\Http\Controllers\_02_Penjualan\ResiController;
use App\Http\Controllers\_04_SetData\StatusController;
use App\Http\Controllers\_05_Setting\KontakController;
use App\Http\Controllers\_02_Penjualan\SalesController;
use App\Http\Controllers\_04_SetData\CategoryController;
use App\Http\Controllers\_04_SetData\ReferensiController;
use App\Http\Controllers\_06_Finance\PemasukanController;
use App\Http\Controllers\_02_Penjualan\CustomerController;

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

Route::middleware(['data.kontak', 'logs'])->controller(LandingController::class)->group(function () {
    Route::get('/', 'index')->name('landing.home');
    Route::get('hubungi-kami', 'contact')->name('landing.hubungi-kami');
    Route::get('tentang-kami', 'about')->name('landing.tentang-kami');
    Route::get('daftar-harga', 'list')->name('landing.daftar-harga');
    Route::get('cek-resi', 'resi')->name('landing.cek-resi');
    Route::get('bantuan', 'bantuan')->name('landing.bantuan');
    Route::get('syarat-ketentuan', 'syarat_ketentuan')->name('landing.syarat-ketentuan');
    Route::get('testimoni', 'testimoni')->name('landing.testimoni');
});

Route::middleware(['logs'])->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::get('login', 'index')->name('login');
        Route::post('postlogin', 'postLogin')->name('post.login');
        Route::get('logout', 'logout');
    });

    Route::middleware(['auth'])->group(function () {
        Route::resource('getCategories', CategoryList::class);
        Route::resource('getProduk', ProductList::class);
        Route::resource('getCustomer', CustomerList::class);
        Route::resource('getReferensi', ReferensiList::class);
        Route::resource('getStatus', StatusList::class);
        Route::resource('getSales', SalesList::class);
        Route::resource('getResi', ResiList::class);
        Route::resource('getLogs', LogsList::class);
        Route::resource('getFaqs', FaqsList::class);
        Route::resource('getPemasukan', PemasukanList::class);

        Route::controller(DashboardController::class)->group(function () {
            Route::get('dashboard', 'index');
        });

        //PRODUK
        Route::controller(ProductController::class)->group(function () {
            Route::get('produk', 'produk');
            Route::post('produk/store', 'store')->name('produk.store');
            Route::post('produk/update/{id}', 'update')->name('produk.update');
            Route::delete('produk/destroy/{id}', 'destroy');
        });

        //PENJUALAN
        Route::controller(CustomerController::class)->group(function () {
            Route::get('customer', 'customer');
            Route::post('customer/store', 'store')->name('customer.store');
            Route::post('customer/update/{id}', 'update')->name('customer.update');
            Route::delete('customer/destroy/{id}', 'destroy');
        });

        Route::controller(SalesController::class)->group(function () {
            Route::get('sales', 'sales')->name('sales.index');
            Route::get('sales/create', 'create')->name('sales.create');
            Route::post('sales/store', 'store')->name('sales.store');
            Route::get('sales/edit/{id}', 'edit')->name('edit.sales');
            Route::post('sales/update/{id}', 'update')->name('update.sales');
            Route::delete('sales/destroy/{id}', 'destroy');
        });

        Route::controller(ResiController::class)->group(function () {
            Route::get('resi', 'resi');
            Route::post('update/resi/{id}', 'updateResi')->name('resi.update');
        });

        //SET DATA
        Route::controller(CategoryController::class)->group(function () {
            Route::get('categories', 'Categories');
            Route::post('categories', 'store')->name('categories.store');
            Route::post('categories/update/{id}', 'update')->name('categories.update');
            Route::delete('categories/destroy/{id}', 'destroy');
        });

        Route::controller(ReferensiController::class)->group(function () {
            Route::get('referensi', 'referensi');
            Route::post('referensi/store', 'store')->name('referensi.store');
            Route::post('referensi/update/{id}', 'update')->name('referensi.update');
            Route::delete('referensi/destroy/{id}', 'destroy');
        });

        Route::controller(StatusController::class)->group(function () {
            Route::get('status', 'status');
            Route::post('status/store', 'store')->name('status.store');
            Route::post('status/update/{id}', 'update')->name('status.update');
            Route::delete('status/destroy/{id}', 'destroy');
        });

        //SETTING
        Route::controller(UsersController::class)->group(function () {
            Route::get('user', 'users');
            Route::post('user/store', 'store')->name('user.store');
            Route::post('user/update/{id}', 'update')->name('user.update');
            Route::post('user/destroy/{id}', 'destroy');
        });

        Route::controller(LogsController::class)->group(function () {
            Route::get('logs', 'logs')->name('logs.index');
            Route::delete('logs/destroy/{id}', 'destroy');
        });

        Route::controller(KontakController::class)->group(function () {
            Route::get('kontak', 'index')->name('kontak.index');
            Route::post('kontak/update', 'update')->name('kontak.update');
        });

        Route::controller(FaqsController::class)->group(function () {
            Route::get('faqs', 'faqs')->name('faqs.index');
            Route::post('faqs', 'store')->name('faqs.store');
            Route::post('faqs/update/{id}', 'update')->name('faqs.update');
            Route::delete('faqs/destroy/{id}', 'destroy');
        });

        Route::controller(PemasukanController::class)->group(function () {
            Route::get('pemasukan', 'pemasukan')->name('pemasukan.index');
        });
    });
});
