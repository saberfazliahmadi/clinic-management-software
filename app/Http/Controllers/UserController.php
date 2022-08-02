<?php
namespace App\Http\Controllers;

use App\Http\Requests\run_change_password_formRequest;
use App\Http\Requests\update_show_main_settings_of_software_formRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use mysql_xdevapi\Session;
use phpDocumentor\Reflection\DocBlock\Tags\Uses;
use Hash;
use Illuminate\Database\QueryException;
use App\Responses\Responses ;
// MANUALLY RECEIVING DATA FROM A FORM BY GET OR POST METHOD AND USE IT IN YOUR CUSTOMIZE FUNCTIONS.
// https://stackoverflow.com/questions/32718870/how-to-get-all-input-of-post-in-laravel
/** In this controller according to Single Responsibility and Open-Closed Principles of SOLID
we validate user inputs by Middleware **/
class UserController extends Controller
{
    public static function make_ban_or_active_this_user_id( $name_of_user , $id_of_user , $action )
    {
        return User::make_ban_or_active_this_user_id($name_of_user , $id_of_user , $action) ;
    }

    public function show_management_users_of_software_form()
    {
        $data_of_log_file = '' ;
        if(File::exists(storage_path('logs\laravel.log')))
        {
            $data_of_log_file = File::get(storage_path('logs\laravel.log')) ;
        }

        try
        {
            $result_of_all_users_related_to_this_super_admin = User::all_users_related_to_this_super_admin() ;
            return view('back.show_management_users_of_software_form' ,
            [
                'title_of_page'                                   => 'Management Users of '.__('general.Name of software') ,
                'result_of_all_users_related_to_this_super_admin' => $result_of_all_users_related_to_this_super_admin ,
                'log_data'                                        => $data_of_log_file ,
            ]);
        }
        catch (QueryException $exception)
        {
            return Responses::FailedWithException('home' , '' , '<b style="color:blue;" >We have an error to show Management Users of Software From</b>' , $exception)  ;
        }
    }

    public function show_main_settings_of_software_form()
    {
        try
        {
            $result_show_main_settings_of_software_form = User::show_main_settings_of_software_form(Auth::user()->id, Auth::user()->name) ;

            if(!$result_show_main_settings_of_software_form)
            {
                return Responses::Failed('home', '' , '<b style="color:blue;" >We have an error to show main settings of software</b>' ) ;
            }
            return view('back.show_main_settings_of_software_form' ,
            [
                'title_of_page'                              => 'Main Settings of Software' ,
                'result_show_main_settings_of_software_form' => $result_show_main_settings_of_software_form
            ]);
        }
        catch (QueryException $exception)
        {
            return Responses::FailedWithException('home', '' , '<b style="color:blue;" >We have an error to show main settings of software</b>' , $exception ) ;
        }
    }

    public function prepare_variable_of_gap_time_between_appointments($request_gap_time_between_appointments)
    {
        // Remove space from gap time variable
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
        $options_for_user = serialize($options_for_user);
        return $options_for_user ;
    }

    public function validation_of_financial_management_variable($request_post_financial_management)
    {
        $financial_management_revealed_errors = '' ;
        // If ADMIN typed something for financial management service
        if ($request_post_financial_management ==! '')
        {
            // Check all financial items to be eligible
            // Each of financial transaction items should have number & character & ':'
            $exploded_values = explode(',', $request_post_financial_management);
            foreach ($exploded_values as $financial_item)
            {
                // Check all require conditions that financial items should have
                if (! (strpos($financial_item, ':') && strlen($financial_item) > 2 && preg_match('/[A-Za-z]/', $financial_item) && preg_match('/[0-9]/', $financial_item)))
                {
                    $financial_management_revealed_errors .= ' '.$financial_item ;
                }
            }
        }
        return $financial_management_revealed_errors ;
    }

    // Remove some extra words from financial items
    public function remove_extra_words_from_financial_management_variable($request_financial_management)
    {
        return str_replace([".","/","|","+","-"], "", $request_financial_management );
    }

