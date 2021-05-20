  @extends('v_layout.v_layout')

  @section('judulweb')
      Sumber Roda - Detail
  @endsection

  @section('linkcss')
    <link href="{{asset('desain/css/dbarang.css')}}" rel="stylesheet">
  @endsection

  @section('content')
  <div class="card mt-4 fs-13">
    <div class="card-body">
      <div class="gbr">
        <img src="{{asset('assets/image.png')}}" alt="" class="gbr-item">
      </div>

      <div class="gbr-detail mt-4">
        <p class="namabrg">GT RADIAL CHAMPIRO ECO 175/65 R14</p>
        <p class="hargabrg text-success">Rp. 100.000 </p>
       
        <div class="input-group mt-4 groupqty">
          <span class="input-group-text" id="basic-addon1">Qty</span>
          <input type="number" min="1" value="1" class="form-control qty">
        </div>
        
        <div class="mt-3 d-grid">
          <button type="button" class="btn btn-success btn-block">Tambah ke Keranjang</button>          
        </div>
      </div>
      
      
    </div>
  </div>

  <div class="card mt-2 fs-13">
    <div class="card-body">
      <div>
        <p class="fw-13"> INFO SERVIS </p>
          <ul>
            <li>Gratis biaya instalasi (Harga normal Rp 50,000)</li>
          </ul>
      </div>
      <div>
        <p class="fw-13"> DETAIL PRODUK </p>
        <p>
          Membuat ban ini nyaman dan aman dikendarai serta cepat dan efektif dalam menepis air.
          Sangat baik dalam menekan suara yang timbul sehingga menjadikan ban ini sangat hening sesuai dengan regulasi EU/Eropa dalam hal standard keheningan ban.
          Tekanan angin ban bertahan lebih lama, sehingga membuat penggunaan bahan bakar yang lebih irit, pengendalian dan pengereman lebih mantap serta mengurangi efek aquaplanning.
          Daya cengkeram kuat di jalan basah dan kering serta membuat irit dalam pemakaian bahan bakar.
        </p>
      </div>
    </div>
  </div>

  
  @endsection