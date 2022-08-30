<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\financial_transaction;
use App\Models\patients_appointment;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\Helpers ;

class HeaderController extends Controller
{
    public function PrepareMoneyReceivedVariable($request_money_receive)
    {
        $options_for_user = Auth::user()->options_for_user ;
        $money_receive_header_console = '' ;
        /** If money section feature of user was activated from Admin Panel ($options_for_user[14] == 't')
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

    public function IfUserClickOnButtonSendPatientToDoctorRoom($request)
    {
        $show_all_appointments_on_this_date  = date('Y-m-d');
        $admin_id_from_users_table           = find_admin_id_from_users_table() ;

        if($request->appointment_id)
        {
            try
            {
                $money_receive_header_console = $this->PrepareMoneyReceivedVariable($request->money_receive) ;
                patients_appointment::UpdateThisAppointmentFromWatingStatusToDoneStatus( $request->appointment_id , $admin_id_from_users_table , $money_receive_header_console ) ;

                /** Store a new financial transaction for this appointment
                If the $request->money_receive of financial transaction exist **/
                if( $money_receive_header_console !== '' )
                {
                    $result_fetch_appointment_data = patients_appointment::fetch_appointment_data( $request->appointment_id , $admin_id_from_users_table ) ;

                    foreach ( $result_fetch_appointment_data as $key_fetch_appointment_data )
                    {
                        $appointment_patient_related_id    = $key_fetch_appointment_data->appointment_patient_related_id ;
                        $appointment_child_dr_related_name = $key_fetch_appointment_data->appointment_child_dr_related_name ;
                        $appointment_service_type          = $key_fetch_appointment_data->appointment_service_type ;
                    }

                    if(!isset($appointment_child_dr_related_name))
                    {
                        // This value SHOULD NOT BE NULL because we use this value in financial transaction reporting page
                        // So leave it EMPTY
                        $appointment_child_dr_related_name = '' ;
                    }
                    if(!isset($appointment_service_type))
                    {
                        // This value SHOULD NOT BE NULL because we use this value in financial transaction reporting page
                        // So leave it EMPTY
                        $appointment_service_type = '' ;
                    }

                    $show_all_appointments_on_this_time = date('H:i:s') ;

                    financial_transaction::StoreNewFinancialTransactionForThisAppointment($admin_id_from_users_table,$appointment_patient_related_id,$request->appointment_id,$show_all_appointments_on_this_date,$show_all_appointments_on_this_time,$appointment_service_type,$money_receive_header_console,$appointment_child_dr_related_name) ;
                }

                Session()->put('success_message' , '<b>The Patient Successfully Sent to Doctors Room');
            }
            catch (QueryException $exception)
            {
                Session()->put('success_message', '<span style="color:blue;">We have an error to send this patient to doctors room</span>');
            }
        }
        else
        {
            Session()->put('success_message', '<span style="color:blue;">Send patient to doctors room was NOT successfully done <br> Please select ONE of the patient to send to doctors room</span>');
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
        $admin_id_from_users_table           = find_admin_id_from_users_table() ;
        $cms_menu_title_data_from_middleware = explode(",", Auth::user()->cms_menu_title) ;

        try
        {
            // Extract information of all appointments which exist in patients_appointment table on TODAY date (JOIN TYPE patients_appointment with patients_general_infos)
            $today_appointments = patients_appointment::AllAppointmentsOnThisDate( $admin_id_from_users_table , $show_all_appointments_on_this_date ) ;
            $count_of_today_appointment = $today_appointments->count() ;

            if( $count_of_today_appointment > 0 )
            {
                $today_waiting_appointments = patients_appointment::CountAppointmentsOnThisDateWhichAreOnWaitingStatus( $admin_id_from_users_table , $show_all_appointments_on_this_date ) ;
                $financial_management_data_in_header = $this->PrepareVariableOfFinancialManagementDataForHeader() ;

                View::share([
                    'result_middleware_provide_header_appointments_data_on_today' => $today_appointments ,
                    'count_of_appointment_in_header'      => $count_of_today_appointment ,
                    'count_of_appointment_in_header_for_patients_on_waiting_situation' => $today_waiting_appointments->count() ,
                    'financial_management_data_in_header' => $financial_management_data_in_header ,
                    'cms_menu_title_data_from_middleware' => $cms_menu_title_data_from_middleware
                ]) ;
            }
            else
            {
                View::share([
                    'result_middleware_provide_header_appointments_data_on_today'      => '' ,
                    'count_of_appointment_in_header'                                   => '' ,
                    'count_of_appointment_in_header_for_patients_on_waiting_situation' => '' ,
                    'financial_management_data_in_header'                              => '' ,
                    'cms_menu_title_data_from_middleware' => $cms_menu_title_data_from_middleware
                ]) ;
            }
        }
        catch (QueryException $exception)
        {
            Session()->put('success_message', '<span style="color:blue;">We have an error to show List of Appointments time on Date '.$show_all_appointments_on_this_date.'</span>');
        }
    }
}
