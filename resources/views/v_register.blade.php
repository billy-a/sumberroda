<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link href="{{asset('desain/css/layout.css')}}" rel="stylesheet">
    <link href="{{asset('desain/css/login.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
    
    <title>Sumber Roda - Daftar Akun</title>
  </head>
  <body class="p-0">      
    <div class="badan-login mx-auto d-flex align-content-center flex-wrap p-3">
      <div class="w-100">
        <a class="judultoko text-center" href="{{ url("/") }}"><h3><text class="text-success">SUMBER</text> RODA</h3></a>
      </div>
      <div class="card mt-2 w-100">
        <div class="card-body">
          <form method="POST" action="{{ route('register') }}">
            @csrf
            <h5 class="card-title text-center border-bottom pb-3">DAFTAR</h5>
            <div>
              <form class="row g-3">
                <div class="col-md-12">
                  <label for="name" class="form-label">Nama</label>
                  <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                
                <div class="col-md-12">
                  <label for="email" class="form-label">Email</label>
                  <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                  @error('email')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div>
                
                
                <div class="col-md-12">
                  <label for="nohp" class="form-label">No. HP</label>
                  <input id="nohp" type="text" class="form-control @error('nohp') is-invalid @enderror" name="nohp" value="{{ old('nohp') }}" required autocomplete="nohp">

                  @error('nohp')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div>
                
                <div class="col-md-12">
                  <label for="password" class="form-label">Password</label>
                  <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                  @error('password')
                      <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                </div>
                
                <div class="col-md-12">
                  <label for="email" class="form-label">Confirm Password</label>
                  <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                </div>
                <div class="col-12 d-grid mt-4">
                  <button type="submit" class="btn btn-success">LOGIN</button>
                </div>
              </form>
            </div>
          </form>
        </div>
        <div class="card-footer text-center">
          Sudah punya akun ? <a href="{{ route('login') }}">Masuk Sekarang</a>
        </div>
      </div>
    </div>  
    <scirpt src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
  </body>
</html>