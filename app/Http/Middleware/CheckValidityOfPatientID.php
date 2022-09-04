<?php
namespace App\Http\Middleware;

use App\Models\patients_general_info;
use App\Responses\Responses;
use Closure;
use Illuminate\Http\Request;

class CheckValidityOfPatientID
{
    public function handle(Request $request, Closure $next)
    {
        $trick_of_patient_id = $this->GetPatientIDinDifferentSituations($request) ;

        $decrypted_request_patient_id = encrypt_decrypt('decrypt' , $trick_of_patient_id ) ;

        $HowManyResultExist = patients_general_info::CheckValidityOfPatientID( $decrypted_request_patient_id ) ;
        if( $HowManyResultExist !== 1 )
        {
            return Responses::Failed( 'home' , '' , '<span style="color:blue;">The Requested Patient Does Not Exist!</span>' ) ;
        }

        return $next($request);
    }

    public function GetPatientIDinDifferentSituations($request)
    {
        $trick_of_patient_id = '' ;
        if(isset($request->patient_id))
        {
            $trick_of_patient_id = $request->patient_id ;
        }
        elseif(isset($request->edit_this_patient_id))
        {
            $trick_of_patient_id = $request->edit_this_patient_id ;
        }
        elseif(isset($request->update_this_patient_id))
        {
            $trick_of_patient_id = $request->update_this_patient_id ;
        }
        elseif(isset($request->delete_this_patient_id))
        {
            $trick_of_patient_id = $request->delete_this_patient_id ;
        }
        elseif(isset($request->choose_time_for_this_patient_id))
        {
            $trick_of_patient_id = $request->choose_time_for_this_patient_id ;
        }

        return $trick_of_patient_id ;
    }
}
