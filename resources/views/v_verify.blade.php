@extends('v_layout.v_layout')

@section('judulweb')
    Sumber Roda - Profil
@endsection

@section('linkcss')
  <link href="{{asset('desain/css/profil.css')}}" rel="stylesheet">
@endsection

@section('content')
<div class="justify-content-center mt-3">
    <div class="card">
        <div class="card-header">{{ __('Verifikasi Email') }}</div>

        <div class="card-body">
            @if (session('resent'))
                <div class="alert alert-success" role="alert">
                    {{ __('Email baru sudah dikirimkan ke alamat email.') }}
                </div>
            @endif

            {{ __('Sebelum melanjutkan transaksi, silahkan lakukan verifikasi email terlebih dahulu.') }}
            {{ __('Jika tidak menerima email') }},
            <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                @csrf
                <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('tekan ini untuk mengirim ulang email') }}</button>.
            </form>
        </div>
    </div>
</div>
@endsection