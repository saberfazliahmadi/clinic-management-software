<?php
namespace App\Http\Controllers;

use App\Http\Requests\PatientsShowRequest;
use App\Http\Requests\PatientsStoreRequest;
use App\Http\Requests\PatientsUpdateRequest;
use App\Responses\Responses;
use Illuminate\Http\Request;
use App\Models\{patients_general_info , patients_appointment } ;

class PatientsGeneralInfoController extends Controller
{
    public function index()
    {
        return Responses::view('back.patients_index' , [ 'title_of_page' => 'Search Patients' ] );
    }

    public function create()
    {
        try
        {
            $number_of_total_clinic_patients = patients_general_info::numberOfTotalClinicPatients() ;
            if( !$number_of_total_clinic_patients )
            {
                return Responses::failed( 'home' , '' , 'We have an error to show number of total patients in your clinic' ) ;
            }

            return Responses::view('back.patients_create' ,
            [
                'title_of_page'                   => 'Submit a New Patient' ,
                'number_of_total_clinic_patients' => $number_of_total_clinic_patients
            ] );
        }
        catch (\Exception $exception)
        {
            return Responses::failedWithException( 'home' , '' , 'We have an error to show make a new patient form' , $exception ) ;
        }
    }

    public function store(PatientsStoreRequest $request)
    {
        try
        {
            $request_validated             = $request->validated() ;
            $result_store_new_patient_form = patients_general_info::storeNewPatientForm($request_validated) ;
            if( !$result_store_new_patient_form->exists )
            {
                return Responses::failed( 'home' , '' , 'We have an error to store information of new patient in database' ) ;
            }

            // Specify last id created in database and encrypt it to have more security and use it on route passing data
            $choose_appointment_time_for_this_encrypted_patient_id = encryptDecrypt('encrypt', $result_store_new_patient_form->patient_id ) ;

            $response_message = 'Your New Patient with Name <br><a href="'.route('patients.edit', $choose_appointment_time_for_this_encrypted_patient_id ).'" ><b>'.$request_validated['patient_first_name'].' '.$request_validated['patient_last_name'].'</b></a> Successfully Submitted' ;
            // If this patient chose a date of appointment, then redirect him to route('appointments.create') to select desired time for this appointment
            if( $request_validated['patient_last_appointment_date'] !== '' )
            {
                return Responses::success( 'appointments.create', [ 'encrypted_patient_id' => $choose_appointment_time_for_this_encrypted_patient_id , 'date' => $request_validated['patient_last_appointment_date'] ] , $response_message.'<br>Now choose an appointment time on date '.$request_validated['patient_last_appointment_date'] ) ;
            }
            // If this patient DOES NOT have a selected date of appointment then redirect him to route('patients.create') with success message
            return Responses::success( 'patients.create', '' , $response_message ) ;
        }
        catch (\Exception $exception)
        {
            return Responses::failedWithException( 'patients.create' , '' , '<span style="color:blue;">Your New Patient Was NOT Successfully Submitted!</span>' , $exception ) ;
        }
    }

    public function show(PatientsShowRequest $request)
    {
        $request_validated = $request->validated() ;
        try
        {
            $result_of_run_search_form = patients_general_info::fetchResultOfSearchForm($request_validated['search_text']) ;
            if(!$result_of_run_search_form)
            {
                return Responses::failed('patients.index', '', 'We have an Error to search for the word you entered!');
            }

            if($result_of_run_search_form->isEmpty())
            {
                return Responses::failed('patients.index', '', 'There is not any result for <b style="color:blue;" >"'.$request_validated['search_text'].'"</b>');
            }

            return Responses::view('back.patients_index',
            [
                'title_of_page'              => 'Search Patients',
                'result_run_search_form'     => $result_of_run_search_form,
                'success_message_of_search'  => '<b style="color:blue;" >'.$result_of_run_search_form->count().'</b> results found for <b style="color:blue;" >"'.$request_validated['search_text'].'"</b>'
            ]);
        }
        catch (\Exception $exception)
        {
            return Responses::failedWithException( 'patients.index' , '' ,'We have an error to search for this word <b style="color:blue;" >"'.$request_validated['search_text'].'"</b>' , $exception ) ;
        }
    }

    public function edit($encrypted_patient_id)
    {
        try
        {
            $decrypted_patient_id = encryptDecrypt('decrypt', $encrypted_patient_id ) ;
            return Responses::view('back.patients_create' ,
            [
                'title_of_page'                           => 'Edit Patient Information' ,
                'result_edit_patient_form'                => patients_general_info::fetchInfoOfThisPatientId($decrypted_patient_id) ,
                'result_show_all_appointments_of_this_id' => patients_appointment::resultShowAllAppointmentsOfThisId($decrypted_patient_id) ,
                'number_of_total_clinic_patients'         => patients_general_info::numberOfTotalClinicPatients()
            ] ) ;
        }
        catch (\Exception $exception )
        {
            return Responses::failedWithException( 'patients.create' , '' ,'<span style="color:blue;font-weight:bolder;">We have an error to show information of this patient</span>' , $exception ) ;
        }
    }

    public function update(PatientsUpdateRequest $request)
    {
        $validated                        = $request->validated();
        $decrypted_update_this_patient_id = encryptDecrypt('decrypt', $request->encrypted_patient_id );
        $response_message_success         = '<b>'.$validated['patient_first_name'].' '.$validated['patient_last_name'].'\'s Information Successfully Updated</b>' ;
        $response_message_failed          = '<span style="color:blue;font-weight:bolder;">' . $validated['patient_first_name'].' '.$validated['patient_last_name'].'\'s Information WAS NOT Updated</span>' ;
        try
        {
            if( !(patients_general_info::resultUpdateThisPatientId($decrypted_update_this_patient_id, $request->validated())) )
            {
                return Responses::success( 'patients.edit' , $request->encrypted_patient_id , $response_message_failed ) ;
            }
            return Responses::success( 'patients.edit' , $request->encrypted_patient_id , $response_message_success ) ;
        }
        catch (\Exception $exception)
        {
            return Responses::success( 'patients.edit' , $request->encrypted_patient_id , $response_message_failed ) ;
        }
    }

    public function destroy(Request $request)
    {
        $response_message_success = 'The requested patient successfully deleted' ;
        $response_message_failed  = 'We have an error to delete this patient Number<br> Maybe there is an appointment or a financial transaction related to this patient,<br> So if you want to delete this patient<br> at first, you need to delete all appointments and financial transactions related to him' ;
        try
        {
            if( !(patients_general_info::deleteThisPatientId( encryptDecrypt('decrypt', $request->encrypted_patient_id ) )) )
            {
                return Responses::failed( 'patients.create' , '' , $response_message_failed ) ;
            }
            return Responses::success( 'patients.create' , '' , $response_message_success ) ;
        }
        catch (\Exception $exception)
        {
            return Responses::failedWithException( 'patients.create' , '' , $response_message_failed , $exception ) ;
        }
    }
}