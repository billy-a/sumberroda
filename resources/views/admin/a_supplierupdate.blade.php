@extends('admin.a_layout')
@section('judulweb')
    Admin - Supplier
@endsection

@section('content')
<div>
  <h4 class="mt-3 pb-3 border-bottom text-center">DATA SUPPLIER</h4>
  <div class="my-4 p-3">
    <form method="POST" action="/adminpage/supplier/updateproses/{{$supplier->idsupplier}}">
      @csrf
      <div class="">
          <div class="mb-3">
            <label for="namasupp" class="col-form-label">Nama Supplier :</label>
            <input type="text" class="form-control @error('namasupp') is-invalid @enderror" name="namasupp" id="namasupp" value="{{old('namasupp',$supplier->namasupp)}}">
            <div class="invalid-feedback">
              @error('namasupp')
                {{ $message }}
              @enderror
            </div>
          </div>
          <div class="mb-3">
            <label for="alamatsupp" class="col-form-label">Alamat Supplier :</label>
            <textarea class="form-control @error('alamatsupp') is-invalid @enderror" name="alamatsupp" id="alamatsupp">{{old('alamatsupp',$supplier->alamatsupp)}}</textarea>
            <div class="invalid-feedback">
              @error('alamatsupp')
                {{ $message }}
              @enderror
            </div>
          </div>
          <div class="mb-3">
            <label for="nohpsupp" class="col-form-label">No. HP Supplier :</label>
            <input type="text" class="form-control @error('nohpsupp') is-invalid @enderror" name="nohpsupp" id="nohpsupp" value="{{old('nohpsupp',$supplier->nohpsupp)}}">
            <div class="invalid-feedback">
              @error('nohpsupp')
                {{ $message }}
              @enderror
            </div>
          </div>
      </div>
      <div class="border-top mt-5 pt-3 text-end">
        <a href="/adminpage/supplier" class="btn btn-secondary">Batal</a>
        <button type="submit" class="btn btn-primary">Ubah Data</button>
      </div>
    </form>
  </div>
</div>
    
@endsection