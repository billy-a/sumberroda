<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">    
    @yield('linkcss')
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
    <title>@yield('judulweb')</title>
  </head>
  <body>
    @include('admin.a_nav')

    <div class="container min-vh-100">         
      @yield('content')      
    </div>
    <footer class="text-center p-3 bg-light">
      @ Sumber Roda - Admin Panel - 2021
    </footer>

    
  </body>

</html>