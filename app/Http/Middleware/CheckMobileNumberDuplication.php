<?php
namespace App\Http\Middleware;

use App\Models\patients_general_info;
use App\Responses\Responses;
use Closure;
use Illuminate\Http\Request;

class CheckMobileNumberDuplication
{
    public function handle(Request $request, Closure $next)
    {
        /** Check for mobile number duplication
        WE SHOULD NOT HAVE 2 PATIENTS WITH SAME MOBILE NUMBERS IN OUR DATABASE!
        It means, the mobile numbers should be unique.
        If the Mobile Number was not unique then redirect him to route('back_to_previous_page') **/
        if ( patients_general_info::numberOfDuplicateMobileNumber($this->preparePatientId($request) , $request->patient_mobile_number ) !== 0 )
        {
            return Responses::success( 'back_to_previous_page' , $request->encrypted_patient_id , 'The Mobile Number Should Be Unique <br>But, There Is Another Mobile Number Equal To <span style="color:blue;font-weight:bolder;" >' . $request->patient_mobile_number . '</span> in The Database, <br><span style="color:blue;font-weight:bolder;" > So Your New Patient Was NOT Submitted!</span><br>Please, Enter a Unique Mobile Number and Try This Process Again' ) ;
        }
        return $next($request);
    }

    public function preparePatientId($request)
    {
        $trick_update_this_patient_id = null ;
        if( $request->route()->getName() === 'patients.update')
        {
            $trick_update_this_patient_id = encryptDecrypt('decrypt', $request->encrypted_patient_id ) ;
        }
        elseif( $request->route()->getName() === 'patients.store')
        {
            $trick_update_this_patient_id = null ;
        }
        return $trick_update_this_patient_id ;
    }
}
