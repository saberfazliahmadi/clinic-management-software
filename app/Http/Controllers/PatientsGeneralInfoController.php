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
            return Responses::view('back.submit_new_patient_form' ,
            [
                'title_of_page'                   => 'Submit a New Patient' ,
                'number_of_total_clinic_patients' => patients_general_info::number_of_total_clinic_patients()
            ] );
        }
        catch (QueryException $exception)
        {
            return Responses::FailedWithException( 'home' , '' , 'We have an error to show make a new patient form' , $exception ) ;
        }
    }

    public function store(Request $request)
    {
        try
        {
            $result_store_new_patient_form = patients_general_info::store_new_patient_form($request->all()) ;

            // Specify last id created in database and encrypt it to have more security and use it in route passing data
            $encrypted_choose_time_for_this_patient_id = encrypt_decrypt('encrypt', $result_store_new_patient_form->patient_id ) ;

            $response_message = 'Your New Patient with Name <br><a href="'.route('edit_patient_form', $encrypted_choose_time_for_this_patient_id ).'" ><b>'.$request->get('patient_first_name').' ' . $request->get('patient_last_name').'</b></a> Successfully Submitted' ;
            // If this patient has a date of appointment then redirect him to route('show_patient_time_appointment_table') to select desired time for this appointment
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
            return Responses::view('back.submit_new_patient_form' ,
            [
                'title_of_page'                           => 'Edit Patient Information' ,
                'result_edit_patient_form'                => patients_general_info::fetch_info_of_this_patient_id($decrypted_edit_this_patient_id) ,
                'result_show_all_appointments_of_this_id' => patients_appointment::result_show_all_appointments_of_this_id($decrypted_edit_this_patient_id) ,
                'number_of_total_clinic_patients'         => patients_general_info::number_of_total_clinic_patients()
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

        $response_message_success = '<b>'.$request->post('patient_first_name') . ' ' . $request->post('patient_last_name') . '\'s Information Successfully Updated</b>' ;
        $response_message_failed  = '<span style="color:blue;font-weight:bolder;">' . $request->post('patient_first_name') . ' ' . $request->post('patient_last_name') . ' Information WAS NOT Updated</span>' ;
        try
        {
            $result_update_this_patient_id = patients_general_info::result_update_this_patient_id($decrypted_update_this_patient_id,$request->all()) ;
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
            $result_delete_this_patient_id = patients_general_info::delete_this_patient_id(encrypt_decrypt('decrypt', $request->delete_this_patient_id ) ) ;
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

            // If we did NOT find ANY matched record in database for requested text
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
