<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProdukController;
use App\Http\Controllers\Api\KategoriController;
use App\Http\Controllers\Api\SatuanController;
use App\Http\Controllers\Api\PenggunaController;
use App\Http\Controllers\Api\MerekController;
use App\Http\Controllers\Api\PelangganController;
use App\Http\Controllers\Api\TransaksiController;
use App\Http\Controllers\Api\DetailTransaksiController;
use App\Http\Controllers\Api\ShowTransaksiController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register', [AuthController::class,
'register']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class,
'login'])->name('login');
Route::post('/login', [AuthController::class,
'login'])->name('login');


Route::group(['middleware' => ['auth:sanctum', 'roles:superadmin,admin']], function () {
    Route::resource('/produk', ProdukController::class);
    Route::resource('/kategori', KategoriController::class);
    Route::resource('/satuan', SatuanController::class);
    Route::resource('/merek', MerekController::class);
    Route::resource('/stok', StokController::class);
    Route::resource('/metode_pembayaran', SatuanController::class);
    Route::resource('/pengguna', PenggunaController::class);
    Route::resource('/pelanggan', PelangganController::class);
    Route::resource('/transaksi', TransaksiController::class);
    Route::resource('/detailTransaksi', DetailTransaksiController::class);
    Route::get('/showTransaksi/{id}', [ShowTransaksiController::class, 'show']);
});