    public function update_show_main_settings_of_software_form(update_show_main_settings_of_software_formRequest $request)
    {
        /** Check the $request->financial_management
        and then if we have some errors on $financial_management_revealed_errors then show it **/
        $financial_management_revealed_errors = $this->validation_of_financial_management_variable($request->financial_management) ;
        if( $financial_management_revealed_errors !== '' )
        {
            return Responses::Failed( 'back_to_previous_page' , '' , '<b>Financial Type Error</b><br><b style="color:red;">'.$financial_management_revealed_errors.' is wrong</b><br><b style="color:blue;" >At least type 3 characters followed by this type <br> Service Name : Service Amount</b><br>Remember, each service type should have this character <b style="color:blue;" >:</b>' ) ;
        }

        $financial_management = $this->remove_extra_words_from_financial_management_variable($request->financial_management) ;

        $gap_time_between_appointments = $this->prepare_variable_of_gap_time_between_appointments($request->gap_time_between_appointments) ;

        $clinic_doctors_name     = $request->clinic_doctors_name;
        $common_hypersensitivity = $request->common_hypersensitivity;
        $common_drug             = str_replace(" ", "_", $request->common_drug);
        $common_diet             = $request->common_diet;
        $common_return_date      = $request->common_return_date;
        $phone_number            = $request->phone_number;
        $college_branch          = $request->college_branch;
        $contact_address         = $request->contact_address;
        $money_console_status    = $request->money_console_status;
        $cms_menu_title_28 = $request->cms_menu_title_28;
        $cms_menu_title_27 = $request->cms_menu_title_27;
        $cms_menu_title_26 = $request->cms_menu_title_26;
        $cms_menu_title_25 = $request->cms_menu_title_25;
        $cms_menu_title_24 = $request->cms_menu_title_24;
        $cms_menu_title_23 = $request->cms_menu_title_23;
        $cms_menu_title_22 = $request->cms_menu_title_22;
        $cms_menu_title_21 = $request->cms_menu_title_21;
        $cms_menu_title_20 = $request->cms_menu_title_20;
        $cms_menu_title_19 = $request->cms_menu_title_19;
        $cms_menu_title_18 = $request->cms_menu_title_18;
        $cms_menu_title_17 = $request->cms_menu_title_17;
        $cms_menu_title_16 = $request->cms_menu_title_16;
        $cms_menu_title_15 = $request->cms_menu_title_15;
        $cms_menu_title_14 = $request->cms_menu_title_14;
        $cms_menu_title_13 = $request->cms_menu_title_13;
        $cms_menu_title_12 = $request->cms_menu_title_12;
        $cms_menu_title_11 = $request->cms_menu_title_11;
        $cms_menu_title_10 = $request->cms_menu_title_10;
        $cms_menu_title_9 = $request->cms_menu_title_9;
        $cms_menu_title_8 = $request->cms_menu_title_8;
        $cms_menu_title_7 = $request->cms_menu_title_7;
        $cms_menu_title_6 = '';
        $cms_menu_title_5 = $request->cms_menu_title_5;
        $cms_menu_title_4 = $request->cms_menu_title_4;
        $cms_menu_title_3 = $request->cms_menu_title_3;
        $cms_menu_title_2 = $request->cms_menu_title_2;
        $cms_menu_title_1 = $request->cms_menu_title_1;
        $cms_menu_title_0 = $request->cms_menu_title_0;

        // Make cms_menu_title variable
        $cms_menu_title = $cms_menu_title_0
        . ',' . $cms_menu_title_1
        . ',' . $cms_menu_title_2
        . ',' . $cms_menu_title_3
        . ',' . $cms_menu_title_4
        . ',' . $cms_menu_title_5
        . ',' . $cms_menu_title_6
        . ',' . $cms_menu_title_7
        . ',' . $cms_menu_title_8
        . ',' . $cms_menu_title_9
        . ',' . $cms_menu_title_10
        . ',' . $cms_menu_title_11
        . ',' . $cms_menu_title_12
        . ',' . $cms_menu_title_13
        . ',' . $cms_menu_title_14
        . ',' . $cms_menu_title_15
        . ',' . $cms_menu_title_16
        . ',' . $cms_menu_title_17
        . ',' . $cms_menu_title_18
        . ',' . $cms_menu_title_19
        . ',' . $cms_menu_title_20
        . ',' . $cms_menu_title_21
        . ',' . $cms_menu_title_22
        . ',' . $cms_menu_title_23
        . ',' . $cms_menu_title_24
        . ',' . $cms_menu_title_25
        . ',' . $cms_menu_title_26
        . ',' . $cms_menu_title_27
        . ',' . $cms_menu_title_28;

        $options_for_user = $this->prepare_variable_of_options_for_user($money_console_status) ;

        $success_message = 'The New Settings of Software Successfully Updated' ;
        $failed_message  = '<b style="color:blue;" >We have an error to update New Settings of Software</b>' ;
        $extra_message   = ' for <b style="color:blue;" >'.$request->name_of_user.'</b>' ;
        $decrypted_id_of_user = encrypt_decrypt( 'decrypt' , $request->id_of_user) ;

        try
        {
            // If the request was from Route => update_user_info_by_super_admin
            if( $request->route()->getName() === 'update_user_info_by_super_admin')
            {
                $result_update_main_settings_of_software_form = User::update_main_settings_of_software_form_for_super_admin( $decrypted_id_of_user , $request->name_of_user , $common_drug , $common_diet , $common_return_date ,$phone_number,$college_branch,$contact_address,$common_hypersensitivity,$options_for_user,$cms_menu_title,$gap_time_between_appointments,$clinic_doctors_name , $request->status_of_user , $request->level_of_user , $financial_management ) ;
                if(!$result_update_main_settings_of_software_form)
                {
                    return Responses::Failed('show_management_users_of_software_form' , '' , $failed_message ) ;
                }
                return Responses::Success('show_management_users_of_software_form' , '' , $success_message.$extra_message ) ;
            }

            // If the request was from Route => update_show_main_settings_of_software_form
            $result_update_main_settings_of_software_form = User::update_main_settings_of_software_form( $decrypted_id_of_user , $request->name_of_user , $common_drug , $common_diet , $common_return_date ,$phone_number,$college_branch,$contact_address,$common_hypersensitivity,$options_for_user,$cms_menu_title,$gap_time_between_appointments,$clinic_doctors_name, $financial_management ) ;
            if(!$result_update_main_settings_of_software_form)
            {
                return Responses::Failed('show_main_settings_of_software_form' , '' , $failed_message ) ;
            }
            return Responses::Success('show_main_settings_of_software_form' , '' , $success_message ) ;
        }
        catch (QueryException $exception)
        {
            if( $request->route()->getName() === 'update_user_info_by_super_admin')
            {
                return Responses::FailedWithException('show_management_users_of_software_form' , '' , $failed_message.$extra_message , $exception) ;
            }
            return Responses::FailedWithException('show_main_settings_of_software_form' , '' , $failed_message , $exception) ;
        }
    }

