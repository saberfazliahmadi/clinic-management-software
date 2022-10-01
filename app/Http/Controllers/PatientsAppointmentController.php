<?php
namespace App\Http\Controllers;

use App\Http\Requests\AppointmentsShowRequest;
use App\Http\Requests\AppointmentsStoreRequest;
use App\Responses\Responses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\{ patients_appointment , patients_general_info };

/** In this controller according to Single Responsibility and Open-Closed Principles of SOLID
we validate user inputs by Middleware **/
class PatientsAppointmentController extends Controller
{
    public function index()
    {
        return view('back.appointments_index' , [ 'title_of_page' => 'List of Appointments on a Specific Date' ]) ;
    }

    public function create( $encrypted_patient_id , $date )
    {
        try
        {
            return view('back.appointments_create',
            [
                'title_of_page'                     => 'List Time of Appointments on Date: '.$date,
                'choose_time_for_this_date'         => $date,
                'choose_time_for_this_patient_id'   => $encrypted_patient_id,
                'HTMLContentOfAppointmentTimeTable' => $this->prepareHTMLContentOfAppointmentTimeTable($date)
            ]);
        }
        catch (\Exception $exception)
        {
            return Responses::failedWithException( 'home' , '' , '<span style="color:blue;">We Have an Error to Show List of Appointments Time on This Specific Date</span>' , $exception ) ;
        }
    }

    public function store(AppointmentsStoreRequest $request)
    {
        $encrypted_choose_time_for_this_patient_id = request()->post('choose_time_for_this_patient_id') ;
        $decrypted_choose_time_for_this_patient_id = encryptDecrypt('decrypt', request()->post('choose_time_for_this_patient_id') ) ;
        $appointment_child_dr_related_name         = $this->prepareAppointmentChildDrRelatedName(request()->post('appointment_child_dr_related_name')) ;
        $appointment_service_type                  = $this->prepareAppointmentServiceType(request()->post('appointment_service_type')) ;
        $response_message = '<span style="color:blue;">The Time and Date Appointment Were NOT Successfully Submitted!</span>' ;
        try
        {
            $result_store_new_patient_appointment_time              = patients_appointment::storeNewPatientAppointmentTime($decrypted_choose_time_for_this_patient_id, request()->post('choose_time_for_this_date'), request()->post('appointment_time'), $appointment_child_dr_related_name, $appointment_service_type) ;
            $update_patient_general_info_last_appointment_data_time = patients_general_info::updatePatientGeneralInfoLastAppointmentDataTime($decrypted_choose_time_for_this_patient_id, request()->post('choose_time_for_this_date'), request()->post('appointment_time')) ;

            // If the appointment successfully submitted make success response message
            if( $result_store_new_patient_appointment_time->exists && $update_patient_general_info_last_appointment_data_time )
            {
                $response_message = 'The Appointment Time= '.request()->post('appointment_time').' On Date= '.request()->post('choose_time_for_this_date').' <br> of <a href="'.route('patients.edit', $encrypted_choose_time_for_this_patient_id ).'" ><b>Patient</b></a> Were Successfully Submitted' ;
            }
            return Responses::success( 'patients.create' , '' , $response_message ) ;
        }
        catch (\Exception $exception)
        {
            return Responses::failedWithException( 'patients.create' , '' , $response_message , $exception ) ;
        }
    }
    
    public function show(AppointmentsShowRequest $request)
    {
        $date = $this->prepareDateOfAppointment($request->post('show_all_appointments_on_this_date') , $request->show_all_appointments_on_this_date ) ;
        try
        {
            $result_of_appointments_on_specific_date = patients_appointment::appointmentsOnSpecificDate($date) ;
            $count_of_appointment                    = $result_of_appointments_on_specific_date->count() ;

            if( $count_of_appointment === 0 )
            {
                return Responses::success( 'appointments.index' , '' , '<b style="color:blue" >There is no appointment on date '.$date.'</b><br> Please, choose another date to show appointments' ) ;
            }

            return view('back.appointments_index' ,
            [
                'title_of_page'                                     => 'List of All Appointments on Date '.$date ,
                'result_show_form_of_appointments_on_specific_date' => $result_of_appointments_on_specific_date ,
                'count_of_appointment'                              => $count_of_appointment ,
                'show_all_appointments_on_this_date'                => $date ,
                'financial_management_data'                         => $this->prepareFinancialManagementData()
            ] ) ;
        }
        catch (\Exception $exception )
        {
            return Responses::failedWithException( 'appointments.index' , '' , '<b style="color:blue;" >We have an Error to show appointments on Date '.$date.'</b>' , $exception ) ;
        }
    }

    public function destroy(Request $request)
    {
        $response_message = '<span style="color:blue;">The Selected Appointment WAS NOT Deleted!</span><br>You may have a related financial transaction to this appointment<br>So, first of all you should delete related financial transaction' ;
        try
        {
            if( patients_appointment::deleteThisAppointmentId($request->appointment_id) )
            {
                $response_message = '<span>The Selected Appointment Successfully Deleted</span>' ;
            }
            return Responses::success( 'back_to_previous_page' , '' , $response_message ) ;
        }
        catch (\Exception $exception)
        {
            return Responses::failedWithException( 'back_to_previous_page' , '' , $response_message , $exception ) ;
        }
    }

