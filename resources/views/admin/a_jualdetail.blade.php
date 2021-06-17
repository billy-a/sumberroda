@extends('admin.a_layout')
@section('judulweb')
    Admin - Merek
@endsection

@section('content')
<div>
  <h4 class="mt-3 pb-3 border-bottom text-center">DETAIL PENJUALAN</h4>

  @if (session('pesan'))
  <div class="mt-4 alert alert-success alert-dismissible fade show" role="alert">
    {{ session('pesan') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>    
  @endif

  <div class="my-4">
    <a class="btn btn-primary" href="/adminpage/penjualan">Kembali</a>
  </div>
  
  <div class="mt-4">
    <div class="card">
      <form method="POST" action="/adminpage/penjualan/detail/status/{{$jual->idjual}}">
        @csrf
        <div class="card-body row g-2">
          <div class="col-md-2">
            No. Pesanan 
          </div>
          <div class="col-md-10 fw-bold">
            : {{$jual->idjual}}
          </div>

          <div class="col-md-2">
            Tanggal Pemesanan 
          </div>
          <div class="col-md-10 fw-bold">
            : {{$jual->tglpesan}}
          </div>

          <div class="col-md-2">
            Tanggal Reservasi 
          </div>
          <div class="col-md-10 fw-bold">
            : {{$jual->tglreservasi}} (08.00 - 17.00)
          </div>

          <div class="col-md-2">
            Bank 
          </div>
          <div class="col-md-10 fw-bold">
            : {{$jual->namabank}} ( {{$jual->namarek}} a.n. {{$jual->norek}} )
          </div>
          @if ($jual->bukti != null)
          <div class="col-md-12">
            <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModalFullscreen">
              <img class="" src="{{url('fotobukti/'.$jual->bukti)}}" style="width:100px">
            </a>
          </div>
          @endif          
          <form>
          <div class="col-md-6"> 
            <select id="status" class="form-select" name="status">
              <option value="1" {{$jual->status==1 ? " selected" : "" }}>Belum Bayar</option>     
              <option value="2" {{$jual->status==2 ? " selected" : "" }}>Menunggu Konfirmasi</option>     
              <option value="3" {{$jual->status==3 ? " selected" : "" }}>Diterima</option>     
              <option value="4" {{$jual->status==4 ? " selected" : "" }}>Selesai</option>     
              <option value="5" {{$jual->status==5 ? " selected" : "" }}>Dibatalkan</option>     
            </select>
          </div>
          <div class="col-md-6">
            <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Ubah Status Pesanan</a>
          </div>
          
          <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="staticBackdropLabel">Konfirmasi Transaksi</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  Yakin ingin mengubah status pembayaran ini ?
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                  <button type="submit" class="btn btn-success">Ubah Status Pesanan</button>
                </div>
              </div>
            </div>
          </div>


        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="exampleModalFullscreen" tabindex="-1" aria-labelledby="exampleModalFullscreenLabel" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body mx-auto">
        <img src="{{url('fotobukti/'.$jual->bukti)}}" style="height : 80vh;">
      </div>
    </div>
  </div>
</div>

@endsection