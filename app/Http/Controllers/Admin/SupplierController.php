<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\tblsupplier;

class SupplierController extends Controller
{
    public function index(){
        $data = [
            'supplier' => tblsupplier::all()
        ];
        return view('admin.a_supplier',$data);
    }

    public function tambahdata(){
        return view('admin.a_supplieradd');
    }

    public function tambahdataproses(){
        Request()->validate([
            'namasupp' => 'required',
            'alamatsupp' => 'required',
            'nohpsupp' => 'required'
        ],[
            'namasupp.required' => 'Nama supplier wajib diisi',
            'alamatsupp.required' => 'Alamat supplier wajib diisi',
            'nohpsupp.required' => 'No. HP supplier wajib diisi'
        ]);

        $data = [
            'namasupp' => Request()->namasupp,
            'alamatsupp' => Request()->alamatsupp,
            'nohpsupp' => Request()->nohpsupp,            
        ];

        tblsupplier::create($data);

        return redirect()->route('adminsupplier')->with('pesan','Data berhasil ditambahkan');
    }

    public function updatedata($id){
        $data = [
            'supplier' => tblsupplier::where('idsupplier',$id)->first()
        ];
        return view('admin.a_supplierupdate',$data);
    }

    public function updatedataproses($id){
        Request()->validate([
            'namasupp' => 'required',
            'alamatsupp' => 'required',
            'nohpsupp' => 'required'
        ],[
            'namasupp.required' => 'Nama supplier wajib diisi',
            'alamatsupp.required' => 'Alamat supplier wajib diisi',
            'nohpsupp.required' => 'No. HP supplier wajib diisi'
        ]);

        $data = [
            'namasupp' => Request()->namasupp,
            'alamatsupp' => Request()->alamatsupp,
            'nohpsupp' => Request()->nohpsupp,            
        ];

        tblsupplier::where('idsupplier',$id)->update($data); 

        return redirect()->route('adminsupplier')->with('pesan','Data berhasil diubah');
    }

    public function hapusdata($id){
        tblsupplier::where('idsupplier',$id)->delete(); 
        return redirect()->route('adminsupplier')->with('pesan','Data berhasil dihapus');

    }
}
