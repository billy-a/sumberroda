@extends('v_layout.v_layout')

@section('judulweb')
    Sumber Roda - Pesanan
@endsection

@section('linkcss')
  <link href="{{asset('desain/css/pesanan.css')}}" rel="stylesheet">
@endsection

@section('content')
<div class="mt-4">
    <ul class="nav nav-pills">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Semua</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="#">Belum Bayar</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="#">Menunggu Konfirmasi</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="#">Diterima</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="#">Selesai</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="#">Batal</a>
        </li>        
    </ul>
</div>
<div class="mt-4">
    <div class="card">
        <div class="card-body">
            <div class="card-title">
                <h5>PESANAN 1010109123219123 (BELUM BAYAR)</h5>
            </div>
            <div class="card-text fs-13 border-bottom pb-2">
                <p>Tanggal Pemesanan : 16 Februari 2021</p>
                <p>Tanggal Instalasi : 17 Februari 2021</p>
            </div>
            <div class="card-text fs-13 pt-2">
                <div class="row">
                    <div class="col-6">
                        GT RADIAL CHAMPIRO ECO 175/65 R14 <span class="badge rounded-pill bg-secondary">x 2 Pcs</span>
                    </div>
                    <div class="col-6 text-end">
                        Rp. 200.000
                    </div>
                </div>                
                
            </div>
        </div>
        <div class="card-footer text-end">
            <h5>TOTAL Rp. 200.000</h5>
        </div>
    </div>
</div>
@endsection