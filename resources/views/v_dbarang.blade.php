  @extends('v_layout.v_layout')

  @section('judulweb')
      Sumber Roda - Detail
  @endsection

  @section('linkcss')
    <link href="{{asset('desain/css/dbarang.css')}}" rel="stylesheet">
  @endsection

  @section('content')
  <form method="POST" action="/home/addcart">
  @csrf
  <div class="card mt-4 fs-13">
    <div class="card-body">

      <div class="gbr">
        <a href="{{asset('assets/'.$dbarang->gambar)}}" target="_blank">
          <img src="{{asset('assets/'.$dbarang->gambar)}}" alt="" class="gbr-item">
        </a>
      </div>

      <div class="gbr-detail mt-4">
        <p class="namabrg">{{ $dbarang->namabrg }}</p>
        <p class="hargabrg text-success">Rp. {{number_format($dbarang->hargajual,0,',','.')}}</p>
        <span class="badge bg-secondary me-1 mt-2">Instalasi Rp. {{number_format($dbarang->hargajasa,0,',','.')}}</span>        

        @if ($dbarang->lebarban!='')
          <span class="badge bg-secondary me-1 mt-2">Lebar {{ $dbarang->lebarban }}</span>        
          <span class="badge bg-secondary me-1 mt-2">Rasio {{ $dbarang->rasioban }}</span>
        @endif
        @if ($dbarang->rasioban!='')
          <span class="badge bg-secondary me-1 mt-2">Diameter {{ $dbarang->diameterban }}</span>
        @endif
        <div class="input-group mt-2 groupqty">
          <span class="input-group-text" id="basic-addon1">Qty</span>
          <input type="hidden" name="idb" value="{{$dbarang->idbrg}}">
          <input type="number" min="1" value="1" name="qty" class="form-control qty @error('qty') is-invalid @enderror" required>
          <div class="invalid-feedback">
            @error('qty')
              {{ $message }}
            @enderror
          </div>
        </div>
        
        <div class="mt-3 d-grid">
          <button type="submit" class="btn btn-success btn-block">Tambah ke Keranjang</button>
        </div>
      </div>
      
      
    </div>
  </div>
  </form>
  <div class="card mt-2 fs-13">
    <div class="card-body">
      <div>
        <p class="fw-13"> INFO SERVIS </p>
        <p>
          {{ $dbarang->infoservis }}
        </p>
      </div>
      <div class="mt-2">
        <p class="fw-13"> DETAIL PRODUK </p>
        <p>
          {{ $dbarang->detail }}
        </p>
      </div>
    </div>
  </div>

  
  @endsection