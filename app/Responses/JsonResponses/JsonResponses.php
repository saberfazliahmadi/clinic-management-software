<?php
namespace App\Responses\JsonResponses;
use App\LogTypes\LogTypes;
use Illuminate\Support\Facades\Auth;

class JsonResponses
{
    public static function view($view , $data)
    {
        LogTypes::runNormalLog('Success Action: '.Auth::user()->name.' redirected to this view file name =>'.$view.' with this data =>'.implode(" ",$data)) ;
        return response()->json([
                                    'view' => $view,
                                    'data' => $data,
                                ]);
    }

    public static function redirectToPreviousPage($Message)
    {
        return redirect()->back()->with( [ 'success_message' => $Message ] ) ;
    }

    public static function success( $RouteName , $RouteParameters , $Message )
    {
        LogTypes::runNormalLog('Success Action: '.$Message) ;

        if($RouteName === 'back_to_previous_page')
        {
            return self::redirectToPreviousPage($Message) ;
        }

        return response()->json([
                                    'Message' => $Message,
                                ]);
    }

    public static function failed( $RouteName , $RouteParameters , $Message )
    {
        LogTypes::runNormalLog('Failed Action: '.$Message) ;

        if($RouteName === 'back_to_previous_page')
        {
            return self::redirectToPreviousPage($Message) ;
        }

        return response()->json([
                                    'Message' => $Message,
                                ]);
    }

    // The $Exception Parameter will use for DB::Transaction on middleware => TransactionOnDatabaseToRollbackWhenExceptionsHappen
    public static function failedWithException( $RouteName , $RouteParameters , $Message, $Exception )
    {
        $Exception_trick = '' ;
        if(strlen($Exception) > 0)
        {
            $Exception_trick = $Exception ;
        }
        LogTypes::runNormalLog('Exception: '.$Exception_trick) ;

        if($RouteName === 'back_to_previous_page')
        {
            return self::redirectToPreviousPage($Message) ;
        }

        return response()->json([
                                    'Message' => $Message,
                                    'Exception' => $Exception ,
                                ]);
    }

    public static function FailedAndLogout($Message)
    {
        LogTypes::runNormalLog('Failed Action: '.$Message) ;
        Auth::logout();

        return response()->json([
                                    'Message' => $Message,
                                ]);
    }
}