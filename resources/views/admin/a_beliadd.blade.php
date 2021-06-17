@extends('admin.a_layout')
@section('judulweb')
    Admin - Pembelian
@endsection

@section('content')
<div>
  <h4 class="mt-3 pb-3 border-bottom text-center">TRANSAKSI PEMBELIAN</h4>
  
  @if (session('pesan'))
  <div class="mt-4 alert alert-success alert-dismissible fade show" role="alert">
    {{ session('pesan') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>    
  @endif
</div>

<div class="mt-4">
  <div class="card">
    <div class="card-body">
      <div class="">
        <form method="POST" action="/adminpage/pembelian/addproses">      
          @csrf
          <div class="row g-3">
            <div class="col-md-3">
              <label for="kodebrg" class="form-label">Kode Barang</label>
              <input type="hidden" name="idbrg" id="idbrg" value="{{old('idbrg')}}">
              <input class="form-control @error('kodebrg') is-invalid @enderror" list="kodebrgOptions" id="kodebrg" name="kodebrg" value="{{old('kodebrg')}}">
              <datalist id="kodebrgOptions">
                @foreach ($barang as $b)
                  <option value="{{$b->kodebrg}}">                
                @endforeach
              </datalist>
              <div class="invalid-feedback d-block">
                @error('kodebrg')
                  {{ $message }}              
                @enderror
              </div>
            </div>
            <div class="col-md-4">
              <label for="namabrg" class="form-label">Nama Barang</label>
              <input type="text" class="form-control" id="namabrg" name="namabrg" value="{{old('namabrg')}}" readonly>
            </div>
            <div class="col-md-2">
              <label for="qty" class="form-label">Qty</label>
              <input type="number" min="1" class="form-control @error('qty') is-invalid @enderror" id="qty" name="qty" value="{{old('qty',1)}}">
              <div class="invalid-feedback d-block">
                @error('qty')
                  {{ $message }}              
                @enderror
              </div>
            </div>
            <div class="col-md-3">
              <label for="hargabeli" class="form-label">Harga Beli</label>
              <input type="text" class="form-control @error('hargabeli') is-invalid @enderror" id="hargabeli" name="hargabeli" value="{{old('hargabeli')}}">
              <div class="invalid-feedback d-block">
                @error('hargabeli')
                  {{ $message }}              
                @enderror
              </div>
            </div>
          </div>
    
          <div class="border-top mt-2 pt-3 text-end">
            <button type="submit" class="btn btn-primary">Tambah</button>
          </div>
        </form>
      </div>
      <div class="table-responsive">
        <table class="table user-table no-wrap">
          <thead>
              <tr>
                  <th class="border-top-0">#</th>
                  <th class="border-top-0">Kode Barang</th>
                  <th class="border-top-0">Qty</th>
                  <th class="border-top-0">Hargabeli</th>
                  <th class="border-top-0">Total</th>
                  <th class="border-top-0">Action</th>
              </tr>
          </thead>
          <tbody>
          <?php $i=1; ?>
          @foreach ($tblbeli as $t)
              <tr>
                <td>{{ $i++ }}</td>
                <td>{{$t->kodebrg}}</td>
                <td>{{$t->qty}}</td>
                <td>{{$t->hargabeli}}</td>
                <td>{{$t->qty * $t->hargabeli}}</td>
                <td>
                  <a href="/adminpage/pembelian/delete/{{$t->idbelitemp}}" type="button" class="btn btn-sm btn-outline-danger"><i class="far fa-trash-alt"></i> Delete</a>
                </td>
              </tr>
          @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<div>
  <div class="my-4 p-3">
    <form method="POST" action="/adminpage/pembelian/simpanproses">      
      @csrf
      <div class="row g-3">
        <div class="col-md-4">
          <label for="idbeli" class="form-label">No Beli</label>
          <input type="text" class="form-control @error('idbeli') is-invalid @enderror" id="idbeli" name="idbeli" value="{{$idbeli}}" readonly>
          <div class="invalid-feedback d-block">
            @error('idbeli')
              {{ $message }}              
            @enderror
          </div>
        </div>
        <div class="col-md-4">
          <label for="tgl" class="form-label">Tanggal</label>
          <input type="text" class="form-control @error('tgl') is-invalid @enderror" id="tgl" name="tgl" value="{{old('tgl',date('Y-m-d'))}}" readonly>
          <div class="invalid-feedback d-block">
            @error('tgl')
              {{ $message }}              
            @enderror
          </div>
        </div>
        <div class="col-4">
          <label for="idsupplier" class="form-label">Supplier</label>
          <select id="idsupplier" class="form-select @error('idsupplier') is-invalid @enderror" name="idsupplier">
            <option>Choose...</option>
            @foreach ($supplier as $s)
              <option value="{{$s->idsupplier}}" {{ old('idsupplier') == $s->idsupplier ? " selected" : "" }}>{{$s->namasupp}}</option>     
            @endforeach
          </select>
          <div class="invalid-feedback d-block">
            @error('idsupplier')
              {{ $message }}              
            @enderror
          </div>
        </div>
      </div>

      <div class="border-top mt-2 pt-3 text-end">
        <button type="submit" class="btn btn-success">Simpan Transaksi</button>
      </div>
    </form>
  </div>
</div>
<script>
$(document).ready(function(){
  $('#kodebrg').change(function(){
    var kodebrg = $(this).val();
    if(kodebrg!=""){
      ajaxpr(kodebrg);
    }
  });

  var wto;

  $('#kodebrg').keyup(function(){
    clearTimeout(wto);
    wto = setTimeout(function() {
      var kodebrg = $('#kodebrg').val();
      if(kodebrg!=""){
        ajaxpr(kodebrg);
      }
    }, 1000);
  });

  
})

function ajaxpr(kodebrg){
  $.ajax({
    url:"/adminpage/pembelian/add/barang?kodebrg="+kodebrg,
    success:function(data)
    {            
      var split = data.split('|');
      if(split[0]=="B"){
        $('#namabrg').val(split[2]);
        $('#idbrg').val(split[1]);
      }else{
        $('#namabrg').val("");
        $(this).focus();
      }
    }
  });
}
</script>
    
@endsection