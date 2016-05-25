<?php

namespace App\Http\Middleware;

use Closure;

class OwnerAccessMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role = null, $guard = 'admin')
    {

        
        return $next($request);
    }
}
Auth::guard($guard)->user()->role->first()->role_name != $role