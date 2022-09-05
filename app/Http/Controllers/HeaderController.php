<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\financial_transaction;
use App\Models\patients_appointment;
use App\Responses\Responses;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use App\Helpers ;

class HeaderController extends Controller
{
    public function PrepareMoneyReceivedVariable($request_money_receive)
    {
        $options_for_user = Auth::user()->options_for_user ;
        $money_receive_header_console = '' ;
        /** If feature of money was activated from Admin Panel for this user id ($options_for_user[14] == 't')
        and If user selected amount of money which patient paid  **/
        if( $options_for_user[14] == 't' && $request_money_receive !== null )
        {
            $money_receive_header_console = '0' ;
            foreach( $request_money_receive as $item )
            {
                $money_receive_header_console += $item ;
            }
        }
        return $money_receive_header_console ;
    }

    public function StoreNewFinancialTransactionForThisAppointment( $show_all_appointments_on_this_date , $admin_id_from_users_table , $request_appointment_id , $money_receive_header_console )
    {
        try
        {
            $result_appointment_data = patients_appointment::fetch_appointment_data( $request_appointment_id , $admin_id_from_users_table ) ;

            foreach ( $result_appointment_data as $key )
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

            financial_transaction::StoreNewFinancialTransactionForThisAppointment(
            $admin_id_from_users_table,
            $appointment_patient_related_id,
            $request_appointment_id,
            $show_all_appointments_on_this_date,
            $show_all_appointments_on_this_time,
            $appointment_service_type,
            $money_receive_header_console,
            $appointment_child_dr_related_name) ;
        }
        catch (QueryException $exception)
        {
            return Responses::FailedWithException( 'home' , '' , '<span style="color:blue;">We have an error to store financial transaction for this appointment</span>' , $exception ) ;
        }
    }

    public function IfUserClickOnButtonSendPatientToDoctorRoom( Request $request )
    {
        try
        {
            $show_all_appointments_on_this_date  = date('Y-m-d');
            $admin_id_from_users_table           = find_admin_id_from_users_table() ;
            $money_receive_header_console        = $this->PrepareMoneyReceivedVariable( $request->money_receive ) ;

            patients_appointment::UpdateThisAppointmentFromWatingStatusToDoneStatus( $request->appointment_id , $admin_id_from_users_table , $money_receive_header_console ) ;

            if( $money_receive_header_console !== '' )
            {
                $this->StoreNewFinancialTransactionForThisAppointment( $show_all_appointments_on_this_date , $admin_id_from_users_table , $request->appointment_id , $money_receive_header_console ) ;
            }
            return Responses::Success( 'back_to_previous_page' , '' , '<b>The Patient Successfully Sent to Doctors Room' ) ;
        }
        catch (QueryException $exception)
        {
            return Responses::FailedWithException( 'home' , '' , '<span style="color:blue;">We have an error to send this patient to doctors room</span>' , $exception ) ;
        }
    }

    public function PrepareVariableOfFinancialManagementDataForHeader()
    {
        $financial_management_data_in_header = '' ;
        if(Auth::user()->financial_management !== '')
        {
            $financial_management_data_in_header = Auth::user()->financial_management ;
        }
        return $financial_management_data_in_header ;
    }

    public function ProvideHeaderDataAndShareItOnView()
    {
        $show_all_appointments_on_this_date  = date('Y-m-d');
        try
        {
            $admin_id_from_users_table  = find_admin_id_from_users_table() ;
            $today_appointments         = patients_appointment::AllAppointmentsOnThisDate( $admin_id_from_users_table , $show_all_appointments_on_this_date ) ;
            $count_of_today_appointment = $today_appointments->count() ;

            $count_of_today_waiting_appointments = 0 ;
            $financial_management_data_in_header = '' ;
            if( $count_of_today_appointment > 0 )
            {
                $count_of_today_waiting_appointments = patients_appointment::CountAppointmentsOnThisDateWhichAreOnWaitingStatus( $admin_id_from_users_table , $show_all_appointments_on_this_date ) ;
                $financial_management_data_in_header = $this->PrepareVariableOfFinancialManagementDataForHeader() ;
            }

            View::share([
                'result_middleware_provide_header_appointments_data_on_today' => $today_appointments ,
                'count_of_appointment_in_header'      => $count_of_today_appointment ,
                'count_of_appointment_in_header_for_patients_on_waiting_situation' => $count_of_today_waiting_appointments ,
                'financial_management_data_in_header' => $financial_management_data_in_header ,
                'cms_menu_title_data_from_middleware' => explode(",", Auth::user()->cms_menu_title)
            ]) ;
        }
        catch (QueryException $exception)
        {
            return Responses::FailedAndLogout( '<span style="color:blue;">We have an error to show List of Appointments time on Date '.$show_all_appointments_on_this_date.'</span>' ) ;
        }
    }
}
