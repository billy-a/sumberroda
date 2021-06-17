<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\tblmerek;

class MerekController extends Controller
{
    public function index(){
        $data = [
            'merek' => tblmerek::all()
        ];
        return view('admin.a_merek',$data);
    }

    public function tambahdata(){
        return view('admin.a_merekadd');
    }

    public function tambahdataproses(){
        Request()->validate([
            'kodemerek' => 'required|unique:tblmerek',
            'namamerek' => 'required',
        ],[
            'kodemerek.required' => 'Kode merek wajib diisi',
            'namamerek.required' => 'Nama merek wajib diisi',
        ]);

        $data = [
            'kodemerek' => Request()->kodemerek,
            'namamerek' => Request()->namamerek,         
        ];

        tblmerek::create($data);

        return redirect()->route('adminmerek')->with('pesan','Data berhasil ditambahkan');
    }

    public function updatedata($id){
        $data = [
            'merek' => tblmerek::where('id',$id)->first()
        ];
        return view('admin.a_merekupdate',$data);
    }

    public function updatedataproses($id){

        Request()->validate([
            'kodemerek' => 'required|unique:tblmerek,kodemerek,'.$id,
            'namamerek' => 'required',
        ],[
            'kodemerek.required' => 'Kode merek wajib diisi',
            'namamerek.required' => 'Nama merek wajib diisi',
        ]);

        $data = [
            'kodemerek' => Request()->kodemerek,
            'namamerek' => Request()->namamerek,         
        ];

        tblmerek::where('id',$id)->update($data); 

        return redirect()->route('adminmerek')->with('pesan','Data berhasil diubah');
    }

    public function hapusdata($id){
        tblmerek::where('id',$id)->delete(); 
        return redirect()->route('adminmerek')->with('pesan','Data berhasil dihapus');

    }
}
