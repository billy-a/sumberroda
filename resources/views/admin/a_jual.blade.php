@extends('admin.a_layout')
@section('judulweb')
    Admin - Merek
@endsection

@section('content')
<div>
  <h4 class="mt-3 pb-3 border-bottom text-center">DATA TRANSAKSI PENJUALAN</h4>

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
<div class="my-4">
  <ul class="nav nav-pills">
      <li class="nav-item">
        <a href="/adminpage/penjualan/" class="nav-link heremenu {{request()->is('adminpage/penjualan') ? 'active disabled' : ''}}" aria-current="page">Semua</a>          
      </li>
      <li class="nav-item">
        <a href="/adminpage/penjualan/1" class="nav-link heremenu {{request()->is('adminpage/penjualan/1') ? 'active disabled' : ''}}" aria-current="page">Belum Bayar</a>
      </li>
      <li class="nav-item">
        <a href="/adminpage/penjualan/2" class="nav-link heremenu {{request()->is('adminpage/penjualan/2') ? 'active disabled' : ''}}" aria-current="page">Menunggu Konfirmasi</a>
      </li>
      <li class="nav-item">
        <a href="/adminpage/penjualan/3" class="nav-link heremenu {{request()->is('adminpage/penjualan/3') ? 'active disabled' : ''}}" aria-current="page">Diterima</a>
      </li>
      <li class="nav-item">
        <a href="/adminpage/penjualan/4" class="nav-link heremenu {{request()->is('adminpage/penjualan/4') ? 'active disabled' : ''}}" aria-current="page">Selesai</a>
      </li>
      <li class="nav-item">
        <a href="/adminpage/penjualan/5" class="nav-link heremenu {{request()->is('adminpage/penjualan/5') ? 'active disabled' : ''}}" aria-current="page">Batal</a>
      </li>        
  </ul>
</div>


  <div class="mt-2">
    <div class="card">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table user-table no-wrap">
            <thead>
                <tr>
                    <th class="border-top-0">#</th>
                    <th class="border-top-0">No Pesanan</th>
                    <th class="border-top-0">Pembeli</th>
                    <th class="border-top-0">Tgl Pesan</th>
                    <th class="border-top-0">Tgl Reservasi</th>
                    <th class="border-top-0">Bank</th>
                    <th class="border-top-0">Subtotal</th>
                    <th class="border-top-0">Status</th>
                    <th class="border-top-0">Action</th>
                </tr>
            </thead>
            <tbody>
              <?php $i=1; ?>
              @foreach ($jual as $p)
              <?php 
                if($p->status=='1'){
                  $status = 'Belum Bayar';                  
                }elseif($p->status=='2'){
                  $status = 'Menunggu Konfirmasi';                  
                }elseif($p->status=='3'){
                  $status = 'Diterima';                  
                }elseif($p->status=='4'){
                  $status = 'Selesai';                  
                }elseif($p->status=='5'){
                  $status = 'Batal';                  
                }
              ?>
              <tr>
                  <td>{{ $i++ }}</td>
                  <td>{{$p->idjual}}</td>
                  <td>{{$p->name}}</td>
                  <td>{{$p->tglpesan}}</td>
                  <td>{{$p->tglreservasi}}</td>
                  <td>{{$p->namabank}}</td>
                  <td>{{$p->subtotal}}</td>
                  <td>{{$status}}</td>
                  <td>
                    <a href="/faktur/{{$p->idjual}}" target="_blank" class="btn btn-sm btn-outline-success"><i class="fas fa-print"></i> Faktur</a>
                    <a href="/adminpage/penjualan/detail/{{$p->idjual}}" class="btn btn-sm btn-outline-success"><i class="fas fa-info-circle"></i> Detail</a>
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
    $('#modaldel').attr('href','/adminpage/merek/delete/'+id);
  })
})
</script>
@endsection