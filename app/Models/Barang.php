<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Barang extends Model
{
    protected $table = "tblbarang";
    protected $guarded = ['idbrg'];
    

    public function AllDataJoin()
    {
        return  DB::table('tblbarang')
                ->join('tblkategori','tblkategori.idkategori','=','tblbarang.idkategori')
                ->join('tblmerek','tblmerek.id','=','tblbarang.idmerek')
                ->orderBy('namakategori')
                ->orderBy('namamerek')  
                ->orderBy('namabrg');

    }

    public function alldata()
    {
        return DB::table('tblbarang')
                ->orderBy('namabrg');
        
    }

}
