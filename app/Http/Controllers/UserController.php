<?php
namespace App\Http\Controllers;

use App\Http\Requests\UsersUpdateGroupRequest;
use App\Http\Requests\UsersUpdatePasswordRequest;
use App\Http\Requests\UsersUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use mysql_xdevapi\Session;
use phpDocumentor\Reflection\DocBlock\Tags\Uses;
use Hash;
use App\Responses\Responses ;
// https://stackoverflow.com/questions/32718870/how-to-get-all-input-of-post-in-laravel

class UserController extends Controller
{
    public function editGroup()
    {
        try
        {
            return view('back.users_edit_group' , [ 'title_of_page' => 'Management Users of '.__('general.Name of software') , 'result_of_all_users_related_to_this_super_admin' =>  User::allUsersRelatedToThisSuperAdmin() ]);
        }
        catch (\Exception $exception)
        {
            return Responses::failedWithException('home' , '' , '<b style="color:blue;" >We have an error to show Management Users of Software From</b>' , $exception)  ;
        }
    }

    public function updateGroup(UsersUpdateGroupRequest $request)
    {
        $request_validated    = $request->validated();
        $decrypted_id_of_user = encryptDecrypt('decrypt' , $request_validated['id_of_user']);
        $extra_message        = ' for <b style="color:blue;" >'.$request_validated['name_of_user'].'</b>' ;
        [$options_for_user,$financial_management,$gap_time_between_appointments,$cms_menu_title,$common_drug,$success_message,$failed_message] = $this->prepareVariableOfUpdate($request_validated);

        try
        {
            if(! User::updateMainSettingsOfSoftwareFormForSuperAdmin($decrypted_id_of_user , $request_validated['name_of_user'] , $common_drug , $request_validated['common_diet'] , $request_validated['common_return_date'] , $request_validated['phone_number'] , $request_validated['college_branch'] , $request_validated['contact_address'] , $request_validated['common_hypersensitivity'] , $options_for_user, $cms_menu_title, $gap_time_between_appointments, $request_validated['clinic_doctors_name'] , $request_validated['status_of_user'] , $request_validated['level_of_user'] , $financial_management ))
            {
                return Responses::failed('users.edit.group' , '' , $failed_message ) ;
            }
            return Responses::success('users.edit.group' , '' , $success_message.$extra_message ) ;
        }
        catch (\Exception $exception)
        {
            return Responses::failedWithException('users.edit.group' , '' , $failed_message.$extra_message , $exception) ;
        }
    }

    public function edit()
    {
        try
        {
            $result_fetch_main_settings_of_software_form = User::fetchMainSettingsOfSoftwareFormData() ;
            if(!$result_fetch_main_settings_of_software_form)
            {
                return Responses::failed('home', '' , '<b style="color:blue;">We have an error to show main settings of software</b>' ) ;
            }

            return view('back.users_edit' ,
            [
                'title_of_page'                              => 'Main Settings of Software' ,
                'result_show_main_settings_of_software_form' => $result_fetch_main_settings_of_software_form
            ]);
        }
        catch (\Exception $exception)
        {
            return Responses::failedWithException('home', '' , '<b style="color:blue;" >We have an error to show main settings of software</b>' , $exception ) ;
        }
    }

    public function update(UsersUpdateRequest $request)
    {
        $request_validated = $request->validated();
        [$options_for_user,$financial_management,$gap_time_between_appointments,$cms_menu_title,$common_drug,$success_message,$failed_message] = $this->prepareVariableOfUpdate($request_validated);

        try
        {
            if(! User::updateMainSettingsOfSoftwareForm( $common_drug , $request_validated['common_diet'] , $request_validated['common_return_date'] , $request_validated['phone_number'] , $request_validated['college_branch'] , $request_validated['contact_address'] , $request_validated['common_hypersensitivity'] , $options_for_user, $cms_menu_title, $gap_time_between_appointments, $request_validated['clinic_doctors_name'] , $financial_management ))
            {
                return Responses::failed('users.edit' , '' , $failed_message ) ;
            }
            return Responses::success('users.edit' , '' , $success_message ) ;
        }
        catch (\Exception $exception)
        {
            return Responses::failedWithException('users.edit' , '' , $failed_message , $exception) ;
        }
    }

