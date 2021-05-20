@extends('v_layout.v_layout')

@section('judulweb')
    Sumber Roda - Home
@endsection

@section('linkcss')
  <link href="{{asset('desain/css/home.css')}}" rel="stylesheet">
@endsection


@section('content')
  <div class="card mt-4 fs-13">
    <div class="card-body text-center">
      <div class="card-title">KATEGORI</div>
      <div class="isikategori">
        <button class="btn btn-success btn-sm m-1">Ban</button>
        <button class="btn btn-success btn-sm m-1">Velg</button>
        <button class="btn btn-success btn-sm m-1">Oli</button>
        <button class="btn btn-success btn-sm m-1">Aki</button>
      </div>
    </div>
  </div>
  <div class="card mt-4 fs-13" style="background-color: rgb(236, 236, 236);">
    <div class="card-body">
      <div class="card-title">CARI BAN</div>

      <div class="card mt-2">
        <div class="card-body">
          <div class="row">
            <div class="col-12 col-sm-4">              
              <label for="lebar" class="form-label">Lebar</label>
              <input type="text" class="form-control form-control-sm" id="lebar" placeholder="Lebar">
            </div>
            <div class="col-12 col-sm-4">              
              <label for="rasio" class="form-label">Rasio</label>
              <input type="text" class="form-control form-control-sm" id="rasio" placeholder="Rasio">
            </div>
            <div class="col-12 col-sm-4">              
              <label for="ring" class="form-label">Ring</label>
              <input type="text" class="form-control form-control-sm" id="ring" placeholder="Ring">
            </div>
            <div class="col-12 d-grid mt-3">
              <button type="submit" class="btn btn-success">LOGIN</button>
            </div>
          </div>
        </div>
      </div>
{{-- 
      <div class="card mt-2">
        <div class="card-body">
          Cari Ban Berdasarkan Tipe Mobil
        </div>
      </div> --}}
    </div>
  </div>

  <div class="w-100">
    <div class="row mt-4 g-1"  id="ubahisi">
      @include('p_ajax.v_barangproses')
    </div>
  </div>
  
  <div class="mt-4 text-center d-none" id="nodatalg">
    <h4 class="text-secondary" >No More Data</h4>
  </div>

  <div class="mt-4 text-center" id="loadingla">
    <div class="spinner-grow text-success" role="status">
      <span class="visually-hidden">Loading...</span>
    </div>
    <div class="spinner-grow text-danger" role="status">
      <span class="visually-hidden">Loading...</span>
    </div>
    <div class="spinner-grow text-warning" role="status">
      <span class="visually-hidden">Loading...</span>
    </div>
    <div class="spinner-grow text-info" role="status">
      <span class="visually-hidden">Loading...</span>
    </div>
  </div>
  
  <input type="hidden" id="datahal" value="2">
  
  <script>
    $(document).ready(function(){
    //  $(document).on('click', '.pagination a', function(event){
    //   event.preventDefault(); 
    //   var page = $(this).attr('href').split('page=')[1];
    //   fetch_data(page);
    //  });

    $(window).scroll(function(){
      if($(window).scrollTop() >= $(document).height() - $(window).height()) {
        var page = parseInt($('#datahal').val());
        $.ajax({
          url:"get_barang?page="+page,
          success:function(data)
          {
            console.log(data);
            if($.trim(data)=='empty'){
              $('#loadingla').addClass('d-none');
              $('#nodatalg').removeClass('d-none');
            }else{
              var pagea = page + 1;
              $('#datahal').val(pagea);
              $('#ubahisi').append(data);
            }            
          }
        });
      }
    });

    //  function fetch_data(page)
    //  {
    //   $.ajax({
    //    url:"get_barang?page="+page,
    //    success:function(data)
    //    {
    //     $('#ubahisi').html(data);
    //    }
    //   });
    //  }
     
    });
    </script>
@endsection
