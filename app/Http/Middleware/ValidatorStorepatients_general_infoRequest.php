<?php
namespace App\Http\Middleware;
use App\Models\patients_general_info;
use App\Responses\Responses;
use Closure;
use Illuminate\Http\Request;

class ValidatorStorepatients_general_infoRequest
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

        /** Check for mobile number duplication
        WE SHOULD NOT HAVE TWO PATIENTS WITH SAME MOBILE NUMBERS IN OUR DATABASE!
        The mobile numbers should be unique
        If the mobile number of patient was NOT unique then show an Error message to him and redirect **/
        if ( patients_general_info::number_of_duplicate_mobile_number(null , $request->post('patient_mobile_number')) !== 0 )
        {
            return Responses::Failed( 'submit_new_patient_form', '' ,'<b style="color:blue;" >The Mobile Number Should be Unique <br>But, There is another Mobile Number Like '.$request->get('patient_mobile_number').' in Database,</b> <br> So Your New Patient Was NOT Submitted! <br> Try a Unique Mobile Number Again' ) ;
        }

        return $next($request);
    }
}