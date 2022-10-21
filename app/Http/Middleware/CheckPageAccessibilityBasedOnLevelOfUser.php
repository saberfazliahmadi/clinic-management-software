<?php
namespace App\Http\Middleware;

use App\Http\Controllers\UserController;
use App\Responses\Responses;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckPageAccessibilityBasedOnLevelOfUser
{
    public function handle(Request $request, Closure $next , string $LevelOfUser = 'Guest' )
    {
        if ( isset(Auth::user()->user_level) && Auth::user()->user_level >= $this->prepareLevelOfUser($LevelOfUser) )
        {
            return $next($request);
        }

        // Make BAN this user id due to try to access a page which is NOT authorize to ACCESS it
        $response_of_ban_trick = '' ;
        if(app(UserController::class)->makeBanOrActiveThisUserId(Auth::user()->name , Auth::id() , config('global.ban')))
        {
            $response_of_ban_trick = 'Also, the system made your account ban!<br>Call to Administer to support your account' ;
        }
        return Responses::FailedAndLogout( '<b style="color:blue">You are not eligible to access this page!<br>'.$response_of_ban_trick.'</b>' ) ;
    }

    public function prepareLevelOfUser(string $LevelOfUser)
    {
        if($LevelOfUser === 'User')
        {
            $LevelOfUser = config('global.user_level') ;
        }
        elseif($LevelOfUser === 'Admin')
        {
            $LevelOfUser = config('global.admin_level') ;
        }
        elseif($LevelOfUser === 'SuperAdmin')
        {
            $LevelOfUser = config('global.super_admin_level') ;
        }
        else
        {
            $LevelOfUser = config('global.guest_level') ;
        }
        return $LevelOfUser ;
    }
}
