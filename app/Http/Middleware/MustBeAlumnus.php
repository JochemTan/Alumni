<?php

namespace App\Http\Middleware;

use App\Alumnus;
use Closure;
use Illuminate\Support\Facades\Auth;

class MustBeAlumnus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = 'alumnus' )
    {
      // if the person that comes on this application is an user
      if(Auth::guard('user')->check())
      {
          return redirect('/home');
      }
      else{
        if(Auth::guard($guard)->check())
        {
          return $next($request);
        }
        else{
         return redirect('alumnus/login');
        }
      }
       
    }
}
