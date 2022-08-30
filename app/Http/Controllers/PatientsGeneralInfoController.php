<?php
namespace App\Http\Controllers;

use App\Http\Requests\run_patient_search_formRequest;
use App\Responses\Responses;
use Illuminate\Http\Request;
use App\Models\{patients_general_info , patients_appointment } ;
use Illuminate\Database\QueryException;

/** In this controller according to Single Responsibility and Open-Closed Principles of SOLID
we validate user inputs by Middleware **/
class PatientsGeneralInfoController extends Controller
{
    public function create()
    {
        try
        {
            $number_of_total_clinic_patients = patients_general_info::number_of_total_clinic_patients() ;
            return Responses::view('back.submit_new_patient_form' ,
            [
                'title_of_page'                   => 'Submit a New Patient' ,
                'number_of_total_clinic_patients' => $number_of_total_clinic_patients
            ] );
        }
        catch (QueryException $exception)
        {
            return Responses::FailedWithException( 'home' , '' , 'We have an error to show make a new patient form' , $exception ) ;
        }
    }

    public function store(Request $request)
    {
        // Check for mobile number duplication
        // WE SHOULD NOT HAVE TWO PATIENTS WITH SAME MOBILE NUMBERS IN OUR DATABASE!
        // The mobile numbers should be unique
        $number_of_duplicate_mobile_number = patients_general_info::number_of_duplicate_mobile_number(null , $request->post('patient_mobile_number')) ;

        // If the mobile number of patient was NOT unique then redirect
        if ( $number_of_duplicate_mobile_number !== 0 )
        {
            return Responses::Failed( 'submit_new_patient_form', '' ,'<b style="color:blue;" >The Mobile Number Should be Unique <br>But, There is another Mobile Number Like '.$request->get('patient_mobile_number').' in Database,</b> <br> So Your New Patient Was NOT Submitted! <br> Try a Unique Mobile Number Again' ) ;
        }
        // If the mobile number of patient was unique then store its information
        try
        {
            $result_store_new_patient_form = patients_general_info::store_new_patient_form($request->all()) ;

            // Specify last id created in database and encrypt it to use it in route passing data
            $encrypted_choose_time_for_this_patient_id = encrypt_decrypt('encrypt', $result_store_new_patient_form->patient_id ) ;

            $response_message = 'Your New Patient with Name <br><a href="'.route('edit_patient_form', $encrypted_choose_time_for_this_patient_id ).'" ><b>'.$request->get('patient_first_name').' ' . $request->get('patient_last_name').'</b></a> Successfully Submitted' ;
            // If this patient has a date appointment then redirect him to route('show_patient_time_appointment_table') to select desired time for this appointment
            if( $request->get('patient_last_appointment_date') !== '' )
            {
                return Responses::Success( 'show_patient_time_appointment_table', [ 'choose_time_for_this_date' => $request->get('patient_last_appointment_date') , 'choose_time_for_this_patient_id' => $encrypted_choose_time_for_this_patient_id ] , $response_message.'<br>Now choose an appointment time on date '.$request->get('patient_last_appointment_date') ) ;
            }
            // If this patient DOES NOT have a selected date of appointment then redirect him to route('submit_new_patient_form') with success message
            return Responses::Success( 'submit_new_patient_form', '' , $response_message ) ;
        }
        catch (QueryException $exception)
        {
            return Responses::FailedWithException( 'submit_new_patient_form' , '' , '<span style="color:blue;">Your New Patient Was NOT Successfully Submitted!</span>' , $exception ) ;
        }
    }

    public function edit( $edit_this_patient_id )
    {
        try
        {
            $decrypted_edit_this_patient_id = encrypt_decrypt('decrypt', $edit_this_patient_id ) ;
            $result_edit_patient_form       = patients_general_info::fetch_info_of_this_patient_id($decrypted_edit_this_patient_id) ;
            $result_show_all_appointments_of_this_id = patients_appointment::result_show_all_appointments_of_this_id($decrypted_edit_this_patient_id) ;
            $number_of_total_clinic_patients         = patients_general_info::number_of_total_clinic_patients() ;

            return Responses::view('back.submit_new_patient_form' ,
            [
                'title_of_page'                           => 'Edit Patient Information' ,
                'result_edit_patient_form'                => $result_edit_patient_form ,
                'result_show_all_appointments_of_this_id' => $result_show_all_appointments_of_this_id ,
                'number_of_total_clinic_patients'         => $number_of_total_clinic_patients
            ] ) ;
        }
        catch ( QueryException $exception )
        {
            return Responses::FailedWithException( 'submit_new_patient_form' , '' ,'<span style="color:blue;font-weight:bolder;">We have an error to show information of this patient</span>' , $exception ) ;
        }
    }