    public function showLogs()
    {
        try
        {
            $data_of_log_file = $this->prepareDataLogFile();
            return view('back.users_logs' ,
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

    public function editPassword()
    {
        return view('back.users_edit_password', ['title_of_page' => 'Change Password']);
    }

    public function updatePassword(UsersUpdatePasswordRequest $request)
    {
        $request_validated        = $request->validated() ;
        $response_message_failed  = '<b style="color:blue;">We have an error to update this password<br>Try it again</b>' ;
        $response_message_success = 'Your Password Successfully Updated' ;
        try
        {
            if(!user::runChangePasswordForm(Hash::make($request_validated['new_password'])))
            {
                return Responses::failed('users.edit.password' , '' , $response_message_failed ) ;
            }
            return Responses::success('users.edit.password' , '' , $response_message_success ) ;
        }
        catch (\Exception $exception )
        {
            return Responses::failedWithException('users.edit.password' , '' , $response_message_failed , $exception) ;
        }
    }

    public function makeBanOrActiveThisUserId($name_of_user , $id_of_user , $action)
    {
        return User::makeBanOrActiveThisUserIdByUpdateHisStatus($name_of_user , $id_of_user , $action) ;
    }

    public function prepareDataLogFile()
    {
        $data_of_log_file = '' ;
        if(File::exists(storage_path('logs\laravel.log')))
        {
            $data_of_log_file = File::get(storage_path('logs\laravel.log')) ;
        }
        return $data_of_log_file ;
    }

    public function prepareVariableOfGapTimeBetweenAppointments($request_gap_time_between_appointments)
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

    public function prepareVariableOfOptionsForUser($money_console_status)
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
    public function removeExtraWordsFromFinancialManagementVariable($request_financial_management)
    {
        return str_replace([".","/","|","+","-"], "", $request_financial_management );
    }

    public function prepareCmsMenuTitle($request_validated)
    {
        return $request_validated['cms_menu_title_0']
        . ',' . $request_validated['cms_menu_title_1']
        . ',' . $request_validated['cms_menu_title_2']
        . ',' . $request_validated['cms_menu_title_3']
        . ',' . $request_validated['cms_menu_title_4']
        . ',' . $request_validated['cms_menu_title_5']
        . ','
        . ',' . $request_validated['cms_menu_title_7']
        . ',' . $request_validated['cms_menu_title_8']
        . ',' . $request_validated['cms_menu_title_9']
        . ',' . $request_validated['cms_menu_title_10']
        . ',' . $request_validated['cms_menu_title_11']
        . ',' . $request_validated['cms_menu_title_12']
        . ',' . $request_validated['cms_menu_title_13']
        . ',' . $request_validated['cms_menu_title_14']
        . ',' . $request_validated['cms_menu_title_15']
        . ',' . $request_validated['cms_menu_title_16']
        . ',' . $request_validated['cms_menu_title_17']
        . ',' . $request_validated['cms_menu_title_18']
        . ',' . $request_validated['cms_menu_title_19']
        . ',' . $request_validated['cms_menu_title_20']
        . ',' . $request_validated['cms_menu_title_21']
        . ',' . $request_validated['cms_menu_title_22']
        . ',' . $request_validated['cms_menu_title_23']
        . ',' . $request_validated['cms_menu_title_24']
        . ',' . $request_validated['cms_menu_title_25']
        . ',' . $request_validated['cms_menu_title_26']
        . ',' . $request_validated['cms_menu_title_27']
        . ',' . $request_validated['cms_menu_title_28'] ;
    }

    public function prepareVariableOfUpdate($request_validated)
    {
        $options_for_user              = $this->prepareVariableOfOptionsForUser($request_validated['money_console_status']) ;
        $financial_management          = $this->removeExtraWordsFromFinancialManagementVariable($request_validated['financial_management']) ;
        $gap_time_between_appointments = $this->prepareVariableOfGapTimeBetweenAppointments($request_validated['gap_time_between_appointments']) ;
        $cms_menu_title                = $this->prepareCmsMenuTitle($request_validated) ;
        $common_drug                   = str_replace(" ", "_", $request_validated['common_drug']);
        $success_message               = 'The New Settings of Software Successfully Updated' ;
        $failed_message                = '<b style="color:blue;" >We have an error to update New Settings of Software</b>' ;
        return [$options_for_user,$financial_management,$gap_time_between_appointments,$cms_menu_title,$common_drug,$success_message,$failed_message] ;
    }
}