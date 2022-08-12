<?php
namespace AppEHR\Http\Middleware;

use AppEHR\Models\Patients_EHR_document;
use App\Responses\Responses;
use Closure;
use Illuminate\Http\Request;

class CheckValidityOfEHRID
{
    public function handle(Request $request, Closure $next)
    {
        $decrypted_requested_EHR_id = encrypt_decrypt('decrypt' , $request->EHR_document_id ) ;

        $result_of_CheckValidityOfEHRID = Patients_EHR_document::CheckValidityOfEHRID( $decrypted_requested_EHR_id ) ;
        if(!$result_of_CheckValidityOfEHRID)
        {
            return Responses::Failed( 'home' , '' , '<span style="color:blue;">The Requested EHR Document Does Not Exist!</span>' ) ;
        }
        return $next($request);
    }
}
