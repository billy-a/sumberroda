@extends('v_layout.v_layout')

@section('judulweb')
    Sumber Roda - Keranjang
@endsection

@section('linkcss')
  <link href="{{asset('desain/css/keranjang.css')}}" rel="stylesheet">
@endsection

@section('content')
<h5 class="text-center mt-3 pb-2 border-bottom"> KERANJANG </h5>
<div class="card mt-4">

    <div class="card-body border-bottom">
        <div class="d-box">
            <div class="d-flex my-1 brg-k">                
                <div class="mb-auto me-2">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                </div>
                <div class="flex-shrink-0">
                    <img src="{{asset('assets/image.png')}}" alt="" width="100">
                </div>
                <div class="flex-grow-1 ms-3">
                    <p class="card-text fs-13">GT RADIAL CHAMPIRO ECO 175/65 R14</p>
                    <h5 class="card-text text-success">Rp 100.000.000</h5>       
                </div>
                <div class="mb-auto">
                    <i class="far fa-trash-alt"></i>
                </div>
            </div>
        </div>
        <div class="d-box">
            <div class="d-flex">
                <div class="ms-auto">
                    <div class="input-group btn-group-sm" role="group">
                        <button type="button" class="btn btn-secondary btn-qty-k">-</button>
                        <input type="text" class="form-control qty-k text-center">
                        <button type="button" class="btn btn-secondary btn-qty-k">+</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>


<div class="mmenubarx border-bottom" style="background-color: rgb(255, 255, 255);">
    <div class="d-flex w-100 px-3">
        <div class="me-auto" style="align-self: center;">
            <h5 class="card-text text-success">Rp 100.000.000</h5>      
        </div>
        <div class="ms-auto">
            <button type="button" class="btn btn-success">Beli (0)</button>
        </div>
    </div>
</div>   

@endsection