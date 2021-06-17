@extends('admin.a_layout')
@section('judulweb')
    Admin - Barang
@endsection

@section('content')
<div>
  <h4 class="mt-3 pb-3 border-bottom text-center">DATA BARANG</h4>
  <div class="my-4 p-3">
    <form method="POST" action="/adminpage/barang/addproses" enctype="multipart/form-data">      
      @csrf
      <div class="row g-3">
        <div class="col-md-6">
          <label for="kodebrg" class="form-label">Kode Barang</label>
          <input type="text" class="form-control @error('kodebrg') is-invalid @enderror" id="kodebrg" name="kodebrg" value="{{old('kodebrg')}}">
          <div class="invalid-feedback d-block">
            @error('kodebrg')
              {{ $message }}              
            @enderror
          </div>
        </div>
        <div class="col-md-6">
          <label for="namabrg" class="form-label">Nama Barang</label>
          <input type="text" class="form-control @error('namabrg') is-invalid @enderror" id="namabrg" name="namabrg" value="{{old('namabrg')}}">
          <div class="invalid-feedback d-block">
            @error('namabrg')
              {{ $message }}              
            @enderror
          </div>
        </div>
        <div class="col-md-4">
          <label for="stok" class="form-label">Stok Awal</label>
          <input type="text" class="form-control @error('stok') is-invalid @enderror" id="stok" name="stok" value="{{old('stok')}}">
          <div class="invalid-feedback d-block">
            @error('stok')
              {{ $message }}              
            @enderror
          </div>
        </div>
        <div class="col-4">
          <label for="idkategori" class="form-label">Kategori</label>
          <select id="idkategori" class="form-select @error('idkategori') is-invalid @enderror" name="idkategori">
            <option data-filter="a|a">Choose...</option>
            @foreach ($kategori as $k)
              <option data-filter="{{$k->filter}}" value="{{$k->idkategori}}" {{ old('idkategori') == $k->idkategori ? " selected" : "" }}>{{$k->namakategori}}</option>     
            @endforeach
          </select>
          <div class="invalid-feedback d-block">
            @error('idkategori')
              {{ $message }}              
            @enderror
          </div>
        </div>
        <div class="col-4">
          <label for="idmerek" class="form-label">Merek</label>
          <select id="idmerek" class="form-select @error('idmerek') is-invalid @enderror" name="idmerek">
            <option>Choose...</option>
            @foreach ($merek as $m)
              <option value="{{$m->id}}" {{ old('idmerek') == $m->id ? " selected" : "" }}>{{$m->namamerek}}</option>                
            @endforeach
          </select>
          <div class="invalid-feedback d-block">
            @error('idmerek')
              {{ $message }}              
            @enderror
          </div>
        </div>
        <div class="col-md-4">
          <label for="lebarban" class="form-label">Lebar Ban</label>
          <input type="text" class="form-control @error('lebarban') is-invalid @enderror" id="lebarban" disabled name="lebarban" value="{{old('lebarban')}}">
          <div class="invalid-feedback d-block">
            @error('lebarban')
              {{ $message }}              
            @enderror
          </div>
        </div>
        <div class="col-md-4">
          <label for="rasioban" class="form-label">Rasio Ban</label>
          <input type="text" class="form-control @error('rasioban') is-invalid @enderror" id="rasioban" disabled name="rasioban" value="{{old('rasioban')}}">
          <div class="invalid-feedback d-block">
            @error('rasioban')
              {{ $message }}              
            @enderror
          </div>
        </div>
        <div class="col-md-4">
          <label for="diameterban" class="form-label">Diameter Ban</label>
          <input type="text" class="form-control @error('diameterban') is-invalid @enderror" id="diameterban" disabled name="diameterban" value="{{old('diameterban')}}">
          <div class="invalid-feedback d-block">
            @error('diameterban')
              {{ $message }}              
            @enderror
          </div>
        </div>
        <div class="col-md-6">
          <label for="infoservis" class="form-label">Info Servis</label>
          <textarea class="form-control @error('infoservis') is-invalid @enderror" name="infoservis" id="infoservis">{{old('infoservis')}}</textarea>
          <div class="invalid-feedback d-block">
            @error('infoservis')
              {{ $message }}              
            @enderror
          </div>
        </div>
        <div class="col-md-6">
          <label for="detail" class="form-label">Detail Barang</label>
          <textarea class="form-control @error('detail') is-invalid @enderror" name="detail" id="detail">{{old('detail')}}</textarea>
          <div class="invalid-feedback d-block">
            @error('detail')
              {{ $message }}              
            @enderror
          </div>
        </div>
        <div class="col-md-6">
          <label for="hargajual" class="form-label">Harga Jual</label>
          <input type="text" class="form-control @error('hargajual') is-invalid @enderror" id="hargajual" name="hargajual" value="{{old('hargajual')}}">
          <div class="invalid-feedback d-block">
            @error('hargajual')
              {{ $message }}              
            @enderror
          </div>
        </div>
        <div class="col-md-6">
          <label for="hargajasa" class="form-label">Harga Jasa</label>
          <input type="text" class="form-control @error('hargajasa') is-invalid @enderror" id="hargajasa" name="hargajasa" value="{{old('hargajasa')}}">
          <div class="invalid-feedback d-block">
            @error('hargajasa')
              {{ $message }}              
            @enderror
          </div>
        </div>
        <div class="col-md-4">
          <label for="gambar" class="form-label">Gambar Barang</label>
          <input class="form-control @error('gambar') is-invalid @enderror" type="file" id="gambar" name="gambar">          
          <div class="invalid-feedback d-block">
            @error('gambar')
              {{ $message }}              
            @enderror
          </div>
        </div>
      </div>
      <div class="border-top mt-5 pt-3 text-end">
        <a href="/adminpage/barang" class="btn btn-secondary">Batal</a>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
    </form>
  </div>
</div>

<script>
  $(document).ready(function(){

    $('#idkategori').change(function(){
      filtering();
    });

    filtering();
  })
  
  function filtering() {      

    filter = $('#idkategori :selected').attr('data-filter');

    if(filter.includes('lebar')){
      $('#lebarban').prop('disabled', false);
    }else{
      $('#lebarban').prop('disabled', true);
    }
    if(filter.includes('rasio')){
      $('#rasioban').prop('disabled', false);
    }else{
      $('#rasioban').prop('disabled', true);
    }
    if(filter.includes('ring')){
      $('#diameterban').prop('disabled', false);
    }else{
      $('#diameterban').prop('disabled', true);
    }
  }

</script>
    
@endsection