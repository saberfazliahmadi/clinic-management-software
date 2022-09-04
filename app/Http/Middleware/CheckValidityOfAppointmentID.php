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
        $trick_of_appointment_id = $this->GetAppointmentIDinDifferentSituations($request) ;

        if( $trick_of_appointment_id !== '' )
        {
            $HowManyResultExist = patients_appointment::CheckValidityOfAppointmentID( $trick_of_appointment_id ) ;
            if( $HowManyResultExist !== 1 )
            {
                return Responses::Failed( 'home' , '' , '<span style="color:blue;">The Requested Appointment of Patient Does Not Exist!</span>' ) ;
            }
        }

        return $next($request);
    }

    public function  GetAppointmentIDinDifferentSituations($request)
    {
        $trick_of_appointment_id = '' ;
        if( isset($request->appointment_id) )
        {
            $trick_of_appointment_id = $request->appointment_id ;
        }
        elseif( isset($request->related_appointment_id) )
        {
            $trick_of_appointment_id = $request->related_appointment_id ;
        }

        return $trick_of_appointment_id ;
    }
}
