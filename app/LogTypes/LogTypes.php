<?php
namespace App\LogTypes;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
class LogTypes
{
    public static function PrepareUserIdTrick()
    {
        $user_id_trick = 'Unknown ID' ;
        if( isset(Auth::user()->id) )
        {
            $user_id_trick = Auth::user()->id  ;
        }
        return $user_id_trick ;
    }

    public static function PrepareUserNameTrick()
    {
        $user_name_trick = 'Unknown Name' ;
        if( isset(Auth::user()->name) )
        {
            $user_name_trick = Auth::user()->name  ;
        }
        return $user_name_trick ;
    }

    public static function RunNormalLog($message)
    {
        $user_id_trick   = self::PrepareUserIdTrick() ;
        $user_name_trick = self::PrepareUserNameTrick() ;
        Log::alert($message , [ 'User Id' => $user_id_trick , 'User Name' => $user_name_trick , 'Route Name' => request()->route()->getName() , 'Route Parameters' => request()->route()->parameters , 'Get Action Method' => request()->route()->getActionMethod() , 'Get Controller' => request()->route()->getController() , 'Get Action Name' => request()->route()->getActionName() ] ) ;
    }
}