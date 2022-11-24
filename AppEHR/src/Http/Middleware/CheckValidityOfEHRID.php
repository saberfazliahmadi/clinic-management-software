<?php
namespace AppEHR\Http\Middleware;

use AppEHR\Models\PatientsEHRDocument;
use App\Responses\Responses;
use Closure;
use Illuminate\Http\Request;

class CheckValidityOfEHRID
{
    public function handle(Request $request, Closure $next)
    {
        $trick_of_ehr_id = $request->encrypted_ehr_id ?? '';
        if( ($trick_of_ehr_id !== '') && !(PatientsEHRDocument::checkValidityOfEHRID(encryptDecrypt('decrypt' , $trick_of_ehr_id ))) )
        {
            return Responses::failed( 'home' , '' , '<span style="color:blue;">The Requested EHR Document Does Not Exist!</span>' ) ;
        }
        return $next($request);
    }
}
