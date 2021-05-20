<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dbarangController;
use App\Http\Controllers\BarangController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::view('/','v_home');
Route::get('/', [BarangController::class, 'index']);
Route::get('get_barang',[BarangController::class, 'get_ajax_barang']);

Route::get('/home/dbarang/{id}',[dbarangController::class, 'index']);

Route::view('/pesanan','v_pesanan');
Route::view('/keranjang','v_keranjang');
Route::view('/profil','v_profil');
Route::view('/login','v_login');

 