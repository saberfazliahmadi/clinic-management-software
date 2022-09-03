<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;

/** This Middleware act as a widget for header section in our application,
 * and we can use this middleware on any route that we need to provide header information (by $middlewareGroups in Kernel.php)
 * In addition, by using this Middleware and transfer all logics code to HeaderController we Apply Single Responsibility
 * More over, when we use several Middlewares to provide data for our header Widget we apply Open/Close Principles
 * It means, In the Future, we can add more Separate Middlewares on Different Routes to Share more Information on Header
 */
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
