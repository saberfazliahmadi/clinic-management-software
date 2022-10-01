<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use mysql_xdevapi\Session;
use phpDocumentor\Reflection\DocBlock\Tags\Uses;
use Hash;

use App\Responses\Responses ;
// https://stackoverflow.com/questions/32718870/how-to-get-all-input-of-post-in-laravel
/** In this controller according to Single Responsibility and Open-Closed Principles of SOLID
we validate user inputs by Middleware **/
class UserController extends Controller
{
    public static function make_ban_or_active_this_user_id( $name_of_user , $id_of_user , $action )
    {
        return User::make_ban_or_active_this_user_id($name_of_user , $id_of_user , $action) ;
    }

    public function showManagementUsersOfSoftwareForm()
    {
        try
        {
            return view('back.show_management_users_of_software_form' ,
            [
                'title_of_page'                                   => 'Management Users of '.__('general.Name of software') ,
                'result_of_all_users_related_to_this_super_admin' =>  User::all_users_related_to_this_super_admin() ,
            ]);
        }
        catch (\Exception $exception)
        {
            return Responses::failedWithException('home' , '' , '<b style="color:blue;" >We have an error to show Management Users of Software From</b>' , $exception)  ;
        }
    }

    public function PrepareDataLogFile()
    {
        $data_of_log_file = '' ;
        if(File::exists(storage_path('logs\laravel.log')))
        {
            $data_of_log_file = File::get(storage_path('logs\laravel.log')) ;
        }
        return $data_of_log_file ;
    }

    public function showUsersActivitiesLogs()
    {
        try
        {
            $data_of_log_file = $this->PrepareDataLogFile();
            return view('back.show_users_activities_logs' ,
            [
                'title_of_page' => 'Users Activities Logs' ,
                'log_data'      => $data_of_log_file ,
            ]);
        }
        catch (\Exception $exception)
        {
            return Responses::failedWithException('home' , '' , '<b style="color:blue;" >We have an error to show Users Activities Logs</b>' , $exception)  ;
        }
    }

    public function showMainSettingsOfSoftwareForm()
    {
        try
        {
            $result_show_main_settings_of_software_form = User::show_main_settings_of_software_form(Auth::id(), Auth::user()->name) ;

            if(!$result_show_main_settings_of_software_form)
            {
                return Responses::failed('home', '' , '<b style="color:blue;" >We have an error to show main settings of software</b>' ) ;
            }
            return view('back.show_main_settings_of_software_form' ,
            [
                'title_of_page'                              => 'Main Settings of Software' ,
                'result_show_main_settings_of_software_form' => $result_show_main_settings_of_software_form
            ]);
        }
        catch (\Exception $exception)
        {
            return Responses::failedWithException('home', '' , '<b style="color:blue;" >We have an error to show main settings of software</b>' , $exception ) ;
        }
    }

    public function prepare_variable_of_gap_time_between_appointments($request_gap_time_between_appointments)
    {
        // Remove space from $request_gap_time_between_appointments
        $gap_time_between_appointments = str_replace(" ", "", $request_gap_time_between_appointments);
        // $gap_time_between_appointments should be an amount between 5 and 60 minutes
        if ($gap_time_between_appointments < 5 && is_numeric($gap_time_between_appointments))
        {
            $gap_time_between_appointments = 5 ;
        }
        elseif ($gap_time_between_appointments > 60 && is_numeric($gap_time_between_appointments))
        {
            $gap_time_between_appointments = 60 ;
        }
        // The acceptable gap time range
        elseif ($gap_time_between_appointments >= 5 && $gap_time_between_appointments <= 60 && is_numeric($gap_time_between_appointments))
        {
            $gap_time_between_appointments = $gap_time_between_appointments ;
        }
        // Define the default gap time of appointments
        else
        {
            $gap_time_between_appointments = 30 ;
        }
        return $gap_time_between_appointments ;
    }

    public function prepare_variable_of_options_for_user($money_console_status)
    {
        // The processing to un-serialize an array variable and add new value at the end of it
        // and then serialize that variable again. a:1:{i:0;s:1:"f";}
        $options_for_user    = Auth::user()->options_for_user ;
        $options_for_user    = (unserialize($options_for_user)) ;
        $options_for_user[0] = 'f' ;
        if ($money_console_status === 'true')
        {
            $options_for_user[0] = 't' ;
        }
        return serialize($options_for_user) ;
    }

    // Remove some extra words from financial items
    public function remove_extra_words_from_financial_management_variable($request_financial_management)
    {
        return str_replace([".","/","|","+","-"], "", $request_financial_management );
    }

