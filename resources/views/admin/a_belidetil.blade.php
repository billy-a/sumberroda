@extends('admin.a_layout')
@section('judulweb')
    Admin - Pembelian
@endsection

@section('content')
<div>
  <h4 class="mt-3 pb-3 border-bottom text-center">DATA TRANSAKSI PEMBELIAN</h4>

  @if (session('pesan'))
  <div class="mt-4 alert alert-success alert-dismissible fade show" role="alert">
    {{ session('pesan') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>    
  @endif

  <div class="my-4">
    <a class="btn btn-primary" href="/adminpage/pembelian">Kembali</a>
  </div>

  <div class="mt-2">
    <p>No. Beli : {{$beli->idbeli}}</p>
    <p>Nama Supplier : {{$beli->namasupp}}</p>
      <p>Tanggal : {{date('Y-m-d',strtotime($beli->tgl))}}</p>
  </div>

  <div class="mt-2">
    <div class="card">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table user-table no-wrap">
            <thead>
                <tr>
                    <th class="border-top-0">#</th>
                    <th class="border-top-0">Kode Barang</th>
                    <th class="border-top-0">Nama Barang</th>
                    <th class="border-top-0">Qty</th>
                    <th class="border-top-0">Hargabeli</th>
                    <th class="border-top-0">Total</th>
                </tr>
            </thead>
            <tbody>
            <?php $i=1; ?>
            @foreach ($belidetil as $t)
                <tr>
                  <td>{{ $i++ }}</td>
                  <td>{{$t->kodebrg}}</td>
                  <td>{{$t->namabrg}}</td>
                  <td>{{$t->qty}}</td>
                  <td>{{$t->hargabeli}}</td>
                  <td>{{$t->total}}</td>
                </tr>
            @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
    
@endsection