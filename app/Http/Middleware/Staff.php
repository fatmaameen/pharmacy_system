<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Staff
{

    public function handle(Request $request, Closure $next)
    {
        if(auth()->user()->role_id==2||auth()->user()->role_id==1){
            return $next($request);
        }else{
            return redirect()->back()->with('error','غير مسرح');
        }

    }
}
