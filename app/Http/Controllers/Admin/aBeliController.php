<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\tblbeli;
use App\Models\tblbelitemp;
use App\Models\tblbelidetil;
use App\Models\tblsupplier;
use App\Models\Barang;

class aBeliController extends Controller
{
    public function __construct(){
        $this->beli = new tblbeli;
    }

    public function index(){
        $data = [
            'beli' => $this->beli->alldatain()->get(),
        ];

        return view('admin.a_beli',$data);
    }
    
    public function tambahdata(){
        $tblsupplier = new tblsupplier();
        $tblbarang = new Barang();
        $tblbelitemp = new tblbelitemp();

        $idbeli = 'B'.date('Ym').rand(1000,9999);
        $iduser = Auth::user()->id;

        $tblbelitemp = $tblbelitemp->alldatain()->where('iduser',$iduser);
        $data = [
            'supplier' => $tblsupplier::all(),
            'barang' => $tblbarang::all(),
            'idbeli' => $idbeli,
            'tblbeli' => $tblbelitemp->get(),
        ];
        return view('admin.a_beliadd',$data);
    }

    public function cekkodebrg(Request $request){
        $tblbarang = new Barang();
        $tblbarang = $tblbarang->where('kodebrg',$request->kodebrg);
        $count = $tblbarang->count();
        if($count>0){
            return 'B|'.$tblbarang->first()->idbrg.'|'.$tblbarang->first()->namabrg;
        }else{
            return 'G|';
        }
    }

    public function tambahdataproses(){
        Request()->validate([
            'kodebrg' => 'required|exists:tblbarang,kodebrg',
            'qty' => 'required|integer',
            'hargabeli' => 'required|integer',
        ],[
            'kodebrg.required' => 'Kode barang harus diisi',
        ]);

        $iduser = Auth::user()->id;
        
        $data = [
            'iduser' => $iduser,
            'idbrg' => Request()->idbrg,
            'qty' => Request()->qty,
            'hargabeli' => Request()->hargabeli,
        ];

        $tblbelitemp = new tblbelitemp();
        $tblbelitemp::create($data);

        return redirect()->route('adminbeliadd')->with('pesan','Data berhasil ditambahkan');
    }

    public function hapusdata($id){        
        tblbelitemp::where('idbelitemp',$id)->delete(); 
        return redirect()->route('adminbeliadd')->with('pesan','Data berhasil dihapus');
    }

    public function simpanproses(){
        Request()->validate([
            'idbeli' => 'required|unique:tblbeli,idbeli',
            'tgl' => 'required',
            'idsupplier' => 'required|exists:tblsupplier,idsupplier',
        ],[
        ]);

        $tblbelitemp = new tblbelitemp();

        $iduser = Auth::user()->id;

        $datatemp = [
            'temp' => $tblbelitemp->where('iduser',$iduser)->get(),
        ];
        $idbeli = Request()->idbeli;
        $idsupplier = Request()->idsupplier;
        $tgl = Request()->tgl;
        $subtotal = 0;

        foreach($datatemp['temp'] as $p){
            $idbrg = $p->idbrg;
            $qty = $p->qty;
            $harga = $p->hargabeli;
            $total = $qty * $harga;
            $subtotal += $total;
            
            $tblbelidetil = new tblbelidetil;
            $tblbelidetil->idbeli = $idbeli;
            $tblbelidetil->idbrg = $idbrg;
            $tblbelidetil->qty = $qty;
            $tblbelidetil->hargabeli = $harga;
            $tblbelidetil->total = $total;
            $tblbelidetil->save();
        }

        $tblbeli = new tblbeli;
        $tblbeli->idbeli = $idbeli;
        $tblbeli->iduser = $iduser;
        $tblbeli->idsupplier = $idsupplier;
        $tblbeli->tgl = $tgl;
        $tblbeli->subtotal = $subtotal;
        $tblbeli->save();

        $tblbelitemp->where('iduser',$iduser)->delete();

        return redirect()->route('adminbeli')->with('pesan','Data berhasil ditambahkan');
    }

