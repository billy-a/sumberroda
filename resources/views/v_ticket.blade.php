<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link href="{{asset('desain/css/layout.css')}}" rel="stylesheet">
    <link href="{{asset('desain/css/checkoutload.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
    
    <title>Sumber Roda - Ticket</title>
  </head>
  <body class="p-0">
    <div class="mx-auto px-3" style="max-width:540px;">        
      <div class="w-100 mt-3">
        <a class="judultoko text-center text-decoration-none text-reset" href="{{url()->previous()}}"><h3><text class="text-success">SUMBER</text> RODA</h3></a>
      </div>  
      <div class="card mt-2 w-100">
        <div class="card-header text-center">
          <h5>
            TICKET #{{$jual->idjual}}
          </h5>
          {!! QrCode::size(180)->backgroundColor(245,245,245)->generate(url('/pesanan/ticketdone/'.$jual->idjual)); !!}        
        </div>
        <div class="card-body text-center">
          <div class="card">
            <div class="card-body">
                <h5>INFORMASI PEMILIK</h5>
                <p>Nama : {{$jual->name}}</p>
                <p>Nama : {{$jual->email}}</p>
            </div>
          </div>
          <div class="card mt-2">
            <div class="card-body">
                <h5>INFORMASI TIKET</h5>
                <p>Tanggal Reservasi : {{date('D, d M Y',strtotime($jual->tglreservasi))}}</p>
                <p>Jam Reservasi : 08.00 - 17.00</p>
                <p>Alamat Toko : Jalan K. H. Wahid Hasyim Nomor 60, Pontianak, Kalimantan Barat</p>
            </div>
          </div>
        </div>        
        <div class="card-footer text-center d-grid">
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdrop">PESANAN SELESAI</button>
        </div>
    </div>

    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">TICKET #{{$jual->idjual}}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <h6>Apakah anda yakin pesanan sudah diambil ?</h6>
            <p>Tekan tombol "Selesai" jika Anda sudah menerima pesanan dengan baik dan lengkap.</p>
            <br>
            <p>Transaksi akan dinyatakan selesai jika sudah menekan tombol "Selesai".</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <a href="/pesanan/ticketdone/{{$jual->idjual}}" id="modaldel" class="btn btn-success">Selesai</a>
          </div>
        </div>
      </div>
    </div>
    <script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>

  </body>
</html>