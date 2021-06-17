<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class tblbeli extends Model
{
    protected $table = "tblbeli";
    protected $guarded = ['idbeli'];

    public function alldatain(){
        return  DB::table('tblbeli')
                ->join('users','users.id','=','tblbeli.iduser')
                ->join('tblsupplier','tblsupplier.idsupplier','=','tblbeli.idsupplier');
    }

    public function alldatadetilin(){
        return  DB::table('tblbeli')
                ->join('tblbelidetil','tblbelidetil.idbeli','=','tblbeli.idbeli')
                ->join('tblbarang','tblbarang.idbrg','=','tblbelidetil.idbrg');
    }

    public function allwdetilnoconbrg(){
        return  DB::table('tblbeli')
                ->join('tblbelidetil','tblbelidetil.idbeli','=','tblbeli.idbeli')
                ->join('tblbarang','tblbarang.idbrg','=','tblbelidetil.idbrg')
                ->orderByDesc('tgl');
    }

    public function allwithcount(){

        // DB::table('usermetas')
        //          ->select('browser', DB::raw('count(*) as total'))
        //          ->groupBy('browser')
        //          ->get();
        return DB::table('tblbeli')        
                ->select('*',DB::raw('count(*) as count'))
                ->join('users','users.id','=','tblbeli.iduser')
                ->join('tblsupplier','tblsupplier.idsupplier','=','tblbeli.idsupplier')
                ->join('tblbelidetil','tblbelidetil.idbeli','=','tblbeli.idbeli')
                ->groupBy('tblbeli.idbeli')
                ->orderByDesc('tgl');
              
    }

    public function groupday(){
        return DB::table('tblbeli')
                ->select(DB::raw('date(tgl) as tglpes,tblbelidetil.idbrg,sum(qty) as qtys,sum(subtotal) as gt'))
                ->join('tblbelidetil','tblbelidetil.idbeli','=','tblbeli.idbeli')
                ->groupBy('tglpes')
                ->orderByDesc('tglpes')                
                ->orderByDesc('tblbelidetil.idbrg');                
    }

    public function groupdaydetil(){
        return DB::table('tblbeli')
                ->select(DB::raw('date(tgl) as tglpes,tblbelidetil.idbrg,tblbarang.namabrg,sum(qty) as qtys,sum(total) as gt'))
                ->join('tblbelidetil','tblbelidetil.idbeli','=','tblbeli.idbeli')
                ->join('tblbarang','tblbarang.idbrg','=','tblbelidetil.idbrg')
                ->groupBy('tblbelidetil.idbrg')
                ->groupBy('tglpes')
                ->orderByDesc('tglpes')      
                ->orderByDesc('tblbelidetil.idbrg');                

    }
}
