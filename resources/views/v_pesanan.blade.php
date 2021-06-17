@extends('v_layout.v_layout')

@section('judulweb')
    Sumber Roda - Pesanan
@endsection

@section('linkcss')
  <link href="{{asset('desain/css/pesanan.css')}}" rel="stylesheet">
@endsection

@section('content')

@if (session('pesansukses'))    
<div class="alert alert-success mt-4 alert-dismissible fade show" role="alert">

  <h4 class="alert-heading">Upload Berhasil!</h4>
  <p>Bukti pembayaran berhasil diupload dan akan dikonfirmasi dalam 1x24jam</p>
  <hr>
  <p>Terima Kasih</p>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

</div>
@endif

<div class="mt-4">
    <ul class="nav nav-pills">
        <li class="nav-item">
          <button class="nav-link heremenu active" aria-current="page" onclick="ajaxpr('0')">Semua</button>          
        </li>
        <li class="nav-item">
          <button class="nav-link heremenu" aria-current="page" onclick="ajaxpr('1')">Belum Bayar</button>
        </li>
        <li class="nav-item">
          <button class="nav-link heremenu" aria-current="page" onclick="ajaxpr('2')">Menunggu Konfirmasi</button>
        </li>
        <li class="nav-item">
          <button class="nav-link heremenu" aria-current="page" onclick="ajaxpr('3')">Diterima</button>
        </li>
        <li class="nav-item">
          <button class="nav-link heremenu" aria-current="page" onclick="ajaxpr('4')">Selesai</button>
        </li>
        <li class="nav-item">
          <button class="nav-link heremenu" aria-current="page" onclick="ajaxpr('5')">Batal</button>
        </li>        
    </ul>
</div>

<div id="ubahisi">
  
</div>

<script>
$(document).ready(function(){
  ajaxpr('0');

  $('.heremenu').on('click',function(){
    $('.heremenu').removeClass('active');
    $(this).addClass('active');
  });
});

function ajaxpr(status){
    $.ajax({
        url:"pesanan/proses?status="+status,
        success:function(data)
        {            
          $('#ubahisi').html(data);
        }
    });
}
</script>
@endsection