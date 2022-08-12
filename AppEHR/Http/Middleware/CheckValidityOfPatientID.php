<?php
namespace AppEHR\Http\Middleware;

use App\Models\patients_general_info;
use App\Responses\Responses;
use Closure;
use Illuminate\Http\Request;

class CheckValidityOfPatientID
{
    public function handle(Request $request, Closure $next)
    {
        $decrypted_request_patient_id = encrypt_decrypt('decrypt' , $request->patient_id ) ;

        $result_of_CheckValidityOfPatientID = patients_general_info::CheckValidityOfPatientID( $decrypted_request_patient_id ) ;
        if(!$result_of_CheckValidityOfPatientID)
        {
            return Responses::Failed( 'home' , '' , '<span style="color:blue;">Requested Patient Does Not Exist!</span>' ) ;
        }

        return $next($request);
    }
}
