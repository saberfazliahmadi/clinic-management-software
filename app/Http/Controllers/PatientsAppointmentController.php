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
    public function PrepareDateOfAppointment($request_post_show_all_appointments_on_this_date , $request_get_show_all_appointments_this_date )
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

    public function PrepareFinancialManagementData()
    {
        $financial_management_data = '' ;
        if( Auth::user()->financial_management !== '' )
        {
            $financial_management_data = Auth::user()->financial_management ;
        }
        return $financial_management_data ;
    }

    public function show( show_form_of_appointments_on_specific_dateRequest $request )
    {
        $show_all_appointments_on_this_date = $this->PrepareDateOfAppointment($request->post('show_all_appointments_on_this_date') , $request->show_all_appointments_this_date ) ;
        try
        {
            $appointments_on_specific_date = patients_appointment::appointments_on_specific_date($show_all_appointments_on_this_date) ;
            $count_of_appointment          = $appointments_on_specific_date->count() ;

            if( $count_of_appointment === 0 )
            {
                return Responses::Success( 'show_form_of_appointments_on_specific_date' , '' , '<b style="color:blue" >There is no appointment on date '.$show_all_appointments_on_this_date.'</b><br> Please, choose another date to show appointments' ) ;
            }

            return view('back.show_form_of_appointments_on_specific_date' ,
            [
                'title_of_page'                                     => 'List of All Appointments on Date '.$show_all_appointments_on_this_date ,
                'result_show_form_of_appointments_on_specific_date' => $appointments_on_specific_date ,
                'count_of_appointment'                              => $count_of_appointment ,
                'show_all_appointments_on_this_date'                => $show_all_appointments_on_this_date ,
                'financial_management_data'                         => $this->PrepareFinancialManagementData()
            ] ) ;
        }
        catch ( QueryException $exception )
        {
            return Responses::FailedWithException( 'show_form_of_appointments_on_specific_date' , '' , '<b style="color:blue;" >We have an Error to show appointments on Date '.$show_all_appointments_on_this_date.'</b>' , $exception ) ;
        }
    }

    public function destroy( delete_this_appointment_idRequest $request )
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

    public function PrepareTitleOfAppointmentDiv($appointments_of_patients_on_this_time_and_date)
    {
        $title_of_appointment_div = '' ;
        foreach ( $appointments_of_patients_on_this_time_and_date as $key )
        {
            $title_of_appointment_div .= '( '.$key->patient_first_name.' '.$key->patient_last_name.' -> '.$key->patient_mobile_number.' ) ' ;
        }
        return $title_of_appointment_div ;
    }

    public function PrepareClassNameAndColorStyleOfAppointmentDiv($number_of_appointments_on_this_time_and_date)
    {
        // Free Time (WHITE COLOR) **Default values**
        $class_name_of_appointment_div   = 'well';
        $color_style_of_appointment_div  = 'color:gray;';

        // Busy Time (ORANGE COLOR)
        if ($number_of_appointments_on_this_time_and_date > '0' && $number_of_appointments_on_this_time_and_date <= '3')
        {
            $class_name_of_appointment_div   = 'alert alert-warning well';
            $color_style_of_appointment_div  = 'color:white;background-color: rgba(243,156,18,0.88);';
        }
        // Over Busy Time (RED COLOR)
        elseif ($number_of_appointments_on_this_time_and_date > '3')
        {
            $class_name_of_appointment_div   = 'alert alert-danger well';
            $color_style_of_appointment_div  = 'color:white;background-color: rgba(231,76,60,0.88);';
        }

        return array($class_name_of_appointment_div , $color_style_of_appointment_div) ;
    }

    public function PrepareHtmlContent($time_of_appointment,$number_of_appointments_on_this_time_and_date,$title_of_appointment_div,$class_name_of_appointment_div,$color_style_of_appointment_div)
    {
        /** All of HTML codes will be concatenated to $HtmlContent variable
        and at the end of this function, this variable will be return to share on a view page **/
        $HtmlContent = '
        <label title="'.$title_of_appointment_div.'" class="well col-md-2 col-sm-2 col-xs-2 form-group btn-default '.$class_name_of_appointment_div.'" style="text-align:center;font-weight:normal;cursor: pointer;font-size:14px;'.$color_style_of_appointment_div.'" >';

            // If number of appointments on this specific time is more than 0 , Show that number
            if ($number_of_appointments_on_this_time_and_date !== '0')
            {
                $HtmlContent .= '
                <span>
                    ' . $number_of_appointments_on_this_time_and_date . '
                </span>';
            }
            else
            {
                $HtmlContent .= '
                <span>
                    &nbsp;
                </span>';
            }

            $HtmlContent .= '
            <div title="' . $title_of_appointment_div . '" ><input type="radio" name="appointment_time" class="flat" value="' . $time_of_appointment . '" > ' . $time_of_appointment . '</div>
        </label>';

        return $HtmlContent ;
    }

    public function PrepareHTMLContentOfAppointmentTimeTable($choose_time_for_this_date)
    {
        $HtmlContent = '' ;
        $start_of_day = strtotime('00:00');
        $end_end_day  = strtotime('24:00');

        // Chunk a day to small pieces of minutes
        for ( $index_counter = $start_of_day ; $index_counter <= $end_end_day ; $index_counter = $index_counter + Auth::user()->gap_time_between_appointments * 60 )
        {
            // date() method change X minutes to HH:MM format
            $time_of_appointment                            = date('H:i', $index_counter) ;
            $appointments_of_patients_on_this_time_and_date = patients_appointment::result_appointments_of_patients_on_this_time_and_date($choose_time_for_this_date, $time_of_appointment) ;
            $number_of_appointments_on_this_time_and_date   = $appointments_of_patients_on_this_time_and_date->count();
            $title_of_appointment_div                       = $this->PrepareTitleOfAppointmentDiv($appointments_of_patients_on_this_time_and_date) ;
            [$class_name_of_appointment_div, $color_style_of_appointment_div] = $this->PrepareClassNameAndColorStyleOfAppointmentDiv($number_of_appointments_on_this_time_and_date);
            $HtmlContent .= $this->PrepareHtmlContent($time_of_appointment,$number_of_appointments_on_this_time_and_date,$title_of_appointment_div,$class_name_of_appointment_div,$color_style_of_appointment_div) ;
        }
        return $HtmlContent ;
    }

    public function show_patient_time_appointment_table( $choose_time_for_this_date , $choose_time_for_this_patient_id )
    {
        try
        {
            return view('back.show_patient_time_appointment_table',
            [
                'title_of_page'                     => 'List of Appointments Time on Date: ' . $choose_time_for_this_date,
                'choose_time_for_this_date'         => $choose_time_for_this_date,
                'choose_time_for_this_patient_id'   => $choose_time_for_this_patient_id ,
                'HTMLContentOfAppointmentTimeTable' => $this->PrepareHTMLContentOfAppointmentTimeTable($choose_time_for_this_date)
            ]);
        }
        catch (QueryException $exception)
        {
            return Responses::FailedWithException( 'home' , '' , '<span style="color:blue;">We Have an Error to Show List of Appointments Time on This Specific Date</span>' , $exception ) ;
        }
    }

    public function PrepareAppointmentChildDrRelatedName($request_post_appointment_child_dr_related_name)
    {
        // This value SHOULD NOT BE NULL because we use this value on financial transaction searching page
        $appointment_child_dr_related_name = '' ;
        if( $request_post_appointment_child_dr_related_name !== null )
        {
            $appointment_child_dr_related_name = $request_post_appointment_child_dr_related_name ;
        }
        return $appointment_child_dr_related_name ;
    }

    public function PrepareAppointmentServiceType($request_post_appointment_service_type)
    {
        // This value SHOULD NOT BE NULL because we use this value on financial transaction searching page
        $appointment_service_type = '' ;
        if( $request_post_appointment_service_type !== null )
        {
            $appointment_service_type = $request_post_appointment_service_type ;
        }
        return $appointment_service_type ;
    }

    public function store_patient_time_appointment_table( store_patient_time_appointment_tableRequest $request )
    {
        $encrypted_choose_time_for_this_patient_id = request()->post('choose_time_for_this_patient_id') ;
        $decrypted_choose_time_for_this_patient_id = encrypt_decrypt('decrypt', request()->post('choose_time_for_this_patient_id') ) ;
        $appointment_child_dr_related_name         = $this->PrepareAppointmentChildDrRelatedName(request()->post('appointment_child_dr_related_name')) ;
        $appointment_service_type                  = $this->PrepareAppointmentServiceType(request()->post('appointment_service_type')) ;

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