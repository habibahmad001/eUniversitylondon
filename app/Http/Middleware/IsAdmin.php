<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class IsAdmin
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
         if (Auth::user() &&  Auth::user()->user_type == 'admin') {
                return $next($request);
         }
         else if(Auth::user() &&  Auth::user()->user_type == 'instructor') {
             return redirect('/instructor/dashboard');
         } else if(Auth::user() &&  Auth::user()->user_type == 'learner') {
             return redirect('/learner/dashboard');
         }
        return redirect('/admin/dashboard');
    }
}
