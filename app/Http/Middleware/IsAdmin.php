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
         else if(Auth::user() &&  Auth::user()->user_type == 'employee') {
             return redirect('/employee_listing');
         } else if(Auth::user() &&  Auth::user()->user_type == 'employer') {
             return redirect('/employer_listing');
         }
        return redirect('/dashboard');
    }
}
