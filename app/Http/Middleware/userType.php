<?php

namespace App\Http\Middleware;

use Closure;

class userType
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
        if($request->user()->type != 'ADMIN' and $request->user()->type != 'SUPER'){
            abort(403, "¡No tienes los permisos necesarios!");
        }
        return $next($request);
    }
}
