
<?php

use App\Http\Controllers\PromoController;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\DashboardController;


use App\Http\Controllers\LandingController;

// Landing page utama
Route::get('/', [LandingController::class, 'index'])->name('landing');
// Dashboard tetap di /dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');




// Route biasa, tambahkan pengecekan session login di controller
Route::prefix('pelanggan')->name('pelanggan.')->group(function () {
    Route::get('/', [PelangganController::class, 'index'])->name('index');
    Route::get('/create', [PelangganController::class, 'create'])->name('create');
    Route::post('/store', [PelangganController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [PelangganController::class, 'edit'])->name('edit');
    Route::put('/update/{id}', [PelangganController::class, 'update'])->name('update');
    Route::delete('/delete/{id}', [PelangganController::class, 'destroy'])->name('destroy');
});

Route::resource('produk', ProdukController::class);

// Promo manual group agar route promo.index terdaftar
Route::resource('promo', PromoController::class);

Route::get('/penjualan', [PenjualanController::class, 'index'])->name('penjualan.index');
Route::post('/penjualan', [PenjualanController::class, 'store'])->name('penjualan.store');
Route::get('/penjualan/struk/{id}', [PenjualanController::class, 'struk'])->name('penjualan.struk');

Route::post('/promo/{id}/aktif', function ($id, Request $request) {
    $promo = Promo::findOrFail($id);
    $promo->aktif = $request->input('aktif') ? 1 : 0;
    $promo->save();
    return response()->json(['success' => true]);
});

// Login routes (manual, tanpa middleware)


Route::get('/login', function () {
    if (Session::has('kasir_logged_in')) {
        return redirect('/dashboard');
    }
    return view('admin.sign-in');
})->name('login');
Route::post('/login', [App\Http\Controllers\LoginController::class, 'login'])->name('login.process');
Route::get('/logout', [App\Http\Controllers\LoginController::class, 'logout'])->name('logout');

Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');

// Register routes
Route::get('/register', function () {
    if (Session::has('kasir_logged_in')) {
        return redirect('/dashboard');
    }
    return view('admin.sign-up');
})->name('register');
Route::post('/register', [App\Http\Controllers\LoginController::class, 'register'])->name('register.process');
