<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class dbarangController extends Controller
{
    public function index($id)
    {
        $data = [
            'id' => $id
        ];
        return view('v_dbarang', $data);
    }
}
