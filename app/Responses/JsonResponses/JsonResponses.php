<?php
namespace App\Responses\JsonResponses;
use App\LogTypes\LogTypes;
use Illuminate\Support\Facades\Auth;

class JsonResponses
{
    public static function view($view , $data)
    {
        return response()->json([
                                    'view' => $view,
                                    'data' => $data,
                                ]);
    }

    public static function redirect_to_previous_page($Message)
    {
        return redirect()->back()->with( [ 'success_message' => $Message ] ) ;
    }

    public static function Success( $RouteName , $RouteParameters , $Message )
    {
        LogTypes::RunNormalLog('Success Action: '.$Message) ;

        if( $RouteName === 'back_to_previous_page' )
        {
            return self::redirect_to_previous_page($Message) ;
        }

        return response()->json([
                                    'Message' => $Message,
                                ]);
    }

    public static function Failed( $RouteName , $RouteParameters , $Message )
    {
        LogTypes::RunNormalLog('Failed Action: '.$Message) ;

        if( $RouteName === 'back_to_previous_page' )
        {
            return self::redirect_to_previous_page($Message) ;
        }

        return response()->json([
                                    'Message' => $Message,
                                ]);
    }

    // The $Exception Parameter will use for DB::Transaction on middleware => TransactionOnDatabaseToRollbackWhenExceptionsHappen
    public static function FailedWithException( $RouteName , $RouteParameters , $Message, $Exception )
    {
        $Exception_trick = '' ;
        if( strlen($Exception) > 0)
        {
            $Exception_trick = $Exception ;
        }
        LogTypes::RunNormalLog('Exception: '.$Exception_trick) ;

        if( $RouteName === 'back_to_previous_page' )
        {
            return self::redirect_to_previous_page($Message) ;
        }

        return response()->json([
                                    'Message' => $Message,
                                    'Exception' => $Exception ,
                                ]);
    }

    public static function FailedAndLogout( $Message )
    {
        LogTypes::RunNormalLog('Failed Action: '.$Message) ;
        Auth::logout();

        return response()->json([
                                    'Message' => $Message,
                                ]);
    }
}