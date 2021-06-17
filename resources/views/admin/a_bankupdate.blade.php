@extends('admin.a_layout')
@section('judulweb')
    Admin - Bank
@endsection

@section('content')
<div>
  <h4 class="mt-3 pb-3 border-bottom text-center">DATA BANK</h4>
  <div class="my-4 p-3">
    <form method="POST" action="/adminpage/bank/updateproses/{{$bank->idbank}}">
      @csrf
      <div class="">
        <div class="mb-3">
          <label for="namabank" class="col-form-label">Nama Bank :</label>
          <input type="text" class="form-control @error('namabank') is-invalid @enderror" name="namabank" id="namabank" value="{{old('namabank',$bank->namabank)}}">
          <div class="invalid-feedback">
            @error('namabank')
              {{ $message }}
            @enderror
          </div>
        </div>
        <div class="mb-3">
          <label for="namarek" class="col-form-label">Nama Rekening :</label>
          <input type="text" class="form-control @error('namarek') is-invalid @enderror" name="namarek" id="namarek" value="{{old('namarek',$bank->namarek)}}">
          <div class="invalid-feedback">
            @error('namarek')
              {{ $message }}
            @enderror
          </div>
        </div>
        <div class="mb-3">
          <label for="norek" class="col-form-label">Nomor Rekening :</label>
          <input type="text" class="form-control @error('norek') is-invalid @enderror" name="norek" id="norek" value="{{old('norek',$bank->norek)}}">
          <div class="invalid-feedback">
            @error('norek')
              {{ $message }}
            @enderror
          </div>
        </div>
      </div>
      <div class="border-top mt-5 pt-3 text-end">
        <a href="/adminpage/bank" class="btn btn-secondary">Batal</a>
        <button type="submit" class="btn btn-primary">Ubah Data</button>
      </div>
    </form>
  </div>
</div>
    
@endsection