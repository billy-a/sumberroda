<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\tbljual; 
use App\Models\tbljualdetil; 
use App\Models\tblcart; 
use Image;

class JualController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    public function pesanan(){
        return view('v_pesanan');
    }

    public function detailpesanan($idjual){
        $iduser = Auth::user()->id;
        $tbljual = new tbljual;       
        // $count = $tbljual->alldata($iduser)->where('tbljual.idjual',$idjual)->count();
        // if($count>0){
        $data = [
            'jual' => $tbljual->alldata($iduser,'0')->where('tbljual.idjual',$idjual)->groupBy('tbljual.idjual')->first(),
            'detiljual' => $tbljual->alldata($iduser,'0')->where('tbljual.idjual',$idjual)->get(),
        ];   
        return view('v_dpesanan',$data);
        // }else{
        //     return redirect()->route('home');
        // }
    }

    public function pesananitem(Request $request){
        if($request->ajax())
        {
            $tbljual = new tbljual;
            $iduser = Auth::user()->id;
            $status = $request->status;
            $data = [
                'jual' => $tbljual->alldata($iduser,$status)->groupBy('tbljual.idjual')->get(),
                'detiljual' => $tbljual->alldata($iduser,$status)->get(),
            ];
            //echo $tbljual->alldata($iduser)->toSql();  
            return view('p_ajax.v_pesananproses',$data);
        }
    }
        
    public function ticketpesanan($id){
        $tbljual = new tbljual;
        $iduser = Auth::user()->id;

        $data = [
            'jual' => $tbljual->allnocon()->where('iduser',$iduser)->where('idjual',$id)->first(),
        ];

        $count = $tbljual->allnocon()
                    ->where(function($q) use ($iduser){
                        $q->where('iduser',$iduser)
                        ->orWhere('level','2');
                    })->where('idjual',$id)->count();

        if($count>0){
            return view('v_ticket',$data);
        }else{
            return redirect()->route('home');
        }
        // \QrCode::size(200)
        //     ->format('png')
        //     ->backgroundColor(255,55,0)
        //     ->generate(url('/pesanan/ticketdone/'.$id), public_path('images/qrcode.png'));
    }

    public function ticketpesanandone($id){
        $tbljual = new tbljual;
        $iduser = Auth::user()->id;

        $count = $tbljual->allnocon()
                    ->where(function($q) use ($iduser){
                        $q->where('iduser',$iduser)
                        ->orWhere('level','2');
                    })->where('idjual',$id)->count();

        if($count>0){
            $data = [
                'status' => '4'
            ];
            tbljual::where('iduser',$iduser)->where('idjual',$id)->update($data);
            return redirect()->route('home')->with('pesanselesai',$id);
        }else{
            return redirect()->route('home');
        }

    }

    public function checkouttime(){
        $tblcart = new tblcart;
        $iduser = Auth::user()->id;
        Request()->validate([
            'tglbook' => 'required|in:1,2,3,4',
            'bank' => 'required|exists:tblbank,idbank'
        ],[
            'tglbook.required' => 'Harap pilih tanggal reservasi',
            'bank.required' => 'Harap pilih bank tujuan'
        ]);

        // $data = [
        //     'tglbook' => Request()->tglbook,
        //     'bank' => Request()->bank,
        // ];
        
        $datacart = [
            'cart' => $tblcart->allDataCheck($iduser),
        ];

        $idjual = 'J'.date('Ym').rand(1000,9999);
        $gtotal = 0;
        foreach($datacart['cart'] as $p){
            $idbrg = $p->idbrg;
            $jasa = $p->hargajasa;
            $qty = $p->qty;
            $instalasi = $p->instalasi;
            $harga = $p->hargajual;
            if($instalasi=='1'){
                $totaljasa = $jasa * $qty;
            }else{
                $totaljasa = 0;
            }
            $totaljual = $harga * $qty;
            $subtotal = $totaljasa + $totaljual;
            $gtotal += $subtotal;
            $tbljualdetil = new tbljualdetil;
            $tbljualdetil->idjual = $idjual;
            $tbljualdetil->idbrg = $idbrg;
            $tbljualdetil->qty = $qty;
            $tbljualdetil->instalasi = $instalasi;
            $tbljualdetil->total = $subtotal;
            $tbljualdetil->save();
        }

        $tbljual = new tbljual;
        $tglpesan = date('Y-m-d H:i:s');
        $tglreservasi = date('Y-m-d',strtotime("+".Request()->tglbook." day"));
        $bank = Request()->bank;
        $status = '1';

        $tbljual->idjual = $idjual;
        $tbljual->iduser = $iduser;
        $tbljual->tglpesan = $tglpesan;
        $tbljual->tglreservasi = $tglreservasi;
        $tbljual->idbank = $bank;
        $tbljual->status = $status;
        $tbljual->subtotal = $gtotal;
        $tbljual->save();


        $tblcart->deletedatadone($iduser);

        return redirect()->route('checkouts',['id'=>$idjual]);
    }

    public function checkouts($idjual)
    {
        $iduser = Auth::user()->id;
        $tbljual = new tbljual;       
        $count = $tbljual->forcheckouts($idjual,$iduser)->count();
        if($count==1){
            $data = [
                'jual' => $tbljual->forcheckouts($idjual,$iduser)->first(),
            ];    
            return view('v_payment',$data);
        }else{
            return redirect()->route('home');
        }
    }

    public function uploadpay(){
        Request()->validate([
            'fotobukti' => 'required|mimes:jpg,jpeg,png|max:4096'
        ],[
            'fotobukti.required' => 'Harap upload bukti pembayaran',
            'fotobukti.mimes' => 'File yang diupload harus tipe: jpg, jpeg, png',
        ]);

        $iduser = Auth::user()->id;
        $idjual = Request()->idjual;


        $file = Request()->fotobukti; 
        $filename = $idjual.'.'.$file->extension();
        $filepath = public_path('fotobukti');
        $img = Image::make($file->path());
        $img->resize(1000, 1000, function($const){
            $const->aspectRatio();
        })->save($filepath.'/'.$filename);   

        tbljual::where([
            'iduser' => $iduser,
            'idjual' => $idjual
        ])->update([
            'status' => '2',
            'bukti' => $filename
        ]);

        return redirect()->route('pesanan')->with('pesansukses','Upload bukti berhasil, Silahkan tunggu konfirmasi 1x24jam');
    }

    public function faktur($idjual)
    {        
        $iduser = Auth::user()->id;
        $tbljual = new tbljual;       
        $count = $tbljual->countdata($idjual,$iduser)->where('status','4')->count();
        if($count==1 || Auth::user()->level > 1){
            $data = [
                'jual' => $tbljual->allnocon()->where('tbljual.idjual',$idjual)->first(),
                'jualdetil' => $tbljual->allwdetilnoconbrg()->where('tbljual.idjual',$idjual)->get(),
            ];    
            return view('v_faktur',$data);
        }else{
            return redirect()->route('home');
        }
    }
}
