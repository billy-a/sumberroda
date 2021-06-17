<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\tblkategori;

class KategoriController extends Controller
{
    public function index(){
        $data = [
            'kategori' => tblkategori::all()
        ];
        return view('admin.a_kategori',$data);
    }

    public function tambahdata(){
        return view('admin.a_kategoriadd');
    }

    public function tambahdataproses(){
        Request()->validate([
            'namakategori' => 'required|unique:tblkategori',
            'filter' => 'required',
        ],[
            'namakategori.required' => 'Nama kategori wajib diisi',
            'filter.required' => 'Pilih minimal 1 jenis filter',
        ]);

        $data = [
            'namakategori' => Request()->namakategori,
            'filter' => join('|',Request()->filter),
        ];

        tblkategori::create($data);

        return redirect()->route('adminkategori')->with('pesan','Data berhasil ditambahkan');
    }
    
    public function updatedata($id){
        $data = [
            'kategori' => tblkategori::where('idkategori',$id)->first()
        ];
        return view('admin.a_kategoriupdate',$data);
    }

    public function updatedataproses($id){
        Request()->validate([
            'namakategori' => 'required|unique:tblkategori,namakategori,'.$id.',idkategori',
            'filter' => 'required',
        ],[
            'namakategori.required' => 'Nama kategori wajib diisi',
            'filter.required' => 'Pilih minimal 1 jenis filter',
        ]);

        $data = [
            'namakategori' => Request()->namakategori,
            'filter' => join('|',Request()->filter),
        ];

        tblkategori::where('idkategori',$id)->update($data); 

        return redirect()->route('adminkategori')->with('pesan','Data berhasil diubah');
    }

    public function hapusdata($id){
        tblkategori::where('idkategori',$id)->delete(); 
        return redirect()->route('adminkategori')->with('pesan','Data berhasil dihapus');

    }

}