    public function update( Request $request )
    {
        $decrypted_update_this_patient_id = encrypt_decrypt('decrypt', $request->update_this_patient_id );
        $encrypted_update_this_patient_id = $request->update_this_patient_id ;

        // Check for mobile number duplication
        // WE SHOULD NOT HAVE TWO PATIENTS WITH SAME MOBILE NUMBERS IN OUR DATABASE!
        // The mobile numbers should be unique
        $number_of_duplicate_mobile_number = patients_general_info::number_of_duplicate_mobile_number($decrypted_update_this_patient_id , $request->post('patient_mobile_number') ) ;

        // If the Mobile Number was not unique then redirect him
        if ( $number_of_duplicate_mobile_number !== 0 )
        {
            return Responses::Success( 'edit_patient_form' , $encrypted_update_this_patient_id , 'The Mobile Number Should be Unique <br>But, There is another Mobile Number Like ' . $request->get('patient_mobile_number') . ' in Database, <br><span style="color:blue;font-weight:bolder;" > So Your New Patient Was NOT Submitted! </span><br> Try a Unique Mobile Number' ) ;
        }

        $response_message_success = '<b>'.$request->post('patient_first_name') . ' ' . $request->post('patient_last_name') . '\'s Information Successfully Updated</b>' ;
        $response_message_failed  = '<span style="color:blue;font-weight:bolder;">' . $request->post('patient_first_name') . ' ' . $request->post('patient_last_name') . ' Information WAS NOT Updated</span>' ;
        try
        {
            $request_all                   = $request->all() ;
            $result_update_this_patient_id = patients_general_info::result_update_this_patient_id($decrypted_update_this_patient_id,$request_all) ;

            if(!$result_update_this_patient_id)
            {
                return Responses::Success( 'edit_patient_form' , $encrypted_update_this_patient_id , $response_message_failed ) ;
            }
            return Responses::Success( 'edit_patient_form' , $encrypted_update_this_patient_id , $response_message_success ) ;
        }
        catch (QueryException $exception)
        {
            return Responses::Success( 'edit_patient_form' , $encrypted_update_this_patient_id , $response_message_failed ) ;
        }
    }

    public function destroy( Request $request)
    {
        $response_message_success = 'The requested patient successfully deleted' ;
        $response_message_failed  = 'We have an error to delete this patient Number<br> Maybe there is an appointment or a financial transaction related to this patient,<br> So if you want to delete this patient<br> at first, you need to delete all appointments and financial transactions related to him' ;
        try
        {
            $decrypted_request_delete_this_patient_id = encrypt_decrypt('decrypt', $request->delete_this_patient_id ) ;
            $result_delete_this_patient_id            = patients_general_info::delete_this_patient_id($decrypted_request_delete_this_patient_id) ;

            // If we did not found this patient id in database and successfully deleted it
            if(!$result_delete_this_patient_id)
            {
                return Responses::Failed( 'submit_new_patient_form' , '' , $response_message_failed ) ;
            }
            return Responses::Success( 'submit_new_patient_form' , '' , $response_message_success ) ;
        }
        catch (QueryException $exception)
        {
            return Responses::FailedWithException( 'submit_new_patient_form' , '' , $response_message_failed , $exception ) ;
        }
    }

    public function show_patient_search_from()
    {
        return Responses::view('back.show_patient_search_from' , [ 'title_of_page' => 'Search Patients' ] );
    }

    public function run_patient_search_form( run_patient_search_formRequest $request )
    {
        try
        {
            $result_of_run_search_form = patients_general_info::fetch_result_of_search_from() ;

            // If there is NOT ANY result in database
            if( $result_of_run_search_form->count() === 0 )
            {
                return Responses::Failed( 'show_patient_search_from' , '' ,'There is not any result for <b style="color:blue;" >'.request()->post('search_text').'</b>' ) ;
            }

            return Responses::view('back.show_patient_search_from',
            [
                'title_of_page'             => 'Search Patients' ,
                'result_run_search_form'    => $result_of_run_search_form ,
                'success_message_of_search' => '<b style="color:blue;" >'.$result_of_run_search_form->count().'</b> results found for <b style="color:blue;" >"'.request()->post('search_text').'"</b>'
            ] ) ;
        }
        catch (QueryException $exception)
        {
            return Responses::FailedWithException( 'show_patient_search_from' , '' ,'We have an error to search for this word <b style="color:blue;" >'.request()->post('search_text').'</b>' , $exception ) ;
        }
    }
}
