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
    <title>Laporan Penjualan</title>
  </head>
  <body onload="window.print()">
  <div class="container">         
    <h5>LAPORAN JUAL SUMBER RODA</h5>
      
    @if(Request::get('jenis')==1 || Request::get('jenis')==null)

    <div class="card">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table user-table no-wrap">
            <thead>
                <tr>
                    <th class="border-top-0">#</th>
                    <th class="border-top-0">Tgl Pesan</th>
                    <th class="border-top-0">No Pesanan</th>
                    <th class="border-top-0">Pembeli</th>
                    <th class="border-top-0">Bank</th>                
                    <th class="border-top-0">Nama Barang</th>
                    <th class="border-top-0">Qty</th>
                    <th class="border-top-0">Total</th>
                    <th class="border-top-0">Subtotal</th>
                </tr>
            </thead>
            <tbody>
              <?php 
                $i=1;
                $gt = 0;
              ?>
              @foreach ($jual as $p)              
              <tr>
                <td rowspan="{{$p->count}}">{{ $i++ }}</td>
                <td rowspan="{{$p->count}}">{{$p->tglpesan}}</td>
                <td rowspan="{{$p->count}}">{{$p->idjual}}</td>
                <td rowspan="{{$p->count}}">{{$p->name}}</td>
                <td rowspan="{{$p->count}}">{{$p->namabank}}</td>          
                @foreach($jualdetil as $jd)
                  @if($jd-> idjual == $p->idjual)
                    <td>{{$jd->namabrg}}</td>
                    <td>{{$jd->qty}}</td>                            
                    <td>{{$jd->total}}</td>                            
                  @break                    
                  @endif
                @endforeach
                <td rowspan="{{$p->count}}">{{$p->subtotal}}</td>
              </tr>
                <?php $a = 0; ?>
                @foreach($jualdetil as $jd)
                  @if($jd->idjual == $p->idjual && $a == 0)
                    <?php $a = 1; ?>                    
                  @elseif($jd->idjual == $p->idjual && $a == 1)
                    <tr>
                      <td>{{$jd->namabrg}}</td>
                      <td>{{$jd->qty}}</td>
                      <td>{{$jd->total}}</td>
                    </tr>
                  @endif
                @endforeach
                <?php
                  $gt = $gt + $p->subtotal;
                ?>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
      <div class="card-footer text-end">
        Grand Total : 
        <h5 class="d-inline">
          Rp. {{$gt}}
        </h5>
      </div>
    </div>

    @elseif(Request::get('jenis')=='2')

    <div class="card">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table user-table no-wrap">
            <thead>
                <tr>
                    <th class="border-top-0">Tanggal</th>
                    <th class="border-top-0">Nama Barang</th>
                    <th class="border-top-0">Jumlah</th>
                    <th class="border-top-0">Total</th>
                </tr>
            </thead>
            <tbody>              
              <?php 
                $i=1;
                $gt = 0;
              ?>
              @foreach ($jual as $p)
              <tr>
                <td rowspan="{{$jualdetil->where('tglpes',$p->tglpes)->count()}}">{{$p->tglpes}}</td>
                @foreach ($jualdetil as $pp)
                  @if($p->tglpes == $pp->tglpes)
                  <td>{{$pp->namabrg}}</td>
                  <td>{{$pp->qtys}}</td>
                  <td>{{$pp->gt}}</td>
                  <?php $gt = $gt + $pp->gt; ?>
                  @break               
                  @endif     
                @endforeach
              </tr>
              
              <?php $a = 0; ?>
                @foreach($jualdetil as $ppp)
                  @if($pp->namabrg != $ppp->namabrg && $p->tglpes == $ppp->tglpes)
                    <tr>
                      <td>{{$ppp->namabrg}}</td>
                      <td>{{$ppp->qtys}}</td>
                      <td>{{$ppp->gt}}</td>
                      <?php $gt = $gt + $ppp->gt; ?>
                    </tr>
                  @endif
                @endforeach
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
      <div class="card-footer text-end">
        Grand Total : 
        <h5 class="d-inline">
          Rp. {{$gt}}
        </h5>
      </div>
    </div>

    @endif

  </div>
    
  </body>

</html>