    public function deletedata($id){        
        tblbeli::where('idbeli',$id)->delete(); 
        tblbelidetil::where('idbeli',$id)->delete(); 
        return redirect()->route('adminbeli')->with('pesan','Data berhasil dihapus');
    }

    public function detaildata($id){
        $tblbeli = new tblbeli();

        $data = [
            'beli' => $tblbeli->alldatain()->where('idbeli',$id)->first(),
            'belidetil' => $tblbeli->alldatadetilin()->where('tblbelidetil.idbeli',$id)->get(),
        ];

        return view('admin.a_belidetil',$data);
    }

    
    public function laporanbeli(Request $request){
        
        if($request->cetak != null){
            return redirect()->route('belicetak',request()->query());
        }
        
        $tblbeli = new tblbeli();
        if($request->jenis=='1' || $request->jenis==null){
            $tblbeli1 =  $tblbeli->allwithcount();
            $tbldetil = $tblbeli->allwdetilnoconbrg();
            if($request->dari != null){
                $tblbeli1 = $tblbeli1->whereDate('tblbeli.tgl','>=',$request->dari);
                $tbldetil = $tbldetil->whereDate('tblbeli.tgl','>=',$request->dari);
            }
    
            if($request->sampai != null){
                $tblbeli1 = $tblbeli1->whereDate('tblbeli.tgl','<=',$request->sampai);
                $tbldetil = $tbldetil->whereDate('tblbeli.tgl','<=',$request->sampai);
            }
    
            $data = [
                'beli' => $tblbeli1->get(),
                'belidetil' => $tbldetil->get(),
            ];
        }else{
            $tblbeli1 = $tblbeli->groupday();
            $tbldetil =  $tblbeli->groupdaydetil();
            if($request->bulan != null){
                $split = explode('-',$request->bulan);
                $tblbeli1 = $tblbeli1->whereYear('tgl','=',$split[0])->whereMonth('tgl','=',$split[1]);
                $tbldetil = $tbldetil->whereYear('tgl','=',$split[0])->whereMonth('tgl','=',$split[1]);
            }

            $data = [
                'beli' => $tblbeli1->get(),
                'belidetil' => $tbldetil->get(),
            ];
        }
        
        return view('admin.a_laporanbeli',$data);

    }
    
    
    public function laporancetak(Request $request){
        
        $tblbeli = new tblbeli();
        if($request->jenis=='1' || $request->jenis==null){
            $tblbeli1 =  $tblbeli->allwithcount();
            $tbldetil = $tblbeli->allwdetilnoconbrg();
            if($request->dari != null){
                $tblbeli1 = $tblbeli1->whereDate('tblbeli.tgl','>=',$request->dari);
                $tbldetil = $tbldetil->whereDate('tblbeli.tgl','>=',$request->dari);
            }
    
            if($request->sampai != null){
                $tblbeli1 = $tblbeli1->whereDate('tblbeli.tgl','<=',$request->sampai);
                $tbldetil = $tbldetil->whereDate('tblbeli.tgl','<=',$request->sampai);
            }
    
            $data = [
                'beli' => $tblbeli1->get(),
                'belidetil' => $tbldetil->get(),
            ];
        }else{
            $tblbeli1 = $tblbeli->groupday();
            $tbldetil =  $tblbeli->groupdaydetil();
            if($request->bulan != null){
                $split = explode('-',$request->bulan);
                $tblbeli1 = $tblbeli1->whereYear('tgl','=',$split[0])->whereMonth('tgl','=',$split[1]);
                $tbldetil = $tbldetil->whereYear('tgl','=',$split[0])->whereMonth('tgl','=',$split[1]);
            }

            $data = [
                'beli' => $tblbeli1->get(),
                'belidetil' => $tbldetil->get(),
            ];
        }
        
        return view('admin.a_laporanbelicetak',$data);

    }
    

}
