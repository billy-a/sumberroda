<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Barang;

class BarangController extends Controller
{
    public function index()
    {
        $barang = Barang::paginate(5);
        return view('v_home',['barang'=>$barang]);
    }

    public function get_ajax_barang(Request $request)
    {
        if($request->ajax())
        {
            $barang = Barang::paginate(5);
            return view('p_ajax.v_barangproses', ['barang'=>$barang]);
        }
    }
}
