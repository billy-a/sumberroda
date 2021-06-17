@foreach ($jual as $p)  
<?php 
  $status = $p->status;
  if($status=='1'){
    $stat = 'Belum Bayar';
  }elseif($status=='2'){
    $stat = 'Menunggu Konfirmasi';
  }elseif($status=='3'){
    $stat = 'Diterima';
  }elseif($status=='4'){
    $stat = 'Selesai';
  }elseif($status=='5'){
    $stat = 'Batal';
  }
?>
  <div class="mt-4">
    <div class="card kotakzoom">
      
      
      <a href="/pesanan/detail/{{$p->idjual}}" class="itemb">
      

        <div class="card-body">
          <div class="card-title">
            <h5>PESANAN {{$p->idjual}} ({{$stat}})</h5>
          </div>
          <div class="card-text fs-13 border-bottom pb-2">
            <p>Tanggal Pemesanan : {{$p->tglpesan}}</p>
            <p>Tanggal Instalasi : {{$p->tglreservasi}} (08.00-17.00)</p>
          </div>
          <div class="card-text fs-13 pt-2">
            <div class="row">
              @foreach ($detiljual as $s)
              @if ($p->idjual == $s->idjual)
                <div class="col-6">
                      <p>{{$s->namabrg}} <span class="badge rounded-pill bg-secondary">x {{$s->qty}} Pcs</span></p>
                </div>
                <div class="col-6 text-end">
                    Rp. {{number_format($s->total,0,',','.')}}
                </div>
              @endif                
              @endforeach

            </div>                          
          </div>
        </div>
        <div class="card-footer text-end">
            <h5>TOTAL Rp. {{number_format($p->subtotal,0,',','.')}}</h5>
        </div>
      </a>
    </div>
  </div>
@endforeach