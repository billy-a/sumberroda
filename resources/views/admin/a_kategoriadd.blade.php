@extends('admin.a_layout')
@section('judulweb')
    Admin - Kategori
@endsection

@section('content')
<div>
  <h4 class="mt-3 pb-3 border-bottom text-center">DATA KATEGORI</h4>
  <div class="my-4 p-3">
    <form method="POST" action="/adminpage/kategori/addproses">
      @csrf
      <div class="">
          <div class="mb-3">
            <label for="namakategori" class="col-form-label">Nama Kategori :</label>
            <input type="text" class="form-control @error('namakategori') is-invalid @enderror" name="namakategori" id="namakategori" value="{{old('namakategori')}}">
            <div class="invalid-feedback">
              @error('namakategori')
                {{ $message }}
              @enderror
            </div>
          </div>
          <div class="mb-3">
            <label class="col-form-label d-block">Filter :</label>
            {{-- <input type="text" class="form-control @error('filter') is-invalid @enderror" name="filter" id="filter" value="{{old('filter')}}"> --}}
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="checkbox" name="filter[]" id="filter1" value="harga" {{ (is_array(old('filter')) && in_array('harga', old('filter'))) ? ' checked' : '' }}>
              <label class="form-check-label" for="filter1">
                Harga
              </label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="checkbox" name="filter[]" id="filter2" value="merek" {{ (is_array(old('filter')) && in_array('merek', old('filter'))) ? ' checked' : '' }}>
              <label class="form-check-label" for="filter2">
                Merek
              </label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="checkbox" name="filter[]" id="filter3" value="lebar" {{ (is_array(old('filter')) && in_array('lebar', old('filter'))) ? ' checked' : '' }}>
              <label class="form-check-label" for="filter3">
                Lebar Ban
              </label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="checkbox" name="filter[]" id="filter4" value="rasio" {{ (is_array(old('filter')) && in_array('rasio', old('filter'))) ? ' checked' : '' }}>
              <label class="form-check-label" for="filter4">
                Rasio Ban
              </label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="checkbox" name="filter[]" id="filter5" value="ring" {{ (is_array(old('filter')) && in_array('ring', old('filter'))) ? ' checked' : '' }}>
              <label class="form-check-label" for="filter5">
                Ring Ban
              </label>
            </div>
            
            <div class="invalid-feedback d-block">
              @error('filter')
                {{ $message }}              
              @enderror
            </div>
          </div>
      </div>
      <div class="border-top mt-5 pt-3 text-end">
        <a href="/adminpage/kategori" class="btn btn-secondary">Batal</a>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
    </form>
  </div>
</div>
    
@endsection