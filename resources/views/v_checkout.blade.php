@extends('v_layout.v_layout')

@section('judulweb')
    Sumber Roda - Profil
@endsection

@section('linkcss')
  <link href="{{asset('desain/css/checkout.css')}}" rel="stylesheet">
@endsection

@section('content')
<form method="POST" action="/checkout/checkouttime">
@csrf
<div class="w-100 mb-5">
    <div class="card mt-2">
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
                    Alamat Toko : Jalan K. H. Wahid Hasyim Nomor 60, Pontianak, Kalimantan Barat
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
                    <select class="form-select form-select-sm @error('tglbook') is-invalid @enderror" name="tglbook">
                        <option selected disabled>Pilih Tanggal Reservasi</option>
                        @for ($i = 1; $i <= 4; $i++)
                        <option value="{{$i}}">{{date('d F Y', strtotime("+".$i." day"))}} (Pukul 08.00-17.00)</option>
                        @endfor
                    </select>
                    <div class="invalid-feedback">
                        @error('tglbook')
                          {{ $message }}
                        @enderror
                    </div>
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
                    <select class="form-select form-select-sm @error('bank') is-invalid @enderror" name="bank">
                        <option value="aa" selected disabled>Pilih Metode Pembayaran</option>
                        @foreach ($bank as $item)
                            <option value="{{$item->idbank}}">{{$item->namabank}} {{$item->norek}} (a.n. {{$item->namarek}})</option>
                        @endforeach                        
                    </select>
                    <div class="invalid-feedback">
                        @error('bank')
                          {{ $message }}
                        @enderror
                    </div>
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
                @foreach ($checkout as $p)   
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
    </div>
</div>

<div class="mmenubarx border-bottom" style="background-color: rgb(255, 255, 255);">
    <div class="d-flex w-100 px-3">
        <div class="me-auto" style="align-self: center;">
            <h5 class="card-text text-success">Rp. <span id='gtotal'>{{number_format($gtotal,0,',','.')}}</span></h5>      
        </div>
        <div class="ms-auto">
            <button type="submit" class="btn btn-success">Beli Sekarang</button>
        </div>
    </div>
</div> 
</form>  
@endsection