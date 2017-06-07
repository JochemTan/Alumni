<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;


class MustBeEmployee
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
      if(Auth::guard($guard)->guest())
      {
        return redirect()->guest('/');
      }
      elseif (Auth::user()->role_id == 2) {
        return $next($request);
      }
      else{
        return back();
      }
    }
}
