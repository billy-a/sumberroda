@if ($barang->lastPage() < $barang->currentPage())

  empty

@else

  @foreach($barang as $p)  

  <div class="col-6 col-sm-4 col-md-3 kotakzoom">
    <a class="itemb" href="home/dbarang/{{$p->idbrg}}" >
    <div class="card h-100">
      <img src="{{ url('assets/'.$p->gambar)}}" alt="" class="card-img-top">
      <div class="card-body">
        <p class="card-text fs-13">{{ $p->namabrg }}</p>
        <h5 class="card-text text-success">Rp. {{number_format($p->hargajual,0,',','.')}}</h5>       
      </div>
    </div>
    </a>
  </div>

  @endforeach

@endif