@extends('admin.a_layout')
@section('judulweb')
    Admin - Menu
@endsection

@section('content')
<div>
  <h4 class="mt-3 pb-3 border-bottom text-center">ADMIN HOMEPAGE</h4>

  <div class="mt-3 row">
    <div class="col-md-4">
      <div class="card text-dark bg-light  mb-3">
        <div class="card-header">PENGOLAHAN DATA</div>
        <div class="card-body d-grid">
          <a href="/adminpage/supplier" class="btn btn-outline-dark mb-2">Data Supplier</a>
          <a href="/adminpage/merek" class="btn btn-outline-dark mb-2">Data Merek</a>
          <a href="/adminpage/kategori" class="btn btn-outline-dark mb-2">Data Kategori</a>
          <a href="/adminpage/barang" class="btn btn-outline-dark mb-2">Data Barang</a>
          <a href="/adminpage/bank" class="btn btn-outline-dark mb-2">Data Bank</a>
          <a href="/adminpage/user" class="btn btn-outline-dark mb-2">Data User</a>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card text-white bg-secondary mb-3">
        <div class="card-header">DATA TRANSAKSI</div>
        <div class="card-body d-grid">
          <a href="/adminpage/pembelian" class="btn btn-outline-light mb-2">Transaksi Pembelian</a>
          <a href="/adminpage/penjualan" class="btn btn-outline-light mb-2">Transaksi Penjualan</a>
        </div>
      </div>
    </div>
    
    <div class="col-md-4">
      <div class="card text-dark bg-light mb-3">
        <div class="card-header">LAPORAN</div>
        <div class="card-body d-grid">
          <a href="/adminpage/laporan/jual" class="btn btn-outline-dark mb-2">Laporan Penjualan</a>
          <a href="/adminpage/laporan/beli" class="btn btn-outline-dark mb-2">Laporan Pembelian</a>
          <a href="/adminpage/laporan/barang  " class="btn btn-outline-dark mb-2">Laporan Persediaan</a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection