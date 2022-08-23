<?php
namespace App\Http\Controllers;

use App\Http\Requests\delete_this_appointment_idRequest;
use App\Http\Requests\show_form_of_appointments_on_specific_dateRequest;
use App\Http\Requests\store_patient_time_appointment_tableRequest;
use App\Responses\Responses;
use Illuminate\Support\Facades\Auth;
use App\Models\{ patients_appointment , patients_general_info };
use Illuminate\Database\QueryException;

/** In this controller according to Single Responsibility and Open-Closed Principles of SOLID
we validate user inputs by Middleware **/
class PatientsAppointmentController extends Controller
{
    // Define and Specify a variable of date's appointments by GET or POST method
    public function prepare_date_of_appointment($request_post_show_all_appointments_on_this_date , $request_get_show_all_appointments_this_date )
    {
        $show_all_appointments_on_this_date = '' ;
        if( $request_post_show_all_appointments_on_this_date !== "" )
        {
            $show_all_appointments_on_this_date = $request_post_show_all_appointments_on_this_date ;
        }
        elseif( $request_get_show_all_appointments_this_date !== "" )
        {
            $show_all_appointments_on_this_date = $request_get_show_all_appointments_this_date ;
        }
        return $show_all_appointments_on_this_date ;
    }

    public function show(patients_appointment $patients_appointment , show_form_of_appointments_on_specific_dateRequest $request )
    {
        // Define and Specify a variable of date's appointments by GET or POST method
        $show_all_appointments_on_this_date = $this->prepare_date_of_appointment($request->post('show_all_appointments_on_this_date') , $request->show_all_appointments_this_date ) ;

        try
        {
            // Create mysql query to extract all appointments that record in database on this specific date (JOIN TYPE)
            $result_show_form_of_appointments_on_specific_date = patients_appointment::result_show_form_of_appointments_on_specific_date($show_all_appointments_on_this_date) ;

            // How many appointment found on requested date
            $count_of_appointment = $result_show_form_of_appointments_on_specific_date->count() ;

            // If there is not any appointment on the database
            if( $count_of_appointment === 0 )
            {
                return Responses::Success( 'show_form_of_appointments_on_specific_date' , '' , '<b style="color:blue" >There is no appointment on date '.$show_all_appointments_on_this_date.'</b><br> Please, choose another date to show appointments' ) ;
            }

            $financial_management_data = '' ;
            if( Auth::user()->financial_management !== '' )
            {
                $financial_management_data = Auth::user()->financial_management ;
            }

            return view('back.show_form_of_appointments_on_specific_date' ,
            [
                'title_of_page'                                     => 'List of All Appointments on Date '.$show_all_appointments_on_this_date ,
                'result_show_form_of_appointments_on_specific_date' => $result_show_form_of_appointments_on_specific_date ,
                'count_of_appointment'                              => $count_of_appointment ,
                'show_all_appointments_on_this_date'                => $show_all_appointments_on_this_date ,
                'financial_management_data'                         => $financial_management_data
            ] ) ;
        }
        catch ( QueryException $exception )
        {
            return Responses::FailedWithException( 'show_form_of_appointments_on_specific_date' , '' , '<b style="color:blue;" >We have an Error to show appointments on Date '.$show_all_appointments_on_this_date.'</b>' , $exception ) ;
        }
    }

    public function destroy(patients_appointment $patients_appointment , delete_this_appointment_idRequest $request )
    {
        $response_message = '<span style="color:blue;">The Selected Appointment WAS NOT Deleted!</span><br>You may have a related financial transaction to this appointment<br>So, first of all you should delete related financial transaction' ;
        try
        {
            $result_of_delete_this_appointment_id = patients_appointment::delete_this_appointment_id($request->appointment_id) ;

            if($result_of_delete_this_appointment_id)
            {
                $response_message = '<span>The Selected Appointment Successfully Deleted</span>' ;
            }
            return Responses::Success( 'back_to_previous_page' , '' , $response_message ) ;
        }
        catch (QueryException $exception)
        {
            return Responses::FailedWithException( 'back_to_previous_page' , '' , $response_message , $exception ) ;
        }
    }

