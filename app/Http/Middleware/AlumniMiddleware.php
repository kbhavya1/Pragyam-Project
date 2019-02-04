<?php

namespace App\Http\Middleware;

use Closure;

class AlumniMiddleware
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
        if(\Auth::user()->accesslevel !=3){
            return redirect('/home');
        }
        return $next($request);
    }
}
