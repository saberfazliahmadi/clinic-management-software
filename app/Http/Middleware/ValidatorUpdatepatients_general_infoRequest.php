<?php
namespace App\Http\Middleware;
use App\Models\patients_general_info;
use App\Responses\Responses;
use Closure;
use Illuminate\Http\Request;

class ValidatorUpdatepatients_general_infoRequest
{
    public function handle(Request $request, Closure $next)
    {
        $rules = [
            'patient_first_name'    => 'required|min:3' ,
            'patient_last_name'     => 'required|min:3' ,
            'patient_mobile_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:8' ,
            'patient_last_appointment_date' => 'date_format:Y-m-d' ,
        ];
        $request->validate($rules);

        $decrypted_update_this_patient_id = encrypt_decrypt('decrypt', $request->update_this_patient_id );
        $encrypted_update_this_patient_id = $request->update_this_patient_id ;
        /** Check for mobile number duplication
        WE SHOULD NOT HAVE TWO PATIENTS WITH SAME MOBILE NUMBERS IN OUR DATABASE!
        The mobile numbers should be unique
        If the Mobile Number was not unique then redirect him **/
        if ( patients_general_info::number_of_duplicate_mobile_number($decrypted_update_this_patient_id , $request->post('patient_mobile_number') ) !== 0 )
        {
            return Responses::Success( 'edit_patient_form' , $encrypted_update_this_patient_id , 'The Mobile Number Should be Unique <br>But, There is another Mobile Number Like ' . $request->get('patient_mobile_number') . ' in Database, <br><span style="color:blue;font-weight:bolder;" > So Your New Patient Was NOT Submitted! </span><br> Try a Unique Mobile Number' ) ;
        }

        return $next($request);
    }
}
