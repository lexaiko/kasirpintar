<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BarangController;
use App\Http\Controllers\Api\KategoriController;
use App\Http\Controllers\Api\PenggunaController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register', [AuthController::class,
'register']);
Route::get('/login', [AuthController::class,
'login'])->name('login');

Route::post('/login', [AuthController::class,
'login'])->name('login');

Route::get('/pengguna', [PenggunaController::class,
'index'])->middleware('auth:sanctum');

Route::post('/register', [AuthController::class, 'register']);
Route::resource('/barang', BarangController::class);
Route::get('/barangs', [BarangController::class, 'index'])
->middleware('auth:sanctum');
Route::get('/kategori', [KategoriController::class, 'index']);
Route::post('/kategori', [KategoriController::class, 'store']);
