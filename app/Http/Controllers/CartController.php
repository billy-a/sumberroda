<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\tblcart;
use App\Models\tblbank;


class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified']);
        $this->tblcart = new tblcart();     
    }

    public function index(){           
        $iduser = Auth::user()->id;
        $data = [
            'cart' => $this->tblcart->allData($iduser)
        ];
        return view('v_keranjang',$data);
    }

    public function addcart(){
        Request()->validate([
            'qty' => 'required|min:1'
        ],[
            'qty.required' => 'qty wajib diisi'
        ]);

        $iduser = Auth::user()->id;

        $data = [
            'qty' => Request()->qty,
            'idbrg' => Request()->idb,
            'checkout' => '1',
            'iduser' => $iduser
        ];
        $idbrg = Request()->idb;
        
        $sql = tblcart::where('iduser',$iduser)->where('idbrg',$idbrg)->get();
        $count = $sql->count();
        if($count==0){
            tblcart::create($data);
        }else{
            tblcart::where('iduser',$iduser)->where('idbrg',$idbrg)->increment('qty',Request()->qty);
        }
        return redirect()->route('keranjang')->with('pesan','Barang berhasil ditambahkan');
    }

    public function updatecart(Request $request){
        if($request->ajax()){
            $type = $request->type;
            $idbrg = $request->idbrg;
            $iduser = Auth::user()->id;
            $qty = $request->qty;
            // $users = User::where([
            //     'column1' => value1,
            //     'column2' => value2,
            //     'column3' => value3
            // ])->get();
            if($type=="minus"){
                if($qty=="1"){
                    tblcart::where('iduser',$iduser)->where('idbrg',$idbrg)->delete();
                }else{
                    tblcart::where('iduser',$iduser)->where('idbrg',$idbrg)->decrement('qty',1);
                }
            }else if($type=="plus"){
                tblcart::where('iduser',$iduser)->where('idbrg',$idbrg)->increment('qty',1);
            }else if($type=="instal"){
                $sql = tblcart::where('iduser',$iduser)->where('idbrg',$idbrg)->first();
                if($sql->instalasi=="1"){
                    tblcart::where([
                        'iduser' => $iduser,
                        'idbrg' => $idbrg
                    ])->update(['instalasi'=>'0']);                                       
                }else{
                    tblcart::where([
                        'iduser' => $iduser,
                        'idbrg' => $idbrg
                    ])->update(['instalasi'=>'1']);  
                }
            }else if($type=="checkout"){
                $sql = tblcart::where('iduser',$iduser)->where('idbrg',$idbrg)->first();
                if($sql->checkout=="1"){
                    tblcart::where([
                        'iduser' => $iduser,
                        'idbrg' => $idbrg
                    ])->update(['checkout'=>'0']);                                       
                }else{
                    tblcart::where([
                        'iduser' => $iduser,
                        'idbrg' => $idbrg
                    ])->update(['checkout'=>'1']);  
                }
            }
        }
    }

    public function checkout(){
        $iduser = Auth::user()->id;
        $data = [
            'checkout' => $this->tblcart->allDataCheck($iduser),
            'bank' => tblbank::all()
        ];
        return view('v_checkout',$data);
    }
}
