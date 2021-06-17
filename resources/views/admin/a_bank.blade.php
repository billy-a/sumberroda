@extends('admin.a_layout')
@section('judulweb')
    Admin - Bank
@endsection

@section('content')
<div>
  <h4 class="mt-3 pb-3 border-bottom text-center">DATA BANK</h4>

  @if (session('pesan'))
  <div class="mt-4 alert alert-success alert-dismissible fade show" role="alert">
    {{ session('pesan') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>    
  @endif

  <div class="my-4">
    <a class="btn btn-primary" href="/adminpage/bank/add">Tambah Data Bank</a>
  </div>



  <div class="mt-2">
    <div class="card">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table user-table no-wrap">
            <thead>
                <tr>
                    <th class="border-top-0">#</th>
                    <th class="border-top-0">Nama Bank</th>
                    <th class="border-top-0">Nama Rekening</th>
                    <th class="border-top-0">Nomor Rekening</th>
                    <th class="border-top-0">Action</th>
                </tr>
            </thead>
            <tbody>
              <?php $i=1; ?>
              @foreach ($bank as $p)
                                
              <tr>
                  <td>{{ $i++ }}</td>
                  <td>{{$p->namabank}}</td>
                  <td>{{$p->namarek}}</td>
                  <td>{{$p->norek}}</td>
                  <td>
                    <a href="/adminpage/bank/update/{{$p->idbank}}" class="btn btn-sm btn-outline-success"><i class="far fa-edit"></i> Edit</a>
                    <button type="button" class="btn btn-sm btn-outline-danger del" data-bs-toggle="modal" data-bs-target="#staticBackdrop" data-id="{{$p->idbank}}" data-nama="{{$p->norek}} a.n. {{$p->namarek}}"><i class="far fa-trash-alt"></i> Delete</button>
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
        <h5 class="modal-title" id="staticBackdropLabel">Hapus Data Merk (<span id='mnama'></span>)</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Yakin ingin menghapus data ini ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <a href="#" id="modaldel" class="btn btn-danger">Hapus</a>
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(function(){
  $('.del').on('click',function(){
    var id = $(this).attr('data-id');
    var nama = $(this).attr('data-nama');
    $('#mnama').html(nama);
    $('#modaldel').attr('href','/adminpage/bank/delete/'+id);
  })
})
</script>
@endsection