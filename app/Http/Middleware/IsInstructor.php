<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class IsInstructor
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
         if (Auth::user() &&  Auth::user()->user_type == 'instructor') {

                return $next($request);
         }

        return redirect('/instructor_listing');
    }
}
