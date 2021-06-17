<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class tbljual extends Model
{
    protected $table = "tbljual";
    protected $guarded = ['idjual'];
    
    public function countdata($idjual,$iduser)
    {
        return  DB::table('tbljual')
                ->where('iduser',$iduser)
                ->where('idjual',$idjual);
    }
    
    public function forcheckouts($idjual,$iduser)
    {
        return  DB::table('tbljual')
                ->join('tblbank','tblbank.idbank','=','tbljual.idbank')
                ->where('iduser',$iduser)
                ->where('idjual',$idjual)
                ->where('status','1');
    }

    public function alldata($iduser,$status = null)
    {
        if($status!='0'){
            return  DB::table('tbljual')
                    ->join('tbljualdetil','tbljualdetil.idjual','=','tbljual.idjual')
                    ->join('tblbarang','tblbarang.idbrg','=','tbljualdetil.idbrg')                
                    ->join('tblbank','tblbank.idbank','=','tbljual.idbank')                
                    ->where('tbljual.iduser',$iduser)
                    ->where('tbljual.status',$status)
                    ->orderByDesc('tbljual.created_at');
        }else{
            return  DB::table('tbljual')
                    ->join('tbljualdetil','tbljualdetil.idjual','=','tbljual.idjual')
                    ->join('tblbarang','tblbarang.idbrg','=','tbljualdetil.idbrg')                
                    ->join('tblbank','tblbank.idbank','=','tbljual.idbank')                
                    ->where('tbljual.iduser',$iduser)
                    ->orderByDesc('tbljual.created_at');
        }

    }

    public function allnocon(){
        return  DB::table('tbljual')
                ->join('users','users.id','=','tbljual.iduser')
                ->join('tblbank','tblbank.idbank','=','tbljual.idbank')
                ->orderByDesc('tbljual.updated_at');
    }

    public function allwdetilnocon(){
        return  DB::table('tbljual')
                ->join('tbljualdetil','tbljualdetil.idjual','=','tbljual.idjual')
                ->orderByDesc('tbljual.updated_at');
    }

    public function allwdetilnoconbrg(){
        return  DB::table('tbljual')
                ->join('tbljualdetil','tbljualdetil.idjual','=','tbljual.idjual')
                ->join('tblbarang','tblbarang.idbrg','=','tbljualdetil.idbrg')
                ->orderByDesc('tglpesan');
    }

    public function allwithcount(){

        // DB::table('usermetas')
        //          ->select('browser', DB::raw('count(*) as total'))
        //          ->groupBy('browser')
        //          ->get();
        return DB::table('tbljual')        
                ->select('*',DB::raw('count(*) as count'))
                ->join('users','users.id','=','tbljual.iduser')
                ->join('tblbank','tblbank.idbank','=','tbljual.idbank')
                ->join('tbljualdetil','tbljualdetil.idjual','=','tbljual.idjual')
                ->groupBy('tbljual.idjual')
                ->orderByDesc('tglpesan');
              
    }

    public function groupday(){
        return DB::table('tbljual')
                ->select(DB::raw('date(tglpesan) as tglpes,tbljualdetil.idbrg,sum(qty) as qtys,sum(subtotal) as gt'))
                ->join('tbljualdetil','tbljualdetil.idjual','=','tbljual.idjual')
                ->groupBy('tglpes')
                ->orderByDesc('tglpes')                
                ->orderByDesc('tbljualdetil.idbrg');                
    }

    public function groupdaydetil(){
        return DB::table('tbljual')
                ->select(DB::raw('date(tglpesan) as tglpes,tbljualdetil.idbrg,tblbarang.namabrg,sum(qty) as qtys,sum(total) as gt'))
                ->join('tbljualdetil','tbljualdetil.idjual','=','tbljual.idjual')
                ->join('tblbarang','tblbarang.idbrg','=','tbljualdetil.idbrg')
                ->groupBy('tbljualdetil.idbrg')
                ->groupBy('tglpes')
                ->orderByDesc('tglpes')      
                ->orderByDesc('tbljualdetil.idbrg');                

    }
}
