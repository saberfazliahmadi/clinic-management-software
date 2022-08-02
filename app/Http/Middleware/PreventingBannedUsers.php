<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Responses\Responses;

class PreventingBannedUsers
{
    public function handle(Request $request, Closure $next)
    {
        if ( Auth::check() === TRUE && isset(Auth::user()->status) && e(Auth::user()->status) !== config('global.ban') )
        {
            return $next($request);
        }

        return Responses::FailedAndLogout( '<b style="color:blue">You Are Banned! So you can not access to this page <br>Please, call to Administer to solve this problem</b>');
    }
}
