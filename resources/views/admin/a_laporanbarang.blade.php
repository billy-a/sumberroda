@extends('admin.a_layout')
@section('judulweb')
    Admin - Laporan Persediaan
@endsection

@section('content')
<style>
td[rowspan]{
  vertical-align: middle;
}
</style>

<div>
  <h4 class="mt-3 pb-3 border-bottom text-center">LAPORAN PERSEDIAAN</h4>

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
  <form method="GET">
    <div class="row g-2">
      <div class="col-md-2">
        <div class="form-floating">
          <input type="text" class="form-control" name="key" placeholder="Nama Barang" value="{{Request::get('key')}}">
          <label>Nama Barang</label>
        </div>
      </div>
      <div class="col-md-2">
        <div class="form-floating">
          <select class="form-select" name="m">
            <option selected value="">Semua</option>
            @foreach ($merek as $m)
              <option value="{{$m->id}}" @if(Request::get('m')==$m->id) selected @endif>{{$m->namamerek}}</option>                
            @endforeach
          </select>
          <label>Merek</label>
        </div>
      </div>
      <div class="col-md-2">
        <div class="form-floating">
          <select class="form-select" name="ktg">
            <option selected value="">Semua</option>
            @foreach ($kategori as $k)
              <option value="{{$k->idkategori}}" @if(Request::get('ktg')==$k->idkategori) selected @endif>{{$k->namakategori}}</option>                
            @endforeach
          </select>
          <label>Kategori</label>
        </div>
      </div>
      <div class="col-md-2 d-grid">
        <button type="submit" class="btn btn-primary" name="tampil" value="tampil">Tampilkan</button>
      </div>
      <div class="col-md-2 d-grid">
        <button type="submit" class="btn btn-success" name="cetak" value="cetak">Cetak</button>
      </div>
      <div class="col-md-2 d-grid">
        <a href="{{url()->current()}}" class="btn btn-outline-danger d-flex justify-content-center align-items-center">Clear Filter</a>
      </div>
    </div>
  </form>

  <div class="mt-2">
    <div class="card">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table user-table no-wrap">
            <thead>
                <tr>
                    <th class="border-top-0">#</th>
                    <th class="border-top-0">Kategori</th>
                    <th class="border-top-0">Merek</th>
                    <th class="border-top-0">Kode Barang</th>
                    <th class="border-top-0">Nama Barang</th>               
                    <th class="border-top-0">Stok</th>
                </tr>
            </thead>
            <tbody>
              <?php $i=1; ?>
              @foreach ($barang as $p)
                                
              <tr>
                  <td>{{ $i++ }}</td>
                  <td>{{$p->namakategori}}</td>
                  <td>{{$p->namamerek}}</td>
                  <td>{{$p->kodebrg}}</td>
                  <td>{{$p->namabrg}}</td>
                  <td>{{$p->stok}}</td>
              </tr>

              @endforeach
            </tbody>
          </table>
        </div>
        <div>
          {{$barang->links('pagination::bootstrap-4')}}
        </div>
      </div>
    </div>
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