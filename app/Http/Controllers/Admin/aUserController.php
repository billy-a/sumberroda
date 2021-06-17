<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class aUserController extends Controller
{
    public function index(){
        $data = [
            'user' => User::all()
        ];
        return view('admin.a_user',$data);
    }

    public function updatedata($value,$id){
        if($value=='up'){
            User::where('id',$id)->update(['level'=>'2']);
        }elseif($value=='down'){
            User::where('id',$id)->update(['level'=>'1']);
        }
        return redirect()->route('adminuser')->with('pesan','Data berhasil diubah');
    }
}
