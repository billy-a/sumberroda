@extends('admin.a_layout')
@section('judulweb')
    Admin - Merek
@endsection

@section('content')
<div>
  <h4 class="mt-3 pb-3 border-bottom text-center">DATA MEREK</h4>
  <div class="my-4 p-3">
    <form method="POST" action="/adminpage/merek/addproses">
      @csrf
      <div class="">
          <div class="mb-3">
            <label for="kodemerek" class="col-form-label">Kode Merek :</label>
            <input type="text" class="form-control @error('kodemerek') is-invalid @enderror" name="kodemerek" id="kodemerek" value="{{old('kodemerek')}}">
            <div class="invalid-feedback">
              @error('kodemerek')
                {{ $message }}
              @enderror
            </div>
          </div>
          <div class="mb-3">
            <label for="namamerek" class="col-form-label">Nama Merek :</label>
            <input type="text" class="form-control @error('namamerek') is-invalid @enderror" name="namamerek" id="namamerek" value="{{old('namamerek')}}">
            <div class="invalid-feedback">
              @error('namamerek')
                {{ $message }}
              @enderror
            </div>
          </div>
      </div>
      <div class="border-top mt-5 pt-3 text-end">
        <a href="/adminpage/merek" class="btn btn-secondary">Batal</a>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
    </form>
  </div>
</div>
    
@endsection