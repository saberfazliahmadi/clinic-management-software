<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;

class ProvideHeaderData
{
    public function handle(Request $request, Closure $next)
    {
        // If user click on button of send patient to doctor room from header
        if($request->send_patient_to_doctors_room === 'true')
        {
            app()->call('App\Http\Controllers\HeaderController@IfUserClickOnButtonSendPatientToDoctorRoom' , [ 'request' => $request] ) ;
        }

        app()->call('App\Http\Controllers\HeaderController@ProvideHeaderDataAndShareItOnView' ) ;

        return $next($request);
    }
}
