<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class searchMiddleware
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
        // dd(Auth::user()->role_id);
        if(Auth::guard($guard)->guest())
        {
            return redirect()->guest('/');
        }
        elseif (Auth::user()->role_id < 3 || Auth::user()->role_id == 5) {
            return $next($request);
        }
        else{
            return redirect('/home');
        }
        // return $next($request);
    }
}
