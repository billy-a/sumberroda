<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link href="{{asset('desain/css/layout.css')}}" rel="stylesheet">
    <link href="{{asset('desain/css/checkoutload.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
    
    <title>Sumber Roda - Uplad Bukti</title>
  </head>
  <body class="p-0">
    <div class="w-100 mt-3">
      <a class="judultoko text-center text-decoration-none text-reset" href="{{ url("/") }}"><h3><text class="text-success">SUMBER</text> RODA</h3></a>
    </div>
    <div class="badan-login mx-auto px-3 mt-3">      
      <div class="card mt-2 w-100">
        <div class="card-header text-center">
          <h5>
            LAKUKAN PEMBAYARAN
          </h5>
          <h5>Rp. {{number_format($jual->subtotal,0,',','.')}}</h5>
          <p>No. Pesanan {{$jual->idjual}}</p>        
        </div>
        <div class="card-body text-center">
          <div class="card-text">
            <h5>Bank {{$jual->namabank}}</h5>
            <p>Nama : {{$jual->namarek}}</p>
            <p>Nomor Rekening : {{$jual->norek}}</p>
          </div>
          <div class="card mt-4">
            <form action="/payment/uploadpay" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="card-body">
                <div class="col-12">
                  <input type="hidden" name="idjual" value="{{$jual->idjual}}">
                  <input class="form-control form-control-lg @error('fotobukti') is-invalid @enderror" name="fotobukti" type="file">
                  <div class="invalid-feedback">
                    @error('fotobukti')
                      {{ $message }}
                    @enderror
                  </div>
                </div>
                <div class="col-12 d-grid mt-1">
                  <button type="submit" class="btn btn-success">Upload Bukti Pembayaran</button>                                    
                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="card-footer text-center">
          <h5>Lakukan Pembayaran Sebelum</h5>
          <h6>{{ date('d-m-Y H:i:s',strtotime($jual->tglpesan.' +4 hours')) }}</h6>
        </div>
      </div>
    </div>
    <scirpt src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
  </body>
</html>