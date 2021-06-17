<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class tblbelitemp extends Model
{
    protected $table = "tblbelitemp";
    protected $guarded = ['idbelitemp'];
    
    public function alldatain(){
        return  DB::table('tblbelitemp')
                ->join('tblbarang','tblbarang.idbrg','=','tblbelitemp.idbrg');
    }
}
