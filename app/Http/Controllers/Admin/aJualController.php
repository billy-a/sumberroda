<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\tbljual;

class aJualController extends Controller
{

    public function index(){
        $tbljual = new tbljual();

        $data = [
            'jual' => $tbljual->allnocon()->get(),
        ];
        return view('admin.a_jual',$data);
    }

    public function indexfilter($id = null){
        $tbljual = new tbljual();

        $data = [
            'jual' => $tbljual->allnocon()
                        ->where('status',$id)->get(),
        ];
        return view('admin.a_jual',$data);
    }

    public function detaildata($id){
        $tbljual = new tbljual();

        $data = [
            'jual' => $tbljual->allnocon()->where('tbljual.idjual',$id)->first(),
            'jualdetil' => $tbljual->allwdetilnocon()->where('tbljual.idjual',$id)->get(),
        ];
        
        return view('admin.a_jualdetail',$data);
    } 

    public function statusdata($id){
        Request()->validate([
            'status' => 'required|in:1,2,3,4,5',
        ],[
        ]);

        $data = [
            'status' => Request()->status,
        ];
        
        tbljual::where('idjual',$id)->update($data);
        return redirect()->route('adminjual')->with('pesan','Data berhasil diubah');
    }

    public function laporanjual(Request $request){
        
        if($request->cetak != null){
            return redirect()->route('jualcetak',request()->query());
        }
        
        $tbljual = new tbljual();
        if($request->jenis=='1' || $request->jenis==null){
            $tbljual1 =  $tbljual->allwithcount();
            $tbldetil = $tbljual->allwdetilnoconbrg();
            if($request->dari != null){
                $tbljual1 = $tbljual1->whereDate('tbljual.tglpesan','>=',$request->dari);
                $tbldetil = $tbldetil->whereDate('tbljual.tglpesan','>=',$request->dari);
            }
    
            if($request->sampai != null){
                $tbljual1 = $tbljual1->whereDate('tbljual.tglpesan','<=',$request->sampai);
                $tbldetil = $tbldetil->whereDate('tbljual.tglpesan','<=',$request->sampai);
            }
    
            $data = [
                'jual' => $tbljual1->get(),
                'jualdetil' => $tbldetil->get(),
            ];
        }else{
            $tbljual1 = $tbljual->groupday();
            $tbldetil =  $tbljual->groupdaydetil();
            if($request->bulan != null){
                $split = explode('-',$request->bulan);
                $tbljual1 = $tbljual1->whereYear('tglpesan','=',$split[0])->whereMonth('tglpesan','=',$split[1]);
                $tbldetil = $tbldetil->whereYear('tglpesan','=',$split[0])->whereMonth('tglpesan','=',$split[1]);
            }

            $data = [
                'jual' => $tbljual1->get(),
                'jualdetil' => $tbldetil->get(),
            ];
        }
        
        return view('admin.a_laporanjual',$data);

    }

    public function laporancetak(Request $request){
        $tbljual = new tbljual();
        if($request->jenis=='1' || $request->jenis==null){
            $tbljual1 =  $tbljual->allwithcount();
            $tbldetil = $tbljual->allwdetilnoconbrg();
            if($request->dari != null){
                $tbljual1 = $tbljual1->whereDate('tbljual.tglpesan','>=',$request->dari);
                $tbldetil = $tbldetil->whereDate('tbljual.tglpesan','>=',$request->dari);
            }
    
            if($request->sampai != null){
                $tbljual1 = $tbljual1->whereDate('tbljual.tglpesan','<=',$request->sampai);
                $tbldetil = $tbldetil->whereDate('tbljual.tglpesan','<=',$request->sampai);
            }
    
            $data = [
                'jual' => $tbljual1->get(),
                'jualdetil' => $tbldetil->get(),
            ];
        }else{
            $tbljual1 = $tbljual->groupday();
            $tbldetil =  $tbljual->groupdaydetil();
            if($request->bulan != null){
                $split = explode('-',$request->bulan);
                $tbljual1 = $tbljual1->whereYear('tglpesan','=',$split[0])->whereMonth('tglpesan','=',$split[1]);
                $tbldetil = $tbldetil->whereYear('tglpesan','=',$split[0])->whereMonth('tglpesan','=',$split[1]);
            }

            $data = [
                'jual' => $tbljual1->get(),
                'jualdetil' => $tbldetil->get(),
            ];
        }
        
        return view('admin.a_laporanjualcetak',$data);
    }
}
