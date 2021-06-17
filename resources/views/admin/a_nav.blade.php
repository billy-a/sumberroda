<nav class="navbar navbar-light bg-light">
  <div class="container-fluid">
    <a href="/adminpage" class="navbar-brand">SUMBER RODA</a>
    <form class="d-flex">
      <button class="btn btn-outline-secondary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
        <span class="navbar-toggler-icon"></span>
      </button>
    </form>
  </div>
</nav>
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
  <div class="offcanvas-header">
    <h5 id="offcanvasRightLabel">MENU ADMIN</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    
    <div class="card">
      <a class="card-header text-reset text-decoration-none" href="/adminpage">
        ADMIN HOMEPAGE
      </a>
    </div>

    <div class="card mt-4">
      <a class="card-header text-reset text-decoration-none" data-bs-toggle="collapse" href="#collapseOne">
        PENGOLAHAN DATA
      </a>
    
      <div id="collapseOne" class="collapse show p-2" data-parent="#accordion">
        <nav class="nav flex-column nav-pills">
          <a class="nav-link {{request()->is('adminpage/supplier') ? 'active disabled' : ''}}" href="/adminpage/supplier">Data Supplier</a>
          <a class="nav-link {{request()->is('adminpage/merek') ? 'active disabled' : ''}}" href="/adminpage/merek">Data Merk</a>          
          <a class="nav-link {{request()->is('adminpage/kategori') ? 'active disabled' : ''}}" href="/adminpage/kategori">Data Kategori</a>                    
          <a class="nav-link {{request()->is('adminpage/barang') ? 'active disabled' : ''}}" href="/adminpage/barang">Data Barang</a>                    
          <a class="nav-link {{request()->is('adminpage/bank') ? 'active disabled' : ''}}" href="/adminpage/bank">Data Bank</a>                    
          <a class="nav-link {{request()->is('adminpage/user') ? 'active disabled' : ''}}" href="/adminpage/user">Data User</a>                    
        </nav>
      </div>
    </div>

    <div class="card mt-4">
      <a class="card-header text-reset text-decoration-none" data-bs-toggle="collapse" href="#collapseTwo">
        DATA TRANSAKSI
      </a>
    
      <div id="collapseTwo" class="collapse show p-2" data-parent="#accordion">
        <nav class="nav flex-column nav-pills">
          <a class="nav-link {{request()->is('adminpage/penjualan*') ? 'active disabled' : ''}}" href="/adminpage/penjualan">TRANSAKSI PENJUALAN</a>         
          <a class="nav-link {{request()->is('adminpage/pembelian*') ? 'active disabled' : ''}}" href="/adminpage/pembelian">TRANSAKSI PEMBELIAN</a>         
        </nav>
      </div>
    </div>

    <div class="card mt-4">
      <a class="card-header text-reset text-decoration-none" data-bs-toggle="collapse" href="#collapseThree">
        LAPORAN
      </a>
    
      <div id="collapseThree" class="collapse show p-2" data-parent="#accordion">
        <nav class="nav flex-column nav-pills">
          <a class="nav-link {{request()->is('adminpage/laporan/jual') ? 'active disabled' : ''}}" href="/adminpage/laporan/jual">LAPORAN PENJUALAN</a>         
          <a class="nav-link {{request()->is('adminpage/laporan/beli') ? 'active disabled' : ''}}" href="/adminpage/laporan/beli">LAPORAN PEMBELIAN</a>         
          <a class="nav-link {{request()->is('adminpage/laporan/barang') ? 'active disabled' : ''}}" href="/adminpage/laporan/barang">LAPORAN PERSEDIAAN</a>         
        </nav>
      </div>
    </div>

  </div>
</div>