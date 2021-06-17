<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\JualController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\SupplierController;
use App\Http\Controllers\Admin\MerekController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\aBarangController;
use App\Http\Controllers\Admin\aJualController;
use App\Http\Controllers\Admin\aBeliController;
use App\Http\Controllers\Admin\BankController;
use App\Http\Controllers\Admin\aUserController;

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
Route::get('home', [BarangController::class, 'index'])->name('home');
Route::get('get_barang',[BarangController::class, 'get_ajax_barang']);
Route::get('home/dbarang/{id}',[BarangController::class, 'detailbrg']);
Route::get('home/search/{kategori}',[BarangController::class, 'filterbrg']);

Route::post('home/addcart',[CartController::class,'addcart']);
Route::get('home/updatecart',[CartController::class,'updatecart']);

Route::get('keranjang',[CartController::class, 'index'])->name('keranjang');
Route::get('checkout',[CartController::class,'checkout']);

Route::post('checkout/checkouttime',[JualController::class,'checkouttime']);
Route::post('payment/uploadpay',[JualController::class,'uploadpay']);
Route::get('payment/{id}',[JualController::class,'checkouts'])->name('checkouts');
Route::get('faktur/{id}',[JualController::class,'faktur'])->name('faktur');

Route::get('pesanan',[JualController::class, 'pesanan'])->name('pesanan');
Route::get('pesanan/detail/{id}',[JualController::class, 'detailpesanan']);
Route::get('pesanan/proses',[JualController::class,'pesananitem']);
Route::get('pesanan/ticket/{id}',[JualController::class,'ticketpesanan']);
Route::get('pesanan/ticketdone/{id}',[JualController::class,'ticketpesanandone']);

Route::get('profil',[ProfilController::class, 'index'])->name('profil');
//Route::view('login','v_login');

Auth::routes(['verify'=>true]);

Route::group(['middleware' => 'admin'], function(){

  Route::get('adminpage/', [AdminController::class, 'index'])->name('adminpage');

  Route::get('adminpage/supplier', [SupplierController::class, 'index'])->name('adminsupplier');
  Route::get('adminpage/supplier/add', [SupplierController::class, 'tambahdata']);
  Route::post('adminpage/supplier/addproses', [SupplierController::class, 'tambahdataproses']);
  Route::get('adminpage/supplier/update/{id}', [SupplierController::class, 'updatedata']);
  Route::post('adminpage/supplier/updateproses/{id}', [SupplierController::class, 'updatedataproses']);
  Route::get('adminpage/supplier/delete/{id}', [SupplierController::class, 'hapusdata']);
  
  Route::get('adminpage/merek', [MerekController::class, 'index'])->name('adminmerek');
  Route::get('adminpage/merek/add', [MerekController::class, 'tambahdata']);
  Route::post('adminpage/merek/addproses', [MerekController::class, 'tambahdataproses']);
  Route::get('adminpage/merek/update/{id}', [MerekController::class, 'updatedata']);
  Route::post('adminpage/merek/updateproses/{id}', [MerekController::class, 'updatedataproses']);
  Route::get('adminpage/merek/delete/{id}', [MerekController::class, 'hapusdata']);
  
  Route::get('adminpage/bank', [BankController::class, 'index'])->name('adminbank');
  Route::get('adminpage/bank/add', [BankController::class, 'tambahdata']);
  Route::post('adminpage/bank/addproses', [BankController::class, 'tambahdataproses']);
  Route::get('adminpage/bank/update/{id}', [BankController::class, 'updatedata']);
  Route::post('adminpage/bank/updateproses/{id}', [BankController::class, 'updatedataproses']);
  Route::get('adminpage/bank/delete/{id}', [BankController::class, 'hapusdata']);
  
  Route::get('adminpage/kategori', [KategoriController::class, 'index'])->name('adminkategori');
  Route::get('adminpage/kategori/add', [KategoriController::class, 'tambahdata']);
  Route::post('adminpage/kategori/addproses', [KategoriController::class, 'tambahdataproses']);
  Route::get('adminpage/kategori/update/{id}', [KategoriController::class, 'updatedata']);
  Route::post('adminpage/kategori/updateproses/{id}', [KategoriController::class, 'updatedataproses']);
  Route::get('adminpage/kategori/delete/{id}', [KategoriController::class, 'hapusdata']);
  
  Route::get('adminpage/barang', [aBarangController::class, 'index'])->name('adminbarang');
  Route::get('adminpage/barang/add', [aBarangController::class, 'tambahdata']);
  Route::post('adminpage/barang/addproses', [aBarangController::class, 'tambahdataproses']);
  Route::get('adminpage/barang/update/{id}', [aBarangController::class, 'updatedata']);
  Route::post('adminpage/barang/updateproses/{id}', [aBarangController::class, 'updatedataproses']);
  Route::get('adminpage/barang/delete/{id}', [aBarangController::class, 'hapusdata']);
  
  Route::get('adminpage/user', [aUserController::class, 'index'])->name('adminuser');
  Route::get('adminpage/user/update/{value}/{id}', [aUserController::class, 'updatedata']);

  Route::get('adminpage/penjualan', [aJualController::class, 'index'])->name('adminjual');
  Route::get('adminpage/penjualan/{id}', [aJualController::class, 'indexfilter']);
  Route::get('adminpage/penjualan/detail/{id}', [aJualController::class, 'detaildata']);
  Route::post('adminpage/penjualan/detail/status/{id}', [aJualController::class, 'statusdata']);

  Route::get('adminpage/pembelian', [aBeliController::class, 'index'])->name('adminbeli');
  Route::get('adminpage/pembelian/add', [aBeliController::class, 'tambahdata'])->name('adminbeliadd');
  Route::get('adminpage/pembelian/add/barang', [aBeliController::class, 'cekkodebrg']);
  Route::post('adminpage/pembelian/addproses', [aBeliController::class, 'tambahdataproses']);
  Route::get('adminpage/pembelian/delete/{id}', [aBeliController::class, 'hapusdata']);
  Route::post('adminpage/pembelian/simpanproses', [aBeliController::class, 'simpanproses']);
  Route::get('adminpage/pembelian/deletedata/{id}', [aBeliController::class, 'deletedata']);
  Route::get('adminpage/pembelian/detail/{id}', [aBeliController::class, 'detaildata']);

  Route::get('adminpage/laporan/jual', [aJualController::class, 'laporanjual']);
  Route::get('adminpage/laporan/jual/cetak', [aJualController::class, 'laporancetak'])->name('jualcetak');
  
  Route::get('adminpage/laporan/barang', [aBarangController::class, 'laporanbarang']);
  Route::get('adminpage/laporan/barang/cetak', [aBarangController::class, 'laporancetak'])->name('barangcetak');

  Route::get('adminpage/laporan/beli', [aBeliController::class, 'laporanbeli']);
  Route::get('adminpage/laporan/beli/cetak', [aBeliController::class, 'laporancetak'])->name('belicetak');
    
  Route::group(['middleware' => 'pemilik'], function(){

  });

});

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