    public function prepare_content_of_patient_time_appointment_table($choose_time_for_this_date)
    {
        // All of HTML codes will be added to this variable and at the end of this function, this variable will be passed to view page.
        $text_trick = '';

        $start_of_day = strtotime('00:00');
        $end_end_day  = strtotime('24:00');

        // In here, the Algorithm is Chunk 1 day to small pieces of minutes
        // START of time appointment counter creator.
        for ( $index_counter = $start_of_day ; $index_counter <= $end_end_day ; $index_counter = $index_counter + Auth::user()->gap_time_between_appointments * 60 )
        {
            // The date function will change N minutes to HH:MM format
            // Make an appointment time trick
            $appointment_time_trick = date('H:i', $index_counter);

            // Create mysql query to extract all appointments data on this specific time and date by (JOIN TYPE)
            $result_appointments_of_patients_on_this_time_and_date = patients_appointment::result_appointments_of_patients_on_this_time_and_date($choose_time_for_this_date, $appointment_time_trick) ;

            // How many appointment time equal with $appointment_time_trick exist in database
            $num_of_res_time_trick = $result_appointments_of_patients_on_this_time_and_date->count();

            $trick_of_title = '' ;
            foreach ( $result_appointments_of_patients_on_this_time_and_date as $key_3 )
            {
                $trick_of_title .= '( '.$key_3->patient_first_name.' '.$key_3->patient_last_name.' -> '.$key_3->patient_mobile_number.' ) ' ;
            }

            //  Show Busy time by (ORANGE COLOR)
            if ($num_of_res_time_trick > '0' && $num_of_res_time_trick <= '3')
            {
                $appointment_div_trick        = 'alert alert-warning well';
                $appointment_text_color_trick = 'color:white;background-color: rgba(243,156,18,0.88);';
            }
            // Show Dangerous time by (RED COLOR)
            elseif ($num_of_res_time_trick > '3')
            {
                $appointment_div_trick        = 'alert alert-danger well';
                $appointment_text_color_trick = 'color:white;background-color: rgba(231,76,60,0.88);';
            }
            // Show Free time by (WHITE COLOR)
            else
            {
                $appointment_div_trick        = 'well';
                $appointment_text_color_trick = 'color:gray;';
            }

            $text_trick .= '
            <label title="' . $trick_of_title . '" class="well col-md-2 col-sm-2 col-xs-2 form-group btn-default ' . $appointment_div_trick . '" style="text-align:center;font-weight:normal;cursor: pointer;font-size:14px;' . $appointment_text_color_trick . '" >';

                // If number of appointments on this specific time is more than 0 , Show that number
                if ($num_of_res_time_trick !== '0')
                {
                    $text_trick .= '
                    <span>
                        ' . $num_of_res_time_trick . '
                    </span>';
                }
                else
                {
                    $text_trick .= '
                    <span>
                        &nbsp;
                    </span>';
                }

                $text_trick .= '
                <div title="' . $trick_of_title . '" ><input type="radio" name="appointment_time" class="flat" value="' . $appointment_time_trick . '" > ' . $appointment_time_trick . '</div>
            </label>';

        } // END of time appointment counter creator.

        return $text_trick ;
    }

    public function show_patient_time_appointment_table( $choose_time_for_this_date , $choose_time_for_this_patient_id )
    {
        try
        {
            $text_trick = $this->prepare_content_of_patient_time_appointment_table($choose_time_for_this_date) ;

            return view('back.show_patient_time_appointment_table',
            [
                'title_of_page'                   => 'List of Appointments Time on Date: ' . $choose_time_for_this_date,
                'choose_time_for_this_date'       => $choose_time_for_this_date,
                'choose_time_for_this_patient_id' => $choose_time_for_this_patient_id ,
                'text_trick'                      => $text_trick
            ]);
        }
        catch (QueryException $exception)
        {
            return Responses::FailedWithException( 'home' , '' , '<span style="color:blue;">We Have an Error to Show List of Appointments Time on This Specific Date</span>' , $exception ) ;
        }
    }

    public function store_patient_time_appointment_table( store_patient_time_appointment_tableRequest $request )
    {
        $encrypted_choose_time_for_this_patient_id = request()->post('choose_time_for_this_patient_id') ;
        $decrypted_choose_time_for_this_patient_id = encrypt_decrypt('decrypt', request()->post('choose_time_for_this_patient_id') ) ;

        // This value SHOULD NOT BE NULL because we use this value is financial transaction searching pag
        $appointment_child_dr_related_name = '' ;
        if( request()->post('appointment_child_dr_related_name') !== null )
        {
            $appointment_child_dr_related_name = request()->post('appointment_child_dr_related_name') ;
        }

        // This value SHOULD NOT BE NULL because we use this value is financial transaction searching pag
        $appointment_service_type = '' ;
        if( request()->post('appointment_service_type') !== null )
        {
            $appointment_service_type = request()->post('appointment_service_type') ;
        }

        $response_message = '<span style="color:blue;">The Time and Date Appointment Were NOT Successfully Submitted!</span>' ;
        try
        {
            $result_store_new_patient_appointment_time              = patients_appointment::store_new_patient_appointment_time($decrypted_choose_time_for_this_patient_id,request()->post('choose_time_for_this_date'),request()->post('appointment_time'),$appointment_child_dr_related_name,$appointment_service_type) ;
            $update_patient_general_info_last_appointment_data_time = patients_general_info::update_patient_general_info_last_appointment_data_time($decrypted_choose_time_for_this_patient_id,request()->post('choose_time_for_this_date'),request()->post('appointment_time')) ;

            // If the appointment successfully submitted make success response message
            if( $result_store_new_patient_appointment_time->exists && $update_patient_general_info_last_appointment_data_time )
            {
                $response_message = 'The Appointment Time= '.request()->post('appointment_time').' On Date= '.request()->post('choose_time_for_this_date').' <br> of <a href="'.route('edit_patient_form', $encrypted_choose_time_for_this_patient_id ).'" ><b>Patient</b></a> Were Successfully Submitted' ;
            }
            return Responses::Success( 'submit_new_patient_form' , '' , $response_message ) ;
        }
        catch (QueryException $exception)
        {
            return Responses::FailedWithException( 'submit_new_patient_form' , '' , $response_message , $exception ) ;
        }
    }

    public function show_form_of_appointments_on_specific_date()
    {
        return view('back.show_form_of_appointments_on_specific_date' , [ 'title_of_page' => 'List of Appointments on a Specific Date' ]) ;
    }
}
