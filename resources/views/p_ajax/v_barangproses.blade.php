@if ($barang->lastPage() < $barang->currentPage())

  empty

@else

  @foreach($barang as $p)  

  <div class="col-6 col-sm-4 col-md-3 kotakzoom">
    <a class="itemb" href="#">
    <div class="card h-100">
      <img src="{{asset('assets/image.png')}}" alt="" class="card-img-top">
      <div class="card-body">
        <p class="card-text fs-13">{{ $p->namabrg }}</p>
        <h5 class="card-text text-success">Rp {{ $p->hargajual }}</h5>       
      </div>
    </div>
    </a>
  </div>

  @endforeach

@endif