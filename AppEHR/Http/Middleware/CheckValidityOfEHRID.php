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
        if(! Patients_EHR_document::CheckValidityOfEHRID( encrypt_decrypt('decrypt' , $request->EHR_document_id ) ) )
        {
            return Responses::Failed( 'home' , '' , '<span style="color:blue;">The Requested EHR Document Does Not Exist!</span>' ) ;
        }
        return $next($request);
    }
}
