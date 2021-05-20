@extends('v_layout.v_layout')

@section('judulweb')
    Sumber Roda - Profil
@endsection

@section('linkcss')
  <link href="{{asset('desain/css/profil.css')}}" rel="stylesheet">
@endsection

@section('content')
<h5 class="text-center mt-3 pb-2 border-bottom"> PROFIL </h5>
<div class="w-100">
    <div class="card mt-4">
        <div class="card-body">
            <div class="text-center">
                <img src="{{asset('assets/image.png')}}" alt="" width="100" height="100" class="rounded-circle">
                <H5 class="mt-3">USERNAME</H5>
            </div>
            <div class="text-center fs-13">
                Email : username@gmail.com

            </div>
        </div>
        <div class="card-footer text-center">
            <button type="submit" class="btn btn-danger">LOGOUT</button>
        </div>
    </div>
</div>
@endsection