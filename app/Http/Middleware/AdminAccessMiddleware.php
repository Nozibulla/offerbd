<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Support\Facades\Auth;

use App;

class AdminAccessMiddleware
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
        // dd($role);

        if (Auth::guard($guard)->guest()) {

            if ($request->ajax() || $request->wantsJson()) {

                return response('Unauthorized.', 401);

            } else {

                return redirect()->guest('/admin/login');
            }
        }
        else if(Auth::guard($guard)->user()->status == 0){

            return redirect('/admin/under-review');
        }

        if (is_null($role)) {

            if(!Auth::guard($guard)->user()->hasRole('owner') && !Auth::guard($guard)->user()->hasRole('administrator') ){

                App::abort(403);
            }
        }
        else{

            if(!Auth::guard($guard)->user()->hasRole($role)){

                App::abort(403);
            }
        }

        return $next($request);
    }

}
