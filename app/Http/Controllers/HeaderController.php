<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\IfUserClickOnButtonOfSendPatientToDoctorRoomRequest;
use App\Models\financial_transaction;
use App\Models\patients_appointment;
use App\Responses\Responses;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class HeaderController extends Controller
{
    public function ifUserClickOnButtonSendPatientToDoctorRoom(IfUserClickOnButtonOfSendPatientToDoctorRoomRequest $request)
    {
        $request_validated = $request->validated();
        try
        {
            $show_all_appointments_on_this_date  = date('Y-m-d');
            $admin_id_from_users_table           = findAdminIdFromUsersTable();
            $money_receive_header_console        = $this->prepareMoneyReceivedVariable($request_validated);

            patients_appointment::updateThisAppointmentFromWatingStatusToDoneStatus($request_validated['appointment_id'] , $admin_id_from_users_table , $money_receive_header_console ) ;

            if( $money_receive_header_console !== '' )
            {
                $this->storeNewFinancialTransactionForThisAppointment($show_all_appointments_on_this_date , $admin_id_from_users_table , $request_validated['appointment_id'] , $money_receive_header_console ) ;
            }
            return Responses::success( 'back_to_previous_page' , '' , '<b>The Patient Successfully Sent to Doctors Room' ) ;
        }
        catch(\Exception $exception)
        {
            return Responses::failedWithException( 'home' , '' , '<span style="color:blue;">We have an error to send this patient to doctors room</span>' , $exception ) ;
        }
    }

    public function provideHeaderDataAndShareItOnView()
    {
        $show_all_appointments_on_this_date  = date('Y-m-d');
        try
        {
            $admin_id_from_users_table  = findAdminIdFromUsersTable();
            $today_appointments         = patients_appointment::allAppointmentsOnThisDate($admin_id_from_users_table , $show_all_appointments_on_this_date ) ;
            $count_of_today_appointment = $today_appointments->count();

            $count_of_today_waiting_appointments = 0;
            $financial_management_data_in_header = '';
            if( $count_of_today_appointment > 0 )
            {
                $count_of_today_waiting_appointments = patients_appointment::countAppointmentsOnThisDateWhichAreOnWaitingStatus($admin_id_from_users_table , $show_all_appointments_on_this_date ) ;
                $financial_management_data_in_header = $this->prepareVariableOfFinancialManagementDataForHeader() ;
            }

            View::share([
            'result_middleware_provide_header_appointments_data_on_today'      => $today_appointments ,
            'count_of_appointment_in_header'                                   => $count_of_today_appointment ,
            'count_of_appointment_in_header_for_patients_on_waiting_situation' => $count_of_today_waiting_appointments ,
            'financial_management_data_in_header'                              => $financial_management_data_in_header ,
            'cms_menu_title_data_from_middleware'                              => explode(",", Auth::user()->cms_menu_title)
            ]) ;
        }
        catch(\Exception $exception)
        {
            return Responses::FailedAndLogout( '<span style="color:blue;">We have an error to show List of Appointments time on Date '.$show_all_appointments_on_this_date.'</span>' ) ;
        }
    }

    public function prepareMoneyReceivedVariable($request_money_receive)
    {
        $money_receive_header_console = '' ;
        $options_for_user             = Auth::user()->options_for_user ;
        /** If the feature of money was activated from the Admin Panel for this user id
        and if the user selected an amount of money which the patient had already paid */
        if( isset($request_money_receive['money_receive']) && $request_money_receive['money_receive'] !== '' && $options_for_user[14] === 't' )
        {
            $money_receive_header_console = '0' ;
            foreach( $request_money_receive['money_receive'] as $item )
            {
                $money_receive_header_console += $item ;
            }
        }
        return $money_receive_header_console ;
    }

    public function storeNewFinancialTransactionForThisAppointment($show_all_appointments_on_this_date , $admin_id_from_users_table , $request_appointment_id , $money_receive_header_console )
    {
        try
        {
            $result_appointment_data = patients_appointment::fetchAppointmentData($request_appointment_id , $admin_id_from_users_table ) ;
            if(!$result_appointment_data)
            {
                return Responses::failed( 'back_to_previous_page' , '' , '<b>We have an error to fetch data of this appointment!' ) ;
            }

            foreach( $result_appointment_data as $key )
            {
                $appointment_patient_related_id    = $key->appointment_patient_related_id ;
                $appointment_child_dr_related_name = $key->appointment_child_dr_related_name ;
                $appointment_service_type          = $key->appointment_service_type ;
            }

            /** 2 belows variables SHOULD NOT BE NULL
            Because we use these variables in financial transaction reporting page
            So, if they do not exist in the database, equals them to empty **/
            if(!isset($appointment_child_dr_related_name))
            {
                $appointment_child_dr_related_name = '' ;
            }
            if(!isset($appointment_service_type))
            {
                $appointment_service_type = '' ;
            }

            $show_all_appointments_on_this_time = date('H:i:s') ;

            if(! financial_transaction::storeNewFinancialTransactionForThisAppointment(
            $admin_id_from_users_table,
            $appointment_patient_related_id,
            $request_appointment_id,
            $show_all_appointments_on_this_date,
            $show_all_appointments_on_this_time,
            $appointment_service_type,
            $money_receive_header_console,
            $appointment_child_dr_related_name) )
            {
                return Responses::failed( 'back_to_previous_page' , '' , '<b>We have an error to store New Financial Transaction For This Appointment!' ) ;
            }
        }
        catch(\Exception $exception)
        {
            return Responses::failedWithException( 'home' , '' , '<span style="color:blue;">We have an error to store financial transaction for this appointment</span>' , $exception ) ;
        }
    }

    public function prepareVariableOfFinancialManagementDataForHeader()
    {
        $auth_financial_management = Auth::user()->financial_management ;
        $financial_management_data_in_header = '' ;
        if($auth_financial_management !== '')
        {
            $financial_management_data_in_header = $auth_financial_management ;
        }
        return $financial_management_data_in_header ;
    }
}