    public function prepare_cms_menu_title($request)
    {
        return $request['cms_menu_title_0']
        . ',' . $request['cms_menu_title_1']
        . ',' . $request['cms_menu_title_2']
        . ',' . $request['cms_menu_title_3']
        . ',' . $request['cms_menu_title_4']
        . ',' . $request['cms_menu_title_5']
        . ','
        . ',' . $request['cms_menu_title_7']
        . ',' . $request['cms_menu_title_8']
        . ',' . $request['cms_menu_title_9']
        . ',' . $request['cms_menu_title_10']
        . ',' . $request['cms_menu_title_11']
        . ',' . $request['cms_menu_title_12']
        . ',' . $request['cms_menu_title_13']
        . ',' . $request['cms_menu_title_14']
        . ',' . $request['cms_menu_title_15']
        . ',' . $request['cms_menu_title_16']
        . ',' . $request['cms_menu_title_17']
        . ',' . $request['cms_menu_title_18']
        . ',' . $request['cms_menu_title_19']
        . ',' . $request['cms_menu_title_20']
        . ',' . $request['cms_menu_title_21']
        . ',' . $request['cms_menu_title_22']
        . ',' . $request['cms_menu_title_23']
        . ',' . $request['cms_menu_title_24']
        . ',' . $request['cms_menu_title_25']
        . ',' . $request['cms_menu_title_26']
        . ',' . $request['cms_menu_title_27']
        . ',' . $request['cms_menu_title_28'] ;
    }

    // Here form request Validation Executed by ValidatorMainSettingsSoftwareFormRequest Middleware
    public function updateShowMainSettingsOfSoftwareForm(Request $request)
    {
        $options_for_user              = $this->prepare_variable_of_options_for_user($request->money_console_status) ;
        $financial_management          = $this->remove_extra_words_from_financial_management_variable($request->financial_management) ;
        $gap_time_between_appointments = $this->prepare_variable_of_gap_time_between_appointments($request->gap_time_between_appointments) ;
        $cms_menu_title                = $this->prepare_cms_menu_title($request->all()) ;
        $common_drug                   = str_replace(" ", "_", $request->common_drug);
        $decrypted_id_of_user = encryptDecrypt('decrypt' , $request->id_of_user) ;

        $success_message = 'The New Settings of Software Successfully Updated' ;
        $failed_message  = '<b style="color:blue;" >We have an error to update New Settings of Software</b>' ;
        $extra_message   = ' for <b style="color:blue;" >'.$request->name_of_user.'</b>' ;

        try
        {
            /** If the request was from Route => update_user_info_by_super_admin **/
            if( $request->route()->getName() === 'update_user_info_by_super_admin')
            {
                $result_update_main_settings_of_software_form = User::update_main_settings_of_software_form_for_super_admin( $decrypted_id_of_user , $request->name_of_user , $common_drug , $request->common_diet , $request->common_return_date ,$request->phone_number,$request->college_branch,$request->contact_address,$request->common_hypersensitivity,$options_for_user,$cms_menu_title,$gap_time_between_appointments,$request->clinic_doctors_name , $request->status_of_user , $request->level_of_user , $financial_management ) ;
                if(!$result_update_main_settings_of_software_form)
                {
                    return Responses::failed('show_management_users_of_software_form' , '' , $failed_message ) ;
                }
                return Responses::success('show_management_users_of_software_form' , '' , $success_message.$extra_message ) ;
            }

            /** If the request was from Route => update_show_main_settings_of_software_form **/
            $result_update_main_settings_of_software_form = User::update_main_settings_of_software_form( $decrypted_id_of_user , $request->name_of_user , $common_drug , $request->common_diet , $request->common_return_date ,$request->phone_number,$request->college_branch,$request->contact_address,$request->common_hypersensitivity,$options_for_user,$cms_menu_title,$gap_time_between_appointments,$request->clinic_doctors_name, $financial_management ) ;
            if(!$result_update_main_settings_of_software_form)
            {
                return Responses::failed('show_main_settings_of_software_form' , '' , $failed_message ) ;
            }
            return Responses::success('show_main_settings_of_software_form' , '' , $success_message ) ;
        }
        catch (\Exception $exception)
        {
            if( $request->route()->getName() === 'update_user_info_by_super_admin')
            {
                return Responses::failedWithException('show_management_users_of_software_form' , '' , $failed_message.$extra_message , $exception) ;
            }
            return Responses::failedWithException('show_main_settings_of_software_form' , '' , $failed_message , $exception) ;
        }
    }

    public function showChangePasswordForm()
    {
        return view('back.show_change_password_form', ['title_of_page' => 'Change Password']);
    }

    // Here form request Validation Executed by ValidatorChangePasswordRequest Middleware
    public function runChangePasswordForm(Request $request )
    {
        $response_message_failed = '<b style="color:blue;" >We have an error to update this password <br> Try it again</b>' ;
        $response_message_success = 'Your Password Successfully Updated' ;
        try
        {
            $result_run_change_password_form = user::run_change_password_form(Auth::id(), Auth::user()->name, Hash::make($request->new_password)) ;
            if(!$result_run_change_password_form)
            {
                return Responses::failed('show_change_password_form' , '' , $response_message_failed ) ;
            }
            return Responses::success('show_change_password_form' , '' , $response_message_success ) ;
        }
        catch (\Exception $exception )
        {
            return Responses::failedWithException('show_change_password_form' , '' , $response_message_failed , $exception) ;
        }
    }
}