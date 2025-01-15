<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MerekController;
use App\Http\Controllers\MetodeController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\SatuanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DetailTransaksiController;


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
Route::middleware(['auth', 'roles:admin,superadmin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/transaksi', [AdminController::class, 'transaksi'])->name('admin.transaksi');

    Route::get('/admin/produk', [ProdukController::class, 'index'])->name('admin.produk.index');
    Route::get('/admin/produk/tambah', [ProdukController::class, 'create'])->name('admin.produk.create');
    Route::get('/admin/produk/{id}/edit', [ProdukController::class, 'edit'])->name('admin.produk.edit');
    Route::put('admin/produk/{id}', [ProdukController::class, 'update'])->name('admin.produk.update');
    Route::post('admin/produk', [ProdukController::class, 'store'])->name('admin.produk.store');
    Route::delete('admin/produk/{id}', [ProdukController::class, 'destroy'])->name('admin.produk.destroy');

    Route::get('/admin/merek', [MerekController::class, 'index'])->name('admin.merek.index');
    Route::get('/admin/merek/tambah', [MerekController::class, 'create'])->name('admin.merek.create');
    Route::get('/admin/merek/{id}/edit', [MerekController::class, 'edit'])->name('admin.merek.edit');
    Route::put('admin/merek/{id}', [MerekController::class, 'update'])->name('admin.merek.update');
    Route::post('admin/merek', [MerekController::class, 'store'])->name('admin.merek.store');
    Route::delete('admin/merek/{id}', [MerekController::class, 'destroy'])->name('admin.merek.destroy');

    Route::get('/admin/satuan', [SatuanController::class, 'index'])->name('admin.satuan.index');
    Route::get('/admin/satuan/tambah', [SatuanController::class, 'create'])->name('admin.satuan.create');
    Route::get('/admin/satuan{id}/edit', [SatuanController::class, 'edit'])->name('admin.satuan.edit');
    Route::put('/admin/satuan{id}', [SatuanController::class, 'update'])->name('admin.satuan.update');
    Route::post('admin/satuan', [SatuanController::class, 'store'])->name('admin.satuan.store');
    Route::delete('admin/satuan/{id}', [SatuanController::class, 'destroy'])->name('admin.satuan.destroy');

    Route::get('/admin/metode_pembayaran', [MetodeController::class, 'index'])->name('admin.metode.index');
    Route::get('/admin/metode_pembayaran/tambah', [MetodeController::class, 'create'])->name('admin.metode.create');
    Route::get('/admin/metode_pembayaran/{id}/edit', [MetodeController::class, 'edit'])->name('admin.metode.edit');
    Route::put('admin/metode_pembayaran/{id}', [MetodeController::class, 'update'])->name('admin.metode.update');
    Route::post('admin/metode_pembayaran', [MetodeController::class, 'store'])->name('admin.metode.store');
    Route::delete('admin/metode_pembayaran/{id}', [MetodeController::class, 'destroy'])->name('admin.metode.destroy');

    Route::get('/admin/pelanggan', [PelangganController::class, 'index'])->name('admin.pelanggan.index');
    Route::get('/admin/pelanggan/tambah', [PelangganController::class, 'create'])->name('admin.pelanggan.create');
    Route::get('/admin/pelanggan/{id}/edit', [PelangganController::class, 'edit'])->name('admin.pelanggan.edit');
    Route::put('admin/pelanggan/{id}', [PelangganController::class, 'update'])->name('admin.pelanggan.update');
    Route::post('admin/pelanggan', [PelangganController::class, 'store'])->name('admin.pelanggan.store');
    Route::delete('admin/pelanggan/{id}', [PelangganController::class, 'destroy'])->name('admin.pelanggan.destroy');

    Route::get('/admin/transaksi', [TransaksiController::class, 'index'])->name('admin.transaksi.index');
    Route::get('/admin/transaksi/tambah', [TransaksiController::class, 'create'])->name('admin.transaksi.create');
    Route::get('/admin/transaksi/{id}/edit', [TransaksiController::class, 'edit'])->name('admin.transaksi.edit');
    Route::put('admin/transaksi/{id}', [TransaksiController::class, 'update'])->name('admin.transaksi.update');
    Route::post('admin/transaksi', [TransaksiController::class, 'store'])->name('admin.transaksi.store');
    Route::delete('admin/transaksi/{id}', [TransaksiController::class, 'destroy'])->name('admin.transaksi.destroy');

    Route::get('/admin/kategori', [KategoriController::class, 'index'])->name('admin.kategori.index');
    Route::get('/admin/kategori/tambah', [KategoriController::class, 'create'])->name('admin.kategori.create');
    Route::put('admin/kategori/{id}', [KategoriController::class, 'update'])->name('admin.kategori.update');
    Route::get('/admin/kategori/{id}/edit', [KategoriController::class, 'edit'])->name('admin.kategori.edit');
    Route::post('admin/kategori', [KategoriController::class, 'store'])->name('admin.kategori.store');
    Route::delete('admin/kategori/{id}', [KategoriController::class, 'destroy'])->name('admin.kategori.destroy');

    Route::get('/admin/user', [UserController::class, 'index'])->name('admin.user.index');
    Route::get('/admin/user/tambah', [UserController::class, 'create'])->name('admin.user.create');
    Route::put('admin/user/{id}', [UserController::class, 'update'])->name('admin.user.update');
    Route::get('/admin/user/{id}/edit', [UserController::class, 'edit'])->name('admin.user.edit');
    Route::post('admin/user', [UserController::class, 'store'])->name('admin.user.store');
    Route::delete('admin/user/{id}', [UserController::class, 'destroy'])->name('admin.user.destroy');

    Route::get('/admin/detailTransaksi', [DetailTransaksiController::class, 'index'])->name('admin.detailTransaksi.index');
    Route::get('/admin/detailTransaksi/tambah', [DetailTransaksiController::class, 'create'])->name('admin.detailTransaksi.create');
    Route::put('admin/detailTransaksi/{id}', [DetailTransaksiController::class, 'update'])->name('admin.detailTransaksi.update');
    Route::get('/admin/detailTransaksi/{id}/edit', [DetailTransaksiController::class, 'edit'])->name('admin.detailTransaksi.edit');
    Route::post('admin/detailTransaksi', [DetailTransaksiController::class, 'store'])->name('admin.detailTransaksi.store');
    Route::delete('admin/detailTransaksi/{id}', [DetailTransaksiController::class, 'destroy'])->name('admin.detailTransaksi.destroy');

});



require __DIR__ . '/auth.php';
