<?php
namespace App\Http\Middleware;
use App\Http\Controllers\UserController;
use App\Responses\Responses;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckPageAccessibilityForUserLevel
{
    public function handle(Request $request, Closure $next)
    {
        if ( Auth::check() === TRUE && isset(Auth::user()->user_level) && ( e(Auth::user()->user_level) >= config('global.user_level') ) )
        {
            return $next($request);
        }

        // Make BAN this user id due to try to access a page which is NOT authorize to ACCESS it
        $make_ban_or_active_this_user_id = UserController::make_ban_or_active_this_user_id(Auth::user()->name , Auth::user()->id , config('global.ban')) ;
        // If we make ban this user then let him know by show an error message on login page to him
        $response_of_ban_trick = 'Also, the system made your account ban!<br>Call to Administer to support your account' ;
        if(!$make_ban_or_active_this_user_id)
        {
            $response_of_ban_trick = '' ;
        }
        return Responses::FailedAndLogout( '<b style="color:blue">You are not eligible to access this page!<br>'.$response_of_ban_trick.'</b>' ) ;
    }
}
