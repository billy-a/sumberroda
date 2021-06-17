@extends('v_layout.v_layout')

@section('judulweb')
    Sumber Roda - Detail Pesanan
@endsection

@section('linkcss')
  {{-- <link href="{{asset('desain/css/pesanan.css')}}" rel="stylesheet"> --}}
@endsection

@section('content')
<div class="w-100 mb-5">
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb"class="mt-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('home')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{url('pesanan')}}">Pesanan</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail</li>
        </ol>
    </nav>

    <div class="card mt-2">
      <div class="card-header text-end">
        <h5 class="m-0">No. Pesanan #{{$jual->idjual}}</h5>
      </div>

      <div class="card-body">
          <span class="fa-stack text-success fa-xs">
              <i class="fas fa-circle fa-stack-2x"></i>
              <i class="fas fa-store fa-stack-1x fa-inverse"></i>
          </span>
          <span>
              <h6 class="d-inline">Info Toko</h6>
          </span>
          <div class="card mt-2 fa-sm">
              <div class="p-1">
                  Alamat Toko : Jl. Hasim Bla No. 2021, Pontianak, Kalimantan Barat
              </div>
          </div>
      </div>

      <div class="card-body">
          <span class="fa-stack text-success fa-xs">
              <i class="fas fa-circle fa-stack-2x"></i>
              <i class="fas fa-calendar-alt fa-stack-1x fa-inverse"></i>
          </span>
          <span>
              <h6 class="d-inline">Tanggal Reservasi / Instalasi</h6>
          </span>
          <div class="card mt-2 fa-sm">
              <div class="p-1">
                  {{date('D, d M Y',strtotime($jual->tglreservasi))}} ( 08.00 - 17.00 )
              </div>
          </div>
      </div>

      <div class="card-body">
          <span class="fa-stack text-success fa-xs">
              <i class="fas fa-circle fa-stack-2x"></i>
              <i class="fas fa-credit-card fa-stack-1x fa-inverse"></i>
          </span>
          <span>
              <h6 class="d-inline">Bank Pembayaran (Transfer Manual)</h6>
          </span>
          <div class="card mt-2 fa-sm">
              <div class="p-1">
                  {{$jual->namabank}} ( {{$jual->norek}} a.n. {{$jual->namarek}} )
              </div>
          </div>
      </div>
      <div class="card-body">

          <div class="card">
              <?php 
                  $no = 0;
                  $totalhrg = 0;
                  $totaljasa = 0;
                  $gtotal = 0;
              ?>
              @foreach ($detiljual as $p)

              @if ($p->idjual == $jual->idjual)
                  
              <?php
                  $qty = $p->qty;
                  $subtotalhrg = $p->hargajual*$qty;
                  if($p->instalasi=="1"){
                      $subtotaljasa = $p->hargajasa*$qty;
                  }else{
                      $subtotaljasa = 0;
                  }
                  $totalhrg += $subtotalhrg;
                  $totaljasa += $subtotaljasa;
                  $gtotal = $gtotal + $subtotalhrg + $subtotaljasa;
              ?>                                 
              <div class="card-body border-bottom">
                  <div class="d-box ">
                      <div class="d-flex my-1">
                          <div class="flex-shrink-0">
                              <img src="{{asset('assets/'.$p->gambar)}}" alt="" width="100">
                          </div>
                          <div class="flex-grow-1 ms-3">
                              <p class="card-text fs-13">{{$p->namabrg}}</p>
                              <h5 class="card-text text-success">Rp. <span >{{number_format($p->hargajual,0,',','.')}}</span></h5>       
                          </div>
                          <div class="ms-auto mt-auto">
                              x <span>{{$qty}}</span>
                          </div>
                      </div>
                  </div> 
                  @if ($p->instalasi=="1")
                  <div class="d-flex border-top">
                      <div class="fs-13">
                          Jasa Instalasi  <h6 class="card-text text-success">Rp. <span>{{number_format($p->hargajasa,0,',','.')}}</span></h6>   
                      </div>
                  </div>
                  @else
                  <div class="d-flex border-top">
                      <div class="fs-13">
                          ( Tidak Menggunakan Jasa Instalasi )
                      </div>
                  </div>
                  @endif
              </div>
              @endif

              @endforeach
              
              <div class="card-body">
                  <div class="row">
                      <div class="col-6">
                          Total Harga Barang
                      </div>
                      <div class="col-6 text-end">
                          Rp. <span>{{number_format($totalhrg,0,',','.')}}</span>
                      </div>
                      <div class="col-6">
                          Total Harga Instalasi
                      </div>
                      <div class="col-6 text-end">
                          Rp. <span>{{number_format($totaljasa,0,',','.')}}</span>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      @if ($jual->status=='1')
        <div class="card-footer d-grid">
          <a href="/payment/{{$jual->idjual}}" class="btn btn-success">Bayar Sekarang</a>
        </div>
      @elseif($jual->status=='2')
        <div class="card-footer d-grid text-center">
            Tunggu konfirmasi dari Sumber Roda dalam waktu 1x24jam<br>Terima kasih
        </div>
    @elseif($jual->status=='3')
        <div class="card-footer d-grid">
        <a href="/pesanan/ticket/{{$jual->idjual}}" class="btn btn-success">Lihat E-Ticket</a>
        </div>
    @elseif($jual->status=='4')
    <div class="card-footer d-grid">
        <a href="/faktur/{{$jual->idjual}}" class="btn btn-success">Lihat Faktur</a>
    </div>
      @endif
    </div>
</div>
@endsection