<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\True_;

class middleware_check_page_access_for_admin_level
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ( Auth::check() === TRUE && isset(Auth::user()->user_type) && e(Auth::user()->user_type) === 'admin' )
        {
            return $next($request);
        }
        else
        {
            Auth::logout();
            return redirect('/login');
        }
    }
}
