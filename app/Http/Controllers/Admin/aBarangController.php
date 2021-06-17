<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\tblkategori;
use App\Models\tblmerek;
use Image;

class aBarangController extends Controller
{

    public function index(){
        $barang = new barang();

        $data = [
            'barang' => $barang->AllDataJoin()->get()
        ];
        return view('admin.a_barang',$data);
    }

    public function tambahdata(){
        $tblkategori = new tblkategori();
        $tblmerek = new tblmerek();
        $data = [
            'kategori' => $tblkategori::all(),
            'merek' => $tblmerek::all(),
        ];
        return view('admin.a_barangadd',$data);
    }

    public function tambahdataproses(){
        Request()->validate([
            'kodebrg' => 'required|unique:tblbarang,kodebrg',
            'namabrg' => 'required',
            'stok' => 'required|integer',
            'idkategori' => 'required|exists:tblkategori,idkategori',
            'idmerek' => 'required|exists:tblmerek,id',
            'lebarban' => 'sometimes|required|integer',
            'rasioban' => 'sometimes|required|integer',
            'diameterban' => 'sometimes|required|integer',
            'infoservis' => 'required',
            'detail' => 'required',
            'hargajual' => 'required|integer',
            'hargajasa' => 'required|integer',
            'gambar' => 'required|mimes:jpg,jpeg,png|max:2048',
        ],[
            'kodebrg.required' => 'Kode barang harus diisi',
            'namabrg.required' => 'Nama barang harus diisi',
            'stok.required' => 'Stok barang harus diisi',
            'idkategori.exists' => 'Kategori barang harus dipilih',
            'idmerek.exists' => 'Merek barang harus dipilih',
            'lebarban.required' => 'Lebar ban harus diisi',
            'rasioban.required' => 'Rasio ban harus diisi',
            'diameterban.required' => 'Diameter ban harus diisi',
            'infoservis.required' => 'Info servis harus diisi',
            'detail.required' => 'Detail harus diisi',
            'hargajual.required' => 'Harga jual harus diisi',
            'hargajasa.required' => 'Harga jasa harus diisi',
        ]);

        $image = Request()->gambar; 
        $imagename = Request()->kodebrg.'.'.$image->extension();
        $filepath = public_path('assets');
        $img = Image::make($image->path());
        $img->resize(800, 800)->save($filepath.'/'.$imagename);    
        //$image->move($filepath,$filename);

        $data = [
            'kodebrg' => Request()->kodebrg,
            'namabrg' => Request()->namabrg,
            'stok' => Request()->stok,
            'idkategori' => Request()->idkategori,
            'idmerek' => Request()->idmerek,
            'lebarban' => Request()->lebarban,
            'rasioban' => Request()->rasioban,
            'diameterban' => Request()->diameterban,
            'infoservis' => Request()->infoservis,
            'detail' => Request()->detail,
            'hargajual' => Request()->hargajual,
            'hargajasa' => Request()->hargajasa,
            'gambar' => $imagename,
        ];

        barang::create($data);

        return redirect()->route('adminbarang')->with('pesan','Data berhasil ditambahkan');
    }
    
    public function updatedata($id){
        $tblkategori = new tblkategori();
        $tblmerek = new tblmerek();

        $data = [
            'barang' => barang::where('idbrg',$id)->first(),
            'kategori' => $tblkategori::all(),
            'merek' => $tblmerek::all(),
        ];
        return view('admin.a_barangupdate',$data);
    }

