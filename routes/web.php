<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/produk', [ProdukController::class, 'index']);        // halaman utama
Route::get('/produk/data', [ProdukController::class, 'getData']); // ambil data JSON
Route::post('/produk/store', [ProdukController::class, 'store']); // simpan data
Route::get('/produk/edit/{id}', [ProdukController::class, 'edit']); // ambil data edit
Route::get('/produk/delete/{id}', [ProdukController::class, 'destroy']); // hapus data