<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Barang;
use App\Models\tblkategori;
use App\Models\tblmerek;

class BarangController extends Controller
{
    
    public function index()
    {
        $tblkategori = new tblkategori;
        $tblbarang = new Barang;
        $kategori = $tblkategori->alldata();
        $barang = $tblbarang::paginate(15);
        $data = [
            'barang'=>$barang->appends(request()->query()),
            'lebar' => $tblbarang->alldata()->where('idkategori','1')->groupBy('lebarban')->get(),
            'rasio' => $tblbarang->alldata()->where('idkategori','1')->groupBy('rasioban')->get(),
            'diameter' => $tblbarang->alldata()->where('idkategori','1')->groupBy('diameterban')->get(),
            'kategori'=>$kategori,
        ];
        return view('v_home',$data);
    }

    public function get_ajax_barang(Request $request)
    {
        if($request->ajax())
        {
            $barang = Barang::paginate(15);
            return view('p_ajax.v_barangproses', ['barang'=>$barang]);
        }
    }

    public function detailbrg($idbrg){
        $dbarang = Barang::where('idbrg',$idbrg)->first();
        return view('v_dbarang',['dbarang'=>$dbarang]);
        // $dbarang = [
        //     'dbarang' => $this->Barang->detailData($idbrg),
        // ];
        // return view('dbarang',$dbarang);
    }

    public function filterbrg($ktg,Request $request){
        $tblkategori = new tblkategori;
        $tblmerek = new tblmerek;
        $tblbarang = new Barang;
        
        
        $filtering = $tblbarang->where('idkategori',$ktg);        
        $kategoridata = tblkategori::where('idkategori',$ktg)->first();
        if($filtering->count() > 0){
            $jenisfilter = explode('|',$kategoridata->filter);

            if(in_array('harga', $jenisfilter)){
                if($request->min != null){
                    $filtering = $filtering->where('hargajual','>=',$request->min);
                }
                if($request->max != null){
                    $filtering = $filtering->where('hargajual','<=',$request->max);
                }
            }

            if(in_array('lebar', $jenisfilter) && $request->lebar != null){
                $filtering = $filtering->where('lebarban',$request->lebar);
            }

            if(in_array('rasio', $jenisfilter) && $request->rasio != null){
                $filtering = $filtering->where('rasioban',$request->rasio);
            }

            if(in_array('ring', $jenisfilter) && $request->diameter != null){
                $filtering = $filtering->where('diameterban',$request->diameter);
            }

            if(in_array('merek', $jenisfilter) && $request->merek != null){
                $filtering = $filtering->where('idmerek',$request->merek);
            }
            
        }else{
            return redirect()->route('home');
        }
        

        $data = [
            'kategori' => $kategoridata,
            'barang' => $filtering->get(),
            'lebar' => $tblbarang->alldata()->where('idkategori',$ktg)->groupBy('lebarban')->get(),
            'rasio' => $tblbarang->alldata()->where('idkategori',$ktg)->groupBy('rasioban')->get(),
            'diameter' => $tblbarang->alldata()->where('idkategori',$ktg)->groupBy('diameterban')->get(),
            'merek' => tblmerek::all(),
        ];
        return view('v_filter',$data);
    }
}
