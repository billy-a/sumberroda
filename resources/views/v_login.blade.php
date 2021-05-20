<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link href="{{asset('desain/css/layout.css')}}" rel="stylesheet">
    <link href="{{asset('desain/css/login.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
    
    <title>Sumber Roda - Login</title>
  </head>
  <body>      
    <div class="badan-login mx-auto d-flex align-content-center flex-wrap p-3">
      <div class="w-100">
        <a class="judultoko text-center" href="{{ url("/") }}"><h3><text class="text-success">SUMBER</text> RODA</h3></a>
      </div>
      <div class="card mt-2">
        <div class="card-body">
          <h5 class="card-title text-center border-bottom pb-3">LOGIN</h5>
          <div>
            <form class="row g-3">
              <div class="col-md-12">
                <label for="inputEmail4" class="form-label">Email</label>
                <input type="email" class="form-control" id="inputEmail4">
              </div>
              <div class="col-md-12">
                <label for="inputPassword4" class="form-label">Password</label>
                <input type="password" class="form-control" id="inputPassword4">
              </div>
              <div class="col-12 d-grid">
                <button type="submit" class="btn btn-success">LOGIN</button>
              </div>
            </form>
          </div>
        </div>
        <div class="card-footer text-center">
          Belum punya akun ? <a href="#">Daftar Sekarang</a>
        </div>
      </div>
    </div>  
    <scirpt src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
  </body>
</html>