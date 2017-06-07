<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckIfDocent
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
       
        // return $next($request);
        if(Auth::guard($guard)->guest())
        {
            return redirect()->guest('login');
        }
        elseif (Auth::user()->role_id == 1) {
            return $next($request);
        }
        else{
            return back();
        }
    }
}
