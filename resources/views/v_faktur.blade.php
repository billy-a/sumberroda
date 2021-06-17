<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">    
    @yield('linkcss')
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
    <style>
      @media print{ @page { margin-top: 20px; margin-bottom: 20px;}}
    </style>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
    <title>Faktur</title>
  </head>
  <body>
  <div style="width:720px;" class="mx-auto">
    <div class="">
      <div class="card-body">
        <h5>SUMBER RODA</h5>
        <p>
          Alamat Toko : Jalan K. H. Wahid Hasyim Nomor 60 <br>
          Pontianak, Kalimantan Barat
        </p>
        <h5 class="text-center">FAKTUR PENJUALAN</h5>
        <div class="row fa-sm">
          <div class="col-4">
            No. Pesanan : <br>
            {{$jual->idjual}} <br>
            Bank : {{$jual->namabank}} ( {{$jual->namarek}} a.n. {{$jual->norek}} )
          </div>
          <div class="col-4 border-start">
            Tanggal Pemesanan : <br> {{$jual->tglpesan}} <br>
            Tanggal Reservasi : <br> {{$jual->tglreservasi}} (08.00 - 17.00) <br>
          </div>
          <div class="col-4 border-start">
            Nama user : {{$jual->name}} <br>
            No. HP : {{$jual->nohp}}
          </div>
        </div>
        <div class="table-responsive">
          <table class="table user-table no-wrap">
            <thead>
                <tr>
                    <th class="border-top-0">#</th>
                    <th class="border-top-0">Nama Barang</th>
                    <th class="border-top-0">Qty</th>
                    <th class="border-top-0">Harga</th>
                    <th class="border-top-0">Total</th>
                </tr>
            </thead>
            <tbody>
            <?php $i = 1; ?>
            @foreach ($jualdetil as $jd)
                <tr>
                    <td>{{$i++}}</td>
                    <td>{{$jd->namabrg}}</td>
                    <td>{{$jd->qty}}</td>
                    <td>{{$jd->hargajual}}</td>
                    <td>{{$jd->total}}</td>
                </tr>                
            @endforeach
                <tr>
                  <td class="text-end" colspan="4">Grand Total</td>
                  <td>{{$jd->subtotal}}</td>
                </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

  </div>
    
  </body>

</html>
