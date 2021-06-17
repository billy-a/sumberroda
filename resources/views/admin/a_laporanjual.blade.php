@extends('admin.a_layout')
@section('judulweb')
    Admin - Laporan Jual
@endsection

@section('content')
<style>
td[rowspan]{
  vertical-align: middle;
}
</style>

<div>
  <h4 class="mt-3 pb-3 border-bottom text-center">LAPORAN PENJUALAN</h4>

  @if (session('pesan'))
  <div class="mt-4 alert alert-success alert-dismissible fade show" role="alert">
    {{ session('pesan') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>    
  @endif
  <!-- 
  <div class="my-4">
    <a class="btn btn-primary" href="/adminpage/kategori/add">Tambah Data Kategori</a>
  </div> -->
  <form method="GET" class="mb-3">
    <div class="row g-2">
      <div class="col-md-12 mt-3">
        <h6>LAPORAN HARIAN</h6>
      </div>

      <div class="col-md-2">
        <div class="form-floating">
          <input type="date" class="form-control" value="@if(Request::get('dari')){{Request::get('dari')}}@endif" max="@if(Request::get('sampai')){{Request::get('sampai')}}@else{{date('Y-m-d')}}@endif" id="dari" name="dari">
          <label>Dari Tanggal</label>
        </div>
      </div>
      <input type="hidden" class="form-control" value="1" name="jenis">
      <div class="col-md-2">
        <div class="form-floating">
          <input type="date" class="form-control" value="@if(Request::get('sampai')){{Request::get('sampai')}}@endif" max="{{date('Y-m-d')}}" id="sampai" name="sampai">
          <label>Sampai Tanggal</label>
        </div>
      </div><!-- 
      <div class="col-md-2">
        <div class="form-floating">
          <select class="form-select" name="jenis">
            <option value="1" @if(Request::get('jenis')=="1") selected @endif>Harian</option>
            <option value="2" @if(Request::get('jenis')=="2") selected @endif>Bulanan</option>
          </select>
          <label>Laporan</label>
        </div>
      </div> -->
      <div class="col-md-2 d-grid">
        <button type="submit" class="btn btn-primary" name="tampil" value="tampil">Tampilkan</button>
      </div>
      <div class="col-md-2 d-grid">
        <button type="submit" class="btn btn-success" name="cetak" value="cetak">Cetak</button>
      </div>
      <div class="col-md-2 d-grid">
        <a href="{{url()->current()}}" class="btn btn-outline-danger d-flex justify-content-center align-items-center">Clear</a>
      </div>
    </div>
  </form>

  <form method="GET" class="mb-3">
    <div class="row g-2">
      <div class="col-md-12 mt-3">
        <h6>LAPORAN BULANAN</h6>
      </div>
      <input type="hidden" class="form-control" value="2" name="jenis">
      <div class="col-md-2">
        <div class="form-floating">
          <input type="month" class="form-control" value="@if(Request::get('bulan')){{Request::get('bulan')}}@endif" max="{{date('Y-m')}}" id="bulan" name="bulan">
          <label>Bulan</label>
        </div>
      </div><!-- 
      <div class="col-md-2">
        <div class="form-floating">
          <select class="form-select" name="jenis">
            <option value="1" @if(Request::get('jenis')=="1") selected @endif>Harian</option>
            <option value="2" @if(Request::get('jenis')=="2") selected @endif>Bulanan</option>
          </select>
          <label>Laporan</label>
        </div>
      </div> -->
      <div class="col-md-2 d-grid">
        <button type="submit" class="btn btn-primary" name="tampil" value="tampil">Tampilkan</button>
      </div>
      <div class="col-md-2 d-grid">
        <button type="submit" class="btn btn-success" name="cetak" value="cetak">Cetak</button>
      </div>
      <div class="col-md-2 d-grid">
        <a href="{{url()->current()}}" class="btn btn-outline-danger d-flex justify-content-center align-items-center">Clear</a>
      </div>
    </div>
  </form>

  <div class="mt-2">
    @if(Request::get('jenis')==1 || Request::get('jenis')==null)

    <div class="card">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table user-table no-wrap">
            <thead>
                <tr>
                    <th class="border-top-0">#</th>
                    <th class="border-top-0">Tgl Pesan</th>
                    <th class="border-top-0">No Pesanan</th>
                    <th class="border-top-0">Pembeli</th>
                    <th class="border-top-0">Bank</th>                
                    <th class="border-top-0">Nama Barang</th>
                    <th class="border-top-0">Qty</th>
                    <th class="border-top-0">Total</th>
                    <th class="border-top-0">Subtotal</th>
                </tr>
            </thead>
            <tbody>
              <?php 
                $i=1;
                $gt = 0;
              ?>
              @foreach ($jual as $p)              
              <tr>
                <td rowspan="{{$p->count}}">{{ $i++ }}</td>
                <td rowspan="{{$p->count}}">{{$p->tglpesan}}</td>
                <td rowspan="{{$p->count}}">{{$p->idjual}}</td>
                <td rowspan="{{$p->count}}">{{$p->name}}</td>
                <td rowspan="{{$p->count}}">{{$p->namabank}}</td>          
                @foreach($jualdetil as $jd)
                  @if($jd-> idjual == $p->idjual)
                    <td>{{$jd->namabrg}}</td>
                    <td>{{$jd->qty}}</td>                            
                    <td>{{$jd->total}}</td>                            
                  @break                    
                  @endif
                @endforeach
                <td rowspan="{{$p->count}}">{{$p->subtotal}}</td>
              </tr>
                <?php $a = 0; ?>
                @foreach($jualdetil as $jd)
                  @if($jd->idjual == $p->idjual && $a == 0)
                    <?php $a = 1; ?>                    
                  @elseif($jd->idjual == $p->idjual && $a == 1)
                    <tr>
                      <td>{{$jd->namabrg}}</td>
                      <td>{{$jd->qty}}</td>
                      <td>{{$jd->total}}</td>
                    </tr>
                  @endif
                @endforeach
                <?php
                  $gt = $gt + $p->subtotal;
                ?>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
      <div class="card-footer text-end">
        Grand Total : 
        <h5 class="d-inline">
          Rp. {{$gt}}
        </h5>
      </div>
    </div>

    @elseif(Request::get('jenis')=='2')

    <div class="card">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table user-table no-wrap">
            <thead>
                <tr>
                    <th class="border-top-0">Tanggal</th>
                    <th class="border-top-0">Nama Barang</th>
                    <th class="border-top-0">Jumlah</th>
                    <th class="border-top-0">Total</th>
                </tr>
            </thead>
            <tbody>              
              <?php 
                $i=1;
                $gt = 0;
              ?>
              @foreach ($jual as $p)
              <tr>
                <td rowspan="{{$jualdetil->where('tglpes',$p->tglpes)->count()}}">{{$p->tglpes}}</td>
                @foreach ($jualdetil as $pp)
                  @if($p->tglpes == $pp->tglpes)
                  <td>{{$pp->namabrg}}</td>
                  <td>{{$pp->qtys}}</td>
                  <td>{{$pp->gt}}</td>
                  <?php $gt = $gt + $pp->gt; ?>
                  @break               
                  @endif     
                @endforeach
              </tr>
              
              <?php $a = 0; ?>
                @foreach($jualdetil as $ppp)
                  @if($pp->namabrg != $ppp->namabrg && $p->tglpes == $ppp->tglpes)
                    <tr>
                      <td>{{$ppp->namabrg}}</td>
                      <td>{{$ppp->qtys}}</td>
                      <td>{{$ppp->gt}}</td>
                      <?php $gt = $gt + $ppp->gt; ?>
                    </tr>
                  @endif
                @endforeach
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
      <div class="card-footer text-end">
        Grand Total : 
        <h5 class="d-inline">
          Rp. {{$gt}}
        </h5>
      </div>
    </div>

    @endif
  </div>

</div>

<script>
  $(document).ready(function(){
    $('#sampai').change(function(){
      var dari = $('#dari').val();
      var sampai = $(this).val();
      var sampaidate = new Date(sampai);
      var daridate = new Date(dari);
      if(daridate > sampaidate){
        $('#dari').val(sampai);
      }
      $('#dari').attr('max',sampai);
    });
  })
</script>
@endsection