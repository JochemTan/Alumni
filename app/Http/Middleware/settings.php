<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class settings
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = 'user')
    {
               // return $next($request);
        if(Auth::guard($guard)->guest())
        {
            return redirect()->guest('login');
        }
        elseif (Auth::user()->role_id != 2) {
            return $next($request);
        }
        else{
            return back();
        }
    }
}
