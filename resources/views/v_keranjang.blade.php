@extends('v_layout.v_layout')

@section('judulweb')
    Sumber Roda - Keranjang
@endsection

@section('linkcss')
  <link href="{{asset('desain/css/keranjang.css')}}" rel="stylesheet">
@endsection

@section('content')
@if (session('pesan'))
<div class="mt-4 alert alert-success alert-dismissible fade show" role="alert">
    {{ session('pesan') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
    
@endif

<h5 class="text-center mt-3 pb-2 border-bottom"> KERANJANG </h5>
<div class="card mt-4">
<?php 
    $no = 0;
    $gtotal = 0;
?>
@foreach($cart as $p)
    <?php 
        $no++;
    ?>
    <div class="card-body border-bottom" id='qcard{{$no}}'>
        <div class="d-box">
            <div class="d-flex my-1 brg-k">                
                <div class="mb-auto me-2">
                    <input class="form-check-input selitem goajax" id='qcheck{{$no}}' type="checkbox"  @if ($p->checkout=='1') checked @endif data-id="{{$p->idbrg."|".$no."|checkout"}}">
                </div>
                <div class="flex-shrink-0">
                    <img src="{{asset('assets/'.$p->gambar)}}" alt="" width="100">
                </div>
                <div class="flex-grow-1 ms-3">
                    <p class="card-text fs-13">{{$p->namabrg}}</p>
                    <h5 class="card-text text-success">Rp. <span id="qhrg{{$no}}" data-id="{{$p->hargajual}}">{{number_format($p->hargajual,0,',','.')}}</span></h5>       
                    <div class="form-check form-switch fa-sm">
                        <input class="form-check-input goajax" type="checkbox" id="qins{{$no}}" @if ($p->instalasi=='1') checked @endif data-id="{{$p->idbrg."|".$no."|instal"}}">
                        <label class="form-check-label" for="qins{{$no}}">
                            Instalasi Rp. <span id="qjasa{{$no}}" data-id="{{$p->hargajasa}}">{{number_format($p->hargajasa,0,',','.')}}</span>
                        </label>
                    </div>
                </div>
                <div class="mb-auto">
                    <button type="button" class="btn btn-outline-danger deleteajax" data-id="{{$p->idbrg."|".$no."|delete"}}"><i class="far fa-trash-alt"></i></button>
                </div>
            </div>
        </div>
        <div class="d-box">
            <div class="ms-4 d-flex align-items-center">                
                <div class="ms-auto">
                    <div class="input-group btn-group-sm" role="group">
                        <button type="button" class="btn btn-secondary btn-qty-k goajax" data-id="{{$p->idbrg."|".$no."|minus"}}">-</button>
                        <input type="text" class="form-control qty-k text-center" id="qqty{{$no}}" value="{{$p->qty}}" readonly>
                        <button type="button" class="btn btn-secondary btn-qty-k goajax" data-id="{{$p->idbrg."|".$no."|plus"}}">+</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
</div>


<div class="mmenubarx border-bottom" style="background-color: rgb(255, 255, 255);">
    <div class="d-flex w-100 px-3">
        <div class="me-auto" style="align-self: center;">
            <h5 class="card-text text-success">Rp. <span id='gtotal'>0</span></h5>      
        </div>
        <div class="ms-auto">
            <button type="button" class="btn btn-success" onclick="window.location='{{ url("checkout") }}'">Beli (<span id='countselitem'>0</span>)</button>
        </div>
    </div>
</div>   

<script>
$(document).ready(function(){
    $('#gtotal').html(hrgtotal());
    countselected();
    $('.selitem').on('click',function(){
        countselected();
        $('#gtotal').html(hrgtotal());
    });   

    $('.goajax').click(function(){
        var dataid = $(this).attr('data-id').split('|');
        var idbrg = dataid[0];
        var num = dataid[1];
        var typ =  dataid[2];
        $('.goajax').attr('disabled',true);
        $('.deleteajax').attr('disabled',true);
        ajaxpr(typ,idbrg,num);
    });

    $('.deleteajax').click(function(){
        var dataid = $(this).attr('data-id').split('|');
        var idbrg = dataid[0];
        var num = dataid[1];
        var typ =  dataid[2];
        $('.goajax').attr('disabled',true);
        $('.deleteajax').attr('disabled',true);
        ajaxpr(typ,idbrg,num);
    });
});

function ajaxpr(typ,idbrg,num){
    var num = parseInt(num);

    if(typ=="delete"){
        var nowqty = 1;    
        typ = "minus"
    }else{
        var nowqty = parseInt($('#qqty'+num).val());    
    }
    $.ajax({
        url:"home/updatecart?type="+typ+"&idbrg="+idbrg+"&qty="+nowqty,
        success:function(data)
        {
            if(typ=="plus"){
                $('#qqty'+num).val(nowqty+1);
            }else if(typ=="minus"){
                if(nowqty==1){
                    $('#qcard'+num).remove();
                }else{
                    $('#qqty'+num).val(nowqty-1);
                }
            }
            $('.goajax').attr('disabled',false);
            $('.deleteajax').attr('disabled',false);

            $('#gtotal').html(hrgtotal());
            console.log(data);
        }
    });
}

function hrgtotal(){
    var num = {{$no}};
    var gt = 0;
    var jasa = 0;
    for(i=1;i<=num;i++){
        if($('#qcheck'+i).is(':checked')){
            if($('#qins'+i).is(':checked')){
                jasa = parseInt($('#qjasa'+i).attr('data-id'));                
            }else{
                jasa = 0;
            }
            var qty1 = parseInt($('#qqty'+i).val());
            var qhrg = parseInt($('#qhrg'+i).attr('data-id'));            
            var total = qty1 * (qhrg+jasa);
            gt += total;            
        }
    }
    return buatrp(gt);
}

function buatrp(x){
    var format = x.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
    return format;  
}

function countselected(){
    var selitem = $('.selitem').filter(':checked').length;
    $('#countselitem').html(selitem);
}
</script>
@endsection