    public function show_change_password_form()
    {
        return view('back.show_change_password_form', ['title_of_page' => 'Change Password']);
    }

    public function run_change_password_form( run_change_password_formRequest $request )
    {
        // The entered current password does not matches with Auth::user()->password
        if (!( Hash::check($request->current_password, Auth::user()->password) ))
        {
            return Responses::Failed('show_change_password_form' , '' , '<b style="color:blue;" >The current password you entered does not matches with your password <br> Try it again</b>' ) ;
        }
        // The entered current password does not matches Re-EnterPassword
        if( $request->new_password !== $request->retype_new_password )
        {
            return Responses::Failed('show_change_password_form' , '' , '<b style="color:blue;" >Your News Password is NOT EQUAL to Re-Type the New Password <br> Try it again</b>' ) ;
        }

        $response_message_failed = '<b style="color:blue;" >We have an error to update this password <br> Try it again</b>' ;
        $response_message_success = 'Your Password Successfully Updated' ;
        try
        {
            $result_run_change_password_form = user::run_change_password_form(Auth::user()->id, Auth::user()->name, Hash::make($request->new_password)) ;
            if(!$result_run_change_password_form)
            {
                return Responses::Failed('show_change_password_form' , '' , $response_message_failed ) ;
            }
            return Responses::Success('show_change_password_form' , '' , $response_message_success ) ;
        }
        catch ( QueryException $exception )
        {
            return Responses::FailedWithException('show_change_password_form' , '' , $response_message_failed , $exception) ;
        }
    }
}