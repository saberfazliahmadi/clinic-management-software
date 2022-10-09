<?php
namespace App\Http\Middleware;

use App\Models\patients_appointment;
use App\Responses\Responses;
use Closure;
use Illuminate\Http\Request;

class CheckValidityOfAppointmentID
{
    public function handle(Request $request, Closure $next)
    {
        $trick_of_appointment_id = $request->appointment_id ?? '';
        if( ($trick_of_appointment_id !== '') && (patients_appointment::CheckValidityOfAppointmentID($trick_of_appointment_id) !== 1) )
        {
            return Responses::failed( 'home' , '' , '<b><span style="color:blue;">The Requested Appointment of Patient Does Not Exist!</span></b>' ) ;
        }
        return $next($request);
    }
}
