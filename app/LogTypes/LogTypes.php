<?php
namespace App\LogTypes;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
class LogTypes
{
    public static function prepareUserIdTrick()
    {
        return Auth::id() ?? 'Unknown user ID';
    }

    public static function prepareUserNameTrick()
    {
        return Auth::user()->name ?? 'Unknown user Name';
    }

    public static function runNormalLog($message)
    {
        $user_id_trick   = self::prepareUserIdTrick() ;
        $user_name_trick = self::prepareUserNameTrick() ;
        Log::alert($message ,
       [
           'User Id'            => $user_id_trick ,
           'User Name'          => $user_name_trick ,
           'Route Name'         => request()->route()->getName() ,
           'Route Parameters'   => request()->route()->parameters ,
           'Get Action Method'  => request()->route()->getActionMethod() ,
           'Get Controller'     => request()->route()->getController() ,
           'Get Action Name'    => request()->route()->getActionName()
       ] ) ;
    }
}