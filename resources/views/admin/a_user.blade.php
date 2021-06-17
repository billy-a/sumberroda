@extends('admin.a_layout')
@section('judulweb')
    Admin - User
@endsection

@section('content')
<div>
  <h4 class="mt-3 pb-3 border-bottom text-center">DATA USER</h4>

  @if (session('pesan'))
  <div class="mt-4 alert alert-success alert-dismissible fade show" role="alert">
    {{ session('pesan') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>    
  @endif
{{-- 
  <div class="my-4">
    <a class="btn btn-primary" href="/adminpage/merek/add">Tambah Data Merek</a>
  </div> --}}



  <div class="mt-2">
    <div class="card">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table user-table no-wrap">
            <thead>
                <tr>
                    <th class="border-top-0">#</th>
                    <th class="border-top-0">Nama</th>
                    <th class="border-top-0">Email</th>
                    <th class="border-top-0">No. HP</th>
                    <th class="border-top-0">Level</th>
                    <th class="border-top-0">Action</th>
                </tr>
            </thead>
            <tbody>
              <?php $i=1; ?>
              @foreach ($user as $p)
              <?php 
                if($p->level==1){
                  $level = 'User';
                }elseif($p->level==2){
                  $level = 'Admin';
                }elseif($p->level==3){
              ?>
                  @continue
              <?php
                }
              ?>
              <tr>
                  <td>{{ $i++ }}</td>
                  <td>{{$p->name}}</td>
                  <td>{{$p->email}}</td>
                  <td>{{$p->nohp}}</td>
                  <td>{{$level}}</td>
                  <td>
                    <button type="button" class="btn btn-sm btn-outline-success del" @if($p->level==2) disabled @endif data-bs-toggle="modal" data-bs-target="#staticBackdrop" data-id="{{$p->id}}" data-nama="{{$p->email}}" data-value="up"><i class="far fa-caret-square-up"></i> Naikan Hak Akses</button>
                    <button type="button" class="btn btn-sm btn-outline-danger del" @if($p->level==1) disabled @endif data-bs-toggle="modal" data-bs-target="#staticBackdrop" data-id="{{$p->id}}" data-nama="{{$p->email}}" data-value="down"><i class="far fa-caret-square-down"></i> Turunkan Hak Akses</button>
                  </td>
              </tr>

              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
    

<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Ubah Hak Akses (<span id='mnama'></span>)</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Yakin ingin mengubah hak akses user ini ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <a href="#" id="modaldel" class="btn btn-primary">Ya</a>
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(function(){
  $('.del').on('click',function(){
    var id = $(this).attr('data-id');
    var nama = $(this).attr('data-nama');
    var value = $(this).attr('data-value');
    $('#mnama').html(nama);
    $('#modaldel').attr('href','/adminpage/user/update/'+value+'/'+id);
  })
})
</script>
@endsection