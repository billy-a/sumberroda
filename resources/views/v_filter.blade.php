@extends('v_layout.v_layout')

@section('judulweb')
    Sumber Roda - Cari
@endsection

@section('linkcss')
  <link href="{{asset('desain/css/profil.css')}}" rel="stylesheet">
@endsection

@section('content')
<h5 class="text-center mt-3 pb-2 border-bottom"> HASIL PENCARIAN </h5>
<div class="w-100 mt-4">
  <div class="text-end">
    <button class="btn btn-outline-success @if(Request::get('min') || Request::get('max') || Request::get('merek') || Request::get('lebar') || Request::get('rasio') || Request::get('diameter')) active @endif" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasWithBackdrop" aria-controls="offcanvasWithBackdrop"><i class="fas fa-filter"></i> Filter</button>
  </div>
  <div class="row g-1"  id="ubahisi">

    @foreach($barang as $p)  

    <div class="col-6 col-sm-4 col-md-3 kotakzoom">
      <a class="itemb" href="/home/dbarang/{{$p->idbrg}}" >
      <div class="card h-100">
        <img src="{{ url('assets/'.$p->gambar)}}" alt="" class="card-img-top">
        <div class="card-body">
          <p class="card-text fs-13">{{ $p->namabrg }}</p>
          <h5 class="card-text text-success">Rp. {{number_format($p->hargajual,0,',','.')}}</h5>       
        </div>
      </div>
      </a>
    </div>

    @endforeach

  </div>
</div>

<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasWithBackdrop" aria-labelledby="offcanvasWithBackdropLabel">
  <?php 
    $jenisfilter = explode('|',$kategori->filter);    
  ?>
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasWithBackdropLabel">Filter Barang</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body small">
    <form id="formfilter" method="GET">
    <div class="row g-4">

      @if(in_array('harga', $jenisfilter))
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">Harga</div>
          <div class="card-body">
            <div class="input-group mb-2">
              <span class="input-group-text" id="basic-addon1">Rp</span>
              <input type="text" class="form-control" placeholder="Harga Minimum" name="min" aria-label="Minimum" aria-describedby="basic-addon1" value="{{Request::get('min')}}">
            </div>
            <div class="input-group">
              <span class="input-group-text" id="basic-addon1">Rp</span>
              <input type="text" class="form-control" placeholder="Harga  Maksimum" name="max" aria-label="Maksimum" aria-describedby="basic-addon1" value="{{Request::get('max')}}">
            </div>
          </div>
        </div>
      </div>
      @endif

      @if(in_array('merek', $jenisfilter))
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">Merek</div>
          <div class="card-body">
            <select class="form-select form-select-sm" name="merek" aria-label=".form-select-sm example">
              <option selected value="">Merek</option>
              @foreach ($merek as $m)                  
                <option value="{{$m->id}}">{{$m->namamerek}}</option>
              @endforeach
            </select>
          </div>
        </div>
      </div>
      @endif

      @if(in_array('lebar', $jenisfilter))
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">Lebar Ban</div>
          <div class="card-body">
            <select class="form-select form-select-sm" name="lebar" aria-label=".form-select-sm example">
              <option selected value="">Lebar Ban</option>
              @foreach ($lebar as $l)                  
                <option value="{{$l->lebarban}}">{{$l->lebarban}}</option>
              @endforeach
            </select>
          </div>
        </div>
      </div>
      @endif
      

      @if(in_array('rasio', $jenisfilter))
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">Rasio Ban</div>
          <div class="card-body">
            <select class="form-select form-select-sm" name="rasio" aria-label=".form-select-sm example">
              <option selected value="">Rasio Ban</option>
              @foreach ($rasio as $r)                  
                <option value="{{$r->rasioban}}">{{$r->rasioban}}</option>
              @endforeach
            </select>
          </div>
        </div>
      </div>
      @endif

      
      @if(in_array('ring', $jenisfilter))
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">Diameter Ban</div>
          <div class="card-body">
            <select class="form-select form-select-sm" name="diameter" aria-label=".form-select-sm example">
              <option selected value="">Diameter Ban</option>
              @foreach ($diameter as $d)                  
                <option value="{{$d->diameterban}}">{{$d->diameterban}}</option>
              @endforeach
            </select>
          </div>
        </div>
      </div>
      @endif

      <div class="col-md-12 d-grid">
        <button class="btn btn-success" id="filternow">Filter</button>
        <a href="{{url()->current()}}" class="btn btn-outline-danger mt-2" id="filternow">Clear Filter</a>
      </div>
    </div>
    </form>
  </div>
</div>
<script>
function removeParams(sParam)
{
  var url = window.location.href.split('?')[0]+'?';
  var sPageURL = decodeURIComponent(window.location.search.substring(1)),
      sURLVariables = sPageURL.split('&'),
      sParameterName,
      i;

  for (i = 0; i < sURLVariables.length; i++) {
      sParameterName = sURLVariables[i].split('=');
      if (sParameterName[0] != sParam) {
          url = url + sParameterName[0] + '=' + sParameterName[1] + '&'
      }
  }
  return url.substring(0,url.length-1);
}

$(document).ready(function(){
  $('#filternow').click(function(){
    var url = $('formfilter').serialize();
    console.log(url);
  })
})
</script>
@endsection