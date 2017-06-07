<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class CheckIfDirectie
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$guard = 'user')
    {
        // dd(Auth::user());
        if(Auth::guard($guard)->guest())
        {
            return redirect()->guest('login');
        }
        elseif (Auth::user()->role_id == 5) {
            return $next($request);
        }
        else{
            return back();
        }
        // return $next($request);
    }
}
