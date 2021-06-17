<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Pemilik
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(auth()->user()){
            if(auth()->user()->level == 3) {
                return $next($request);
            }else{
                return redirect('/adminpage');
            }
        }else{
            return abort(404);
        }

    }
}
