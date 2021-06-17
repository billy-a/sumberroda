<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tblkategori extends Model
{
    protected $table = "tblkategori";
    protected $guarded = ['idkategori'];

    public function alldata(){
        return tblkategori::all();
    }
}