    // Define and Specify a variable of date's appointments by GET or POST method
    public function prepareDateOfAppointment($request_post_date , $request_get_date)
    {
        $show_all_appointments_on_this_date = '' ;
        if( $request_post_date !== "" )
        {
            $show_all_appointments_on_this_date = $request_post_date ;
        }
        elseif( $request_get_date !== "" )
        {
            $show_all_appointments_on_this_date = $request_get_date ;
        }
        return $show_all_appointments_on_this_date ;
    }

    public function prepareFinancialManagementData()
    {
        $financial_management_data = '' ;
        if( Auth::user()->financial_management !== '' )
        {
            $financial_management_data = Auth::user()->financial_management ;
        }
        return $financial_management_data ;
    }

    public function prepareTitleOfAppointmentDiv($appointments_of_patients_on_this_time_and_date)
    {
        $title_of_appointment_div = '' ;
        foreach ( $appointments_of_patients_on_this_time_and_date as $key )
        {
            $title_of_appointment_div .= '( '.$key->patient_first_name.' '.$key->patient_last_name.' -> '.$key->patient_mobile_number.' ) ' ;
        }
        return $title_of_appointment_div ;
    }

    public function prepareClassNameAndColorStyleOfAppointmentDiv($number_of_appointments_on_this_time_and_date)
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

    public function prepareHtmlContent($time_of_appointment, $number_of_appointments_on_this_time_and_date, $title_of_appointment_div, $class_name_of_appointment_div, $color_style_of_appointment_div)
    {
        /** All of HTML codes will be concatenated to $html_content variable
        and at the end of this function, this variable will be return to share on a view page **/
        $html_content = '
        <label title="'.$title_of_appointment_div.'" class="well col-md-2 col-sm-2 col-xs-2 form-group btn-default '.$class_name_of_appointment_div.'" style="text-align:center;font-weight:normal;cursor: pointer;font-size:14px;'.$color_style_of_appointment_div.'" >';

            // If number of appointments on this specific time is more than 0 , Show that number
            if ($number_of_appointments_on_this_time_and_date !== '0')
            {
                $html_content .= '
                <span>
                    '.$number_of_appointments_on_this_time_and_date.'
                </span>';
            }
            else
            {
                $html_content .= '
                <span>
                    &nbsp;
                </span>';
            }

            $html_content .= '
            <div title="'.$title_of_appointment_div.'" ><input type="radio" name="appointment_time" class="flat" value="' . $time_of_appointment . '" > ' . $time_of_appointment . '</div>
        </label>';

        return $html_content ;
    }

    public function prepareHTMLContentOfAppointmentTimeTable($date)
    {
        $html_content = '';
        $start_of_day = strtotime('00:00');
        $end_end_day  = strtotime('24:00');

        // Chunk a day to small pieces of minutes
        for ( $index_counter = $start_of_day ; $index_counter <= $end_end_day ; $index_counter = $index_counter + Auth::user()->gap_time_between_appointments * 60 )
        {
            // date() method change X minutes to HH:MM format
            $time_of_appointment                                              = date('H:i', $index_counter) ;
            $appointments_of_patients_on_this_time_and_date                   = patients_appointment::resultAppointmentsOfPatientsOnThisTimeAndDate($date, $time_of_appointment) ;
            $number_of_appointments_on_this_time_and_date                     = $appointments_of_patients_on_this_time_and_date->count() ;
            $title_of_appointment_div                                         = $this->prepareTitleOfAppointmentDiv($appointments_of_patients_on_this_time_and_date) ;
            [$class_name_of_appointment_div, $color_style_of_appointment_div] = $this->prepareClassNameAndColorStyleOfAppointmentDiv($number_of_appointments_on_this_time_and_date) ;
            $html_content .= $this->prepareHtmlContent($time_of_appointment, $number_of_appointments_on_this_time_and_date, $title_of_appointment_div, $class_name_of_appointment_div, $color_style_of_appointment_div) ;
        }
        return $html_content ;
    }

    public function prepareAppointmentChildDrRelatedName($request_post_appointment_child_dr_related_name)
    {
        // This value SHOULD NOT BE NULL because we use this value on financial transaction searching page
        $appointment_child_dr_related_name = '' ;
        if( $request_post_appointment_child_dr_related_name !== null )
        {
            $appointment_child_dr_related_name = $request_post_appointment_child_dr_related_name ;
        }
        return $appointment_child_dr_related_name ;
    }

    public function prepareAppointmentServiceType($request_post_appointment_service_type)
    {
        // This value SHOULD NOT BE NULL because we use this value on financial transaction searching page
        $appointment_service_type = '' ;
        if( $request_post_appointment_service_type !== null )
        {
            $appointment_service_type = $request_post_appointment_service_type ;
        }
        return $appointment_service_type ;
    }
}