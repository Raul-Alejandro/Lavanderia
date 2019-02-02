<?php

namespace App\Http\Middleware;

use Closure;

class Profile
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
        if(request()->segment(2) != $request->user()->id){
            return back();
        }

        return $next($request);
    }
}
