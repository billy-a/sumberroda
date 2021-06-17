<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class tblcart extends Model
{
    protected $table = "tblcart";
    protected $fillable = ['qty','iduser','idbrg','instalasi'];

    public function allData($iduser)
    {
        return  DB::table('tblcart')
                ->join('tblbarang','tblbarang.idbrg','=','tblcart.idbrg')
                ->where('iduser',$iduser)->get();
        // $users = DB::table('users')
        // ->join('contacts', 'users.id', '=', 'contacts.user_id')
        // ->join('orders', 'users.id', '=', 'orders.user_id')
        // ->select('users.*', 'contacts.phone', 'orders.price')
        // ->get();
        // DB::table('usermetas')
        //          ->select('browser', DB::raw('count(*) as total'))
        //          ->groupBy('browser')
        //          ->get();
    }

    public function allDataCheck($iduser)
    {
        return  DB::table('tblcart')
                ->join('tblbarang','tblbarang.idbrg','=','tblcart.idbrg')
                ->where('iduser',$iduser)
                ->where('checkout','1')
                ->get();
    }

    public function deletedatadone($iduser)
    {
        DB::table('tblcart')
        ->where('iduser',$iduser)
        ->where('checkout','1')
        ->delete();
    }
}
