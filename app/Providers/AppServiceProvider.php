<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\tbljual;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $jual = tbljual::where('status','1')->get();
        foreach($jual as $p){
            $date1 = new \DateTime($p->tglpesan);
            $date2 = new \DateTime(date('Y-m-d H:i:s'));
    
            $interval = $date1->diff($date2);
            if($interval->h >= 4){
                tbljual::where('idjual',$p->idjual)->update(['status'=>'5']);
            }
        }
    }
}
