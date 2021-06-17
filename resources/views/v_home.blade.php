@extends('v_layout.v_layout')

@section('judulweb')
    Sumber Roda - Home
@endsection

@section('linkcss')
  <link href="{{asset('desain/css/home.css')}}" rel="stylesheet">
@endsection


@section('content')

  @if (session('pesanselesai'))    
  <div class="alert alert-success mt-4 alert-dismissible fade show" role="alert">

    <h5 class="alert-heading">PESANAN #{{session('pesanselesai')}} TELAH SELESAI!</h5>    
    <p>Terima Kasih</p>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

  </div>
  @endif

  <div class="card mt-4 fs-13">
    <div class="card-body">
      <div class="card-title border-bottom">
        <h5>KATEGORI BARANG</h5>
      </div>
      <div class="isikategori text-center">
        @foreach ($kategori as $k)
          <a href="home/search/{{$k->idkategori}}" class="btn btn-success btn-sm m-1">{{$k->namakategori}}</a>            
        @endforeach
      </div>
    </div>
  </div>
  <div class="card mt-4 fs-13">
    <div class="card-body">
      <div class="card-title border-bottom">
        <h5>CARI BAN</h5>
      </div>
      <div class="mx-auto text-center">
        <img class="img-fluid" src="{{url('images/ukuranban.png')}}">
      </div>
      <div class="card mt-2">
        <div class="card-body">
          <form method="GET" action="/home/search/1">
          @csrf
          <div class="row">
            <div class="col-12 col-sm-4">              
              <label for="lebar" class="form-label">Lebar</label>
              <select class="form-select form-select-sm" name="lebar" aria-label=".form-select-sm example">
                <option selected value="">Lebar Ban</option>
                @foreach ($lebar as $l)                  
                  <option value="{{$l->lebarban}}">{{$l->lebarban}}</option>
                @endforeach
              </select>
            </div>
            <div class="col-12 col-sm-4">              
              <label for="rasio" class="form-label">Rasio</label>
              <select class="form-select form-select-sm" name="rasio" aria-label=".form-select-sm example">
                <option selected value="">Rasio Ban</option>
                @foreach ($rasio as $r)                  
                  <option value="{{$r->rasioban}}">{{$r->rasioban}}</option>
                @endforeach
              </select>
            </div>
            <div class="col-12 col-sm-4">              
              <label for="diameter" class="form-label">Diameter</label>
              <select class="form-select form-select-sm" name="diameter" aria-label=".form-select-sm example">
                <option selected value="">Diameter Ban</option>
                @foreach ($diameter as $d)                  
                  <option value="{{$d->diameterban}}">{{$d->diameterban}}</option>
                @endforeach
              </select>
            </div>
            <div class="col-12 d-grid mt-3">
              <button type="submit" class="btn btn-success">Cari Ban</button>
            </div>
          </div>
          </form>
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

  <div class="w-100 mt-4">
    <div class="row g-1"  id="ubahisi">
      @include('p_ajax.v_barangproses')
    </div>
  </div>

  <div class="mt-4 text-center d-grid">
    <button class="btn btn-outline-success" id="moredata">Tampilkan Lebih Banyak</button>
  </div>

  <div class="mt-4 text-center d-none" id="nodatalg">
    <h4 class="text-secondary" >No More Item</h4>
  </div>

  <div class="mt-4 text-center d-none" id="loadingla">
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
  
  <input type="hidden" id="datahal" value="2" data-id="false">
  
  <script>
    $(document).ready(function(){
      // $(window).scroll(function(){
      //   if(($(window).scrollTop() >= $(document).height() - $(window).height()) && $('#datahal').attr('data-id')=='false') {
      //     var page = parseInt($('#datahal').val());
      //     $.ajax({
      //       url:"get_barang?page="+page,
      //       success:function(data)
      //       {
      //         if($.trim(data)=='empty'){
      //           $('#loadingla').addClass('d-none');
      //           $('#datahal').attr('data-id','true');
      //           $('#nodatalg').removeClass('d-none');
      //         }else{
      //           var pagea = page + 1;
      //           $('#datahal').val(pagea);
      //           $('#ubahisi').append(data);
      //         }            
      //       }
      //     });
      //   }
      // });
      $('#moredata').click(function(){
        var page = parseInt($('#datahal').val());

        $.ajax({
          url:"get_barang?page="+page,
          beforeSend: function(){
            $('#loadingla').removeClass('d-none');
            $('#moredata').addClass('d-none');
          },
          success:function(data)
          {
            $('#loadingla').addClass('d-none');

            if($.trim(data)=='empty'){
              $('#datahal').attr('data-id','true');
              $('#nodatalg').removeClass('d-none');
              $('#moredata').addClass('d-none');
            }else{
              var pagea = page + 1;
              $('#datahal').val(pagea);
              $('#ubahisi').append(data);
              $('#moredata').removeClass('d-none');
            }            
          }
        });
      })
    });
    </script>
@endsection
