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
        $trick_of_encrypted_patient_id = $request->encrypted_patient_id ?? '';
        if( ($trick_of_encrypted_patient_id !== '') && (patients_general_info::checkValidityOfPatientID(encryptDecrypt('decrypt' , $trick_of_encrypted_patient_id )) !== 1) )
        {
            return Responses::failed( 'home' , '' , '<span style="color:blue;">The Requested Patient Does Not Exist!</span>' ) ;
        }
        return $next($request);
    }
}
