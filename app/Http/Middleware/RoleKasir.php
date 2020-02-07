<?php

namespace App\Http\Middleware;

use Closure;

class RoleKasir
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
        if (\Auth::user()->level_id == "3"){
            return $next($request);
        }else{
            abort(404);
        }
    }
}
