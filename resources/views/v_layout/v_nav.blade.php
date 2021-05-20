<div class="bcontainer">
  {{-- <div class="row g-0 pt-3 pb-2 border-bottom border-success">
    <div class="col-sm-12"> --}}
      <div class="bheader border-bottom border-success">
        <div class="bheader-logo"><a href="{{ url("/") }}"><h5><text class="text-success">SUMBER</text> RODA</h5></a></div>
        <div class="bheader-cari text-right">
          <div class="input-group">
            <span class="input-group-text" id="basic-addon1"><i class="fas fa-search"></i></span>
            <input type="text" class="form-control" placeholder="Cari" aria-label="Cari">
          </div>
        </div>
      {{-- </div>
    </div>   --}}
  </div>

  <div class="mmenubar" style="background-color: white;">
    <div class="mmenubartab">
      <button type="button" class="btn btn-mmenubar {{request()->is('/') ? 'active-mmenubar' : ''}}" onclick="window.location='{{ url("/") }}'" style="width:100%">
        <div class="mmenubartabicon">
          <i class="fas fa-home"></i>
        </div>
        <p class="mmenubartabtitle fs-13">Home</p>
      </button>
    </div>  

    <div class="mmenubartab">
      <button type="button" class="btn btn-mmenubar {{request()->is('pesanan') ? 'active-mmenubar' : ''}}" onclick="window.location='{{ url("pesanan") }}'" style="width:100%">
        <div class="mmenubartabicon">
          <i class="fas fa-clipboard-list"></i>
        </div>
        <p class="mmenubartabtitle fs-13">Pesanan</p>
      </button>
    </div>  
  
    <div class="mmenubartab">
      <button type="button" class="btn btn-mmenubar {{request()->is('keranjang') ? 'active-mmenubar' : ''}}" onclick="window.location='{{ url("keranjang") }}'" style="width:100%">
        <div class="mmenubartabicon">
          <i class="fas fa-shopping-cart"></i>
        </div>
        <p class="mmenubartabtitle fs-13">Keranjang</p>
      </button>
    </div>  

    <div class="mmenubartab">
      <button type="button" class="btn btn-mmenubar {{request()->is('profil') ? 'active-mmenubar' : ''}}" onclick="window.location='{{ url("profil") }}'" style="width:100%">
        <div class="mmenubartabicon">
          <i class="fas fa-user-alt"></i>
        </div>
        <p class="mmenubartabtitle fs-13">Profil</p>
      </button>
    </div>  
  </div>   

  @yield('content')
</div>