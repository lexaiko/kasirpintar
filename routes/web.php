<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DiskonController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\KategoriBarangController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\TransaksiController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/test', function () {
    return view('cart');
});
Route::get('/transaksi1', function () {
    return view('transaksi.transaksi');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware(['auth', 'roles:superadmin,admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/transaksi', [AdminController::class, 'transaksi'])->name('admin.transaksi');
    Route::get('/admin/produk', [ProdukController::class, 'index'])->name('admin.produk.index');
    Route::get('/admin/produk/tambah', [ProdukController::class, 'create'])->name('admin.produk.create');
    Route::get('/admin/produk/{id}/edit', [ProdukController::class, 'edit'])->name('admin.produk.edit');
    Route::put('admin/produk/{id}', [ProdukController::class, 'update'])->name('admin.produk.update');
    Route::post('admin/produk', [ProdukController::class, 'store'])->name('admin.produk.store');
    Route::delete('admin/produk/{id}', [ProdukController::class, 'destroy'])->name('admin.produk.destroy');



    Route::resource('/kategori_barang', KategoriBarangController::class)->names('kategori_barang');
    Route::resource('/diskons', DiskonController::class)->names('diskons');
    Route::resource('/stok', StokController::class)->names('stok');
    Route::resource('/pelanggan', PelangganController::class)->names('pelanggan');
    Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
    Route::post('/transaksi', [TransaksiController::class, 'store'])->name('transaksi.store');
});



require __DIR__ . '/auth.php';
