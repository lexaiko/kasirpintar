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


Route::resource('/produk', ProdukController::class)->middleware('auth:sanctum');
Route::resource('/kategori', KategoriController::class)->middleware('auth:sanctum');
Route::resource('/satuan', SatuanController::class)->middleware('auth:sanctum');
Route::resource('/merek', MerekController::class)->middleware('auth:sanctum');
Route::resource('/stok', StokController::class)->middleware('auth:sanctum');
Route::resource('/metode_pembayaran', SatuanController::class)->middleware('auth:sanctum');
Route::resource('/pengguna', PenggunaController::class)->middleware('auth:sanctum');
Route::resource('/pelanggan', PelangganController::class)->middleware('auth:sanctum');
Route::resource('/transaksi', TransaksiController::class)->middleware('auth:sanctum');
Route::resource('/detailTransaksi', DetailTransaksiController::class)->middleware('auth:sanctum');