    public function updatedataproses($id){
        Request()->validate([
            'kodebrg' => 'required|unique:tblbarang,kodebrg,'.$id.',idbrg',
            'namabrg' => 'required',
            'stok' => 'required|integer',
            'idkategori' => 'required|exists:tblkategori,idkategori',
            'idmerek' => 'required|exists:tblmerek,id',
            'lebarban' => 'sometimes|required|integer',
            'rasioban' => 'sometimes|required|integer',
            'diameterban' => 'sometimes|required|integer',
            'infoservis' => 'required',
            'detail' => 'required',
            'hargajual' => 'required|integer',
            'hargajasa' => 'required|integer',
            'gambar' => 'required|mimes:jpg,jpeg,png|max:2048',
        ],[
            'kodebrg.required' => 'Kode barang harus diisi',
            'namabrg.required' => 'Nama barang harus diisi',
            'stok.required' => 'Stok barang harus diisi',
            'idkategori.exists' => 'Kategori barang harus dipilih',
            'idmerek.exists' => 'Merek barang harus dipilih',
            'lebarban.required' => 'Lebar ban harus diisi',
            'rasioban.required' => 'Rasio ban harus diisi',
            'diameterban.required' => 'Diameter ban harus diisi',
            'infoservis.required' => 'Info servis harus diisi',
            'detail.required' => 'Detail harus diisi',
            'hargajual.required' => 'Harga jual harus diisi',
            'hargajasa.required' => 'Harga jasa harus diisi',
        ]);

        $image = Request()->gambar; 
        $imagename = Request()->kodebrg.'.'.$image->extension();
        $filepath = public_path('assets');
        $img = Image::make($image->path());
        $img->resize(800, 800)->save($filepath.'/'.$imagename);

        $data = [
            'kodebrg' => Request()->kodebrg,
            'namabrg' => Request()->namabrg,
            'stok' => Request()->stok,
            'idkategori' => Request()->idkategori,
            'idmerek' => Request()->idmerek,
            'lebarban' => Request()->lebarban,
            'rasioban' => Request()->rasioban,
            'diameterban' => Request()->diameterban,
            'infoservis' => Request()->infoservis,
            'detail' => Request()->detail,
            'hargajual' => Request()->hargajual,
            'hargajasa' => Request()->hargajasa,
            'gambar' => $imagename,
        ];

        barang::where('idbrg',$id)->update($data); 

        return redirect()->route('adminbarang')->with('pesan','Data berhasil diubah');
    }

    public function hapusdata($id){
        
        $barang = barang::where('idbrg',$id)->first(); 
        if($barang->gambar != ""){
            unlink(public_path('assets').'/'.$barang->gambar);
        }
        barang::where('idbrg',$id)->delete(); 
        return redirect()->route('adminbarang')->with('pesan','Data berhasil dihapus');
    }

    public function laporanbarang(Request $request){

        if($request->cetak != null){
            return redirect()->route('barangcetak',request()->query());
        }
                
        $barang = new barang;
        $tblkategori = new tblkategori();
        $tblmerek = new tblmerek();

        $brg = $barang->AllDataJoin();

        if($request->key != null){
            $brg = $brg->where('namabrg','like','%'.$request->key.'%');
        }

        if($request->ktg != null){
            $brg = $brg->where('tblbarang.idkategori',$request->ktg);
        }

        if($request->m != null){
            $brg = $brg->where('tblbarang.idmerek',$request->m);
        }

        $data = [
            'barang' => $brg->paginate(15)->appends(request()->query()),
            'kategori' => $tblkategori::all(),
            'merek' => $tblmerek::all(),
        ];
        return view('admin.a_laporanbarang',$data);
    }

    public function laporancetak(Request $request){

        $barang = new barang;
        $tblkategori = new tblkategori();
        $tblmerek = new tblmerek();

        $brg = $barang->AllDataJoin();

        if($request->key != null){
            $brg = $brg->where('namabrg','like','%'.$request->key.'%');
        }

        if($request->ktg != null){
            $brg = $brg->where('tblbarang.idkategori',$request->ktg);
        }

        if($request->m != null){
            $brg = $brg->where('tblbarang.idmerek',$request->m);
        }

        $data = [
            'barang' => $brg->get(),
            'kategori' => $tblkategori::all(),
            'merek' => $tblmerek::all(),
        ];
        return view('admin.a_laporanbarangcetak',$data);
    }
}
