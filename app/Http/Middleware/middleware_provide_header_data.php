<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

// I added this model to this page manually.
// use App\Models\patients_general_info;
// use App\Models\User ;
use App\Models\patients_appointment;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\financial_transaction;
use phpDocumentor\Reflection\Types\Null_;

class middleware_provide_header_data
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    public function find_admin_id_from_users_table()
    {
        // If the user has a parent_id so user_type='user' and we use Auth::user()->parent_id
        if( strlen(Auth::user()->parent_id) > 0 )
        {
            return $admin_id_from_users_table = Auth::user()->parent_id ;
        }
        // If the user DOES NOT have parent_id so user_type='admin' and we use Auth::user()->id
        else
        {
            return $admin_id_from_users_table = Auth::user()->id ;
        }
    }

    public function handle(Request $request, Closure $next)
    {
        $show_all_appointments_on_this_date  = date('Y-m-d');
        $admin_id_from_users_table           = $this->find_admin_id_from_users_table() ;
        $admin_accessibility_to_telegram     = Auth::user()->telegram ;
        $admin_full_name                     = Auth::user()->name ;
        $cms_menu_title_data_from_middleware = explode(",", Auth::user()->cms_menu_title) ;

        // If user click on send patient to doctors room from header
        if($request->send_patient_to_doctors_room === 'true' )
        {
            if( strlen($request->appointment_id) > 0 )
            {
                try
                {
                    // If user activated money section from admin panel
                    $options_for_user = Auth::user()->options_for_user ;

                    if( $options_for_user[14] == 't' && $request->money_receive !== null )
                    {
                        $money_receive_header_console = '0' ;
                        foreach( $request->money_receive as $item )
                        {
                            $money_receive_header_console += $item ;
                        }
                    }
                    else
                    {
                        $money_receive_header_console = '' ;
                    }

                    // Update this appointment from Waiting status to Done status
                    $result_update_send_patient_to_doctors_room = patients_appointment::
                    select('*')
                    ->where( 'appointment_id'           , '=' , $request->appointment_id )
                    ->where( 'appointment_dr_related_id', '=' , $admin_id_from_users_table )
                    ->update([
                        'appointment_status'                    => '0' ,
                        'appointment_status_unique'             => '1' ,
                        'appointment_received_financial_status' => $money_receive_header_console
                    ]);

                    // Store a new financial transaction for this appointment
                    // If the request of financial transaction exist
                    if( $money_receive_header_console !== '' )
                    {
                        $result_fetch_appointment_data = patients_appointment::
                        select('appointment_id' , 'appointment_dr_related_id' , 'appointment_patient_related_id' , 'appointment_child_dr_related_name' , 'appointment_service_type' )
                        ->where('appointment_id',            '='              , $request->appointment_id)
                        ->where('appointment_dr_related_id', '='              , $admin_id_from_users_table)
                        ->limit('1')
                        ->get() ;

                        foreach ( $result_fetch_appointment_data as $key_fetch_appointment_data )
                        {
                            $appointment_patient_related_id    = $key_fetch_appointment_data->appointment_patient_related_id ;
                            $appointment_child_dr_related_name = $key_fetch_appointment_data->appointment_child_dr_related_name ;
                            $appointment_service_type          = $key_fetch_appointment_data->appointment_service_type ;
                        }

                        $show_all_appointments_on_this_time = date('H:i:s') ;

                        $result_store_financial_transaction_from_header = new financial_transaction(
                        [
                            'financial_dr_related_id'          => $admin_id_from_users_table ,
                            'financial_patient_related_id'     => $appointment_patient_related_id ,
                            'financial_appointment_related_id' => $request->appointment_id ,
                            'financial_transaction_type'       => '+' ,
                            'financial_transaction_date'       => $show_all_appointments_on_this_date ,
                            'financial_transaction_time'       => $show_all_appointments_on_this_time ,
                            'financial_transaction_title'      => $appointment_service_type ,
                            'financial_transaction_amount'     => $money_receive_header_console ,
                            'financial_transaction_child_dr_related_name' => $appointment_child_dr_related_name
                        ]
                        ) ;
                        $result_store_financial_transaction_from_header->save() ;
                    }

                    \Session::flash('success_message', '<b>The Patient Successfully Sent to Doctors Room');
                }
                catch (\Exception $exception)
                {
                    \Session::flash('success_message', $exception.'<span style="color:blue;">We have an error to send this patient to doctors room</span>');
                }
            }
            else
            {
                \Session::flash('success_message', '<span style="color:blue;">Send patient to doctors room was NOT successfully done <br> Please select ONE of the patient to send to doctors room</span>');
            }
        }

        try
        {
            // Create mysql query to extract all of appointments that record in patients_appointment table on TODAY date (JOIN TYPE)
            $result_middleware_provide_header_appointments_data_on_today = patients_appointment::
            join('patients_general_infos' , 'patients_general_infos.patient_id' , '=' , 'patients_appointments.appointment_patient_related_id')
            ->select('*')
            ->where('patients_appointments.appointment_dr_related_id' , '=' , $admin_id_from_users_table )
            ->where('patients_appointments.appointment_date'          , '=' , $show_all_appointments_on_this_date )
            ->orderBy('patients_appointments.appointment_time')
            ->get() ;

            $result_middleware_provide_count_of_appointment_on_waiting_on_header = patients_appointment::
            select('appointment_dr_related_id' , 'appointment_date' , 'appointment_status_unique' , 'appointment_status' , 'appointment_time')
            ->where('patients_appointments.appointment_dr_related_id' , '=' , $admin_id_from_users_table )
            ->where('patients_appointments.appointment_date'          , '=' , $show_all_appointments_on_this_date )
            ->where('patients_appointments.appointment_status_unique' , '=' , '0' )
            ->where('patients_appointments.appointment_status'        , '=' , '1' )
            ->orderBy('patients_appointments.appointment_time')
            ->get() ;

            // How many appointments found for situation patients are waiting for going to doctors room on TODAY
            $count_of_appointment_in_header_for_patients_on_waiting_situation = $result_middleware_provide_count_of_appointment_on_waiting_on_header->count() ;

            // How many appointments found for those of patients who have appointment on TODAY
            $count_of_appointment_in_header = $result_middleware_provide_header_appointments_data_on_today->count() ;

            // If more than 0 appointment exist on patients_appointments table for TODAY date.
            if( $count_of_appointment_in_header > 0 )
            {
                if( strlen(Auth::user()->financial_management) > 0 )
                {
                    $financial_management_data_in_header = Auth::user()->financial_management ;
                }
                else
                {
                    $financial_management_data_in_header = '' ;
                }

                View::share([
                'result_middleware_provide_header_appointments_data_on_today' => $result_middleware_provide_header_appointments_data_on_today ,
                'financial_management_data_in_header' => $financial_management_data_in_header ,
                'count_of_appointment_in_header'      => $count_of_appointment_in_header ,
                'count_of_appointment_in_header_for_patients_on_waiting_situation' => $count_of_appointment_in_header_for_patients_on_waiting_situation ,
                'admin_accessibility_to_telegram'     => $admin_accessibility_to_telegram ,
                'admin_full_name'                     => $admin_full_name ,
                'cms_menu_title_data_from_middleware' => $cms_menu_title_data_from_middleware
                ]) ;
            }
            else
            {
                View::share([
                'result_middleware_provide_header_appointments_data_on_today' => '' ,
                'financial_management_data_in_header' => '' ,
                'count_of_appointment_in_header'      => '' ,
                'count_of_appointment_in_header_for_patients_on_waiting_situation' => $count_of_appointment_in_header_for_patients_on_waiting_situation ,
                'admin_accessibility_to_telegram'     => $admin_accessibility_to_telegram ,
                'admin_full_name'                     => $admin_full_name ,
                'cms_menu_title_data_from_middleware' => $cms_menu_title_data_from_middleware
                ]) ;
            }
        }
        catch (\Exception $exception)
        {
            \Session::flash('success_message', '<span style="color:blue;">We have an error to show List of Appointments time on Date '.$show_all_appointments_on_this_date.'</span>');
        }

        return $next($request);
    }
}
