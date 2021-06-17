<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\tblbank;

class BankController extends Controller
{
    public function index(){
        $data = [
            'bank' => tblbank::all()
        ];
        return view('admin.a_bank',$data);
    }

    public function tambahdata(){
        return view('admin.a_bankadd');
    }

    public function tambahdataproses(){
        Request()->validate([
            'namabank' => 'required',
            'namarek' => 'required',
            'norek' => 'required',
        ],[
            'namabank.required' => 'Nama Bank wajib diisi',
            'namarek.required' => 'Nama Rekening wajib diisi',
            'norek.required' => 'Nomor Rekening wajib diisi',
        ]);

        $data = [
            'namabank' => Request()->namabank,
            'namarek' => Request()->namarek,         
            'norek' => Request()->norek,         
        ];

        tblbank::create($data);

        return redirect()->route('adminbank')->with('pesan','Data berhasil ditambahkan');
    }

    public function updatedata($id){
        $data = [
            'bank' => tblbank::where('idbank',$id)->first()
        ];
        return view('admin.a_bankupdate',$data);
    }

    public function updatedataproses($id){

        Request()->validate([
            'namabank' => 'required',
            'namarek' => 'required',
            'norek' => 'required',
        ],[
            'namabank.required' => 'Nama Bank wajib diisi',
            'namarek.required' => 'Nama Rekening wajib diisi',
            'norek.required' => 'Nomor Rekening wajib diisi',
        ]);

        $data = [
            'namabank' => Request()->namabank,
            'namarek' => Request()->namarek,         
            'norek' => Request()->norek,         
        ];


        tblbank::where('idbank',$id)->update($data); 

        return redirect()->route('adminbank')->with('pesan','Data berhasil diubah');
    }

    public function hapusdata($id){
        tblbank::where('idbank',$id)->delete(); 
        return redirect()->route('adminbank')->with('pesan','Data berhasil dihapus');

    }

}
