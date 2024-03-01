<?php

use App\Http\Controllers\DiskonController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PembelianController;
use App\Http\Controllers\PengirimanController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

//Login
Route::get('login', function (){
    return view('auth.login');
});
Route::post('auth', [LoginController::class, 'auth']);
Route::get('logout', [LoginController::class, 'logout']);

//Dashboard
Route::middleware('statuslogin')->group(function(){
    Route::get('dashboard', function(){
        return view('admin.dashboard');
    });
    Route::get('/pengguna', [UserController::class, 'index']);
    Route::get('/pengguna/add', [UserController::class, 'add']);
    Route::post('/pengguna/create', [UserController::class, 'create']);
    Route::get('/pengguna/delete/{id_pengguna}', [UserController::class, 'delete']);

    Route::get('/pelanggan', [PelangganController::class, 'index']);
    Route::get('/pelanggan/add', [PelangganController::class, 'add']);
    Route::post('/pelanggan/create', [PelangganController::class, 'create']);
    Route::post('/pelanggan/update/{id_pelanggan}', [PelangganController::class, 'update']);
    Route::get('/pelanggan/delete/{id_pelanggan}', [PelangganController::class, 'delete']);

    Route::get('/produk', [ProdukController::class, 'index']);
    Route::post('/produk/create', [ProdukController::class, 'create']);
    Route::post('/produk/update/{kode_produk}', [ProdukController::class, 'update']);
    Route::get('/produk/delete/{kode_produk}', [ProdukController::class, 'delete']);

    Route::get('/kategori', [KategoriController::class, 'index']);
    Route::post('/kategori/create', [KategoriController::class, 'create']);
    Route::get('/kategori/delete/{id_kategori_produk}', [KategoriController::class, 'delete']);
    Route::post('/kategori/update/{id_kategori_produk}', [KategoriController::class, 'update']);

    Route::get('/diskon', [DiskonController::class, 'index']);
    Route::post('/diskon/create', [DiskonController::class, 'create']);
    Route::get('/diskon/delete/{id_diskon_produk}', [DiskonController::class, 'delete']);

    Route::get('/pembelian', [PembelianController::class, 'index']);
    Route::post('/pembelian/create', [PembelianController::class, 'create']);

    Route::get('/penjualan', [PenjualanController::class, 'index']);
    Route::post('/penjualan/create', [PenjualanController::class, 'create']);
    Route::get('/penjualan/delete/{id_penjualan}', [PenjualanController::class, 'delete']);
    Route::get('/penjualan/detail/{id_penjualan}', [PenjualanController::class, 'detail']);
    Route::get('/export', [PenjualanController::class, 'export']);

    Route::get('/pengiriman', [PengirimanController::class, 'index']);
    Route::post('/pengiriman/create', [PengirimanController::class, 'create']);
    Route::post('/pengiriman/update/{id_pengiriman}', [PengirimanController::class, 'update']);
    
});
