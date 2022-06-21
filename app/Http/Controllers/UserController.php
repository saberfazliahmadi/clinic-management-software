<?php

namespace App\Http\Controllers;

use App\Http\Requests\run_change_password_formRequest;
use App\Http\Requests\update_show_main_settings_of_software_formRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use mysql_xdevapi\Session;
use phpDocumentor\Reflection\DocBlock\Tags\Uses;
use Hash;

// START OF MANUALLY RECEIVING DATA FROM A FORM BY GET OR POST METHOD AND USE IT IN YOUR CUSTOMIZE FUNCTIONS.
// https://stackoverflow.com/questions/32718870/how-to-get-all-input-of-post-in-laravel
// step(1) add this use to top of your controller page after the name space.
// use Illuminate\Http\Request ;
// step(2) write your function with this structure
//    public function function_name( Request $request )
//    {
//        //
//    }
// step(3) use below codes in it.
//// Show only POST data
//$request->post(); // DI
//request()->post(); // global method
//Request::post(); // facade
//
//// Show only GET data
//$request->query(); // DI
//request()->query(); // global method
//Request::query(); // facade
//
//// Show all data (i.e. both GET and POST data)
//$request->all(); // DI
//request()->all(); // global method
//Request::all(); // facade
// END OF MANUALLY RECEIVING DATA FROM A FORM BY GET OR POST METHOD AND USE IT IN YOUR CUSTOMIZE FUNCTIONS.

class UserController extends Controller
{
    public function show_main_settings_of_software_form()
    {
        try
        {
            $result_show_main_settings_of_software_form = User::show_main_settings_of_software_form(Auth::user()->id, Auth::user()->name) ;

            if(!$result_show_main_settings_of_software_form)
            {
                return redirect(route('home'))
                ->with(['success_message' => '<b style="color:blue;" >We have an error to show main settings of software</b>']);
            }
            return view('back.show_main_settings_of_software_form' ,
            [
                'title_of_page'                              => 'Main Settings of Software' ,
                'result_show_main_settings_of_software_form' => $result_show_main_settings_of_software_form
            ]);
        }
        catch (\Exception $exception)
        {
            return redirect(route('home'))
            ->with(['success_message' => '<b style="color:blue;" >We have an error to show main settings of software</b>']);
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
        // the acceptable gap time range
        elseif ($gap_time_between_appointments >= 5 && $gap_time_between_appointments <= 60 && is_numeric($gap_time_between_appointments))
        {
            $gap_time_between_appointments = $gap_time_between_appointments ;
        }
        // the default gap time
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

    public function update_show_main_settings_of_software_form(update_show_main_settings_of_software_formRequest $request)
    {
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
        
        try
        {
            $result_update_main_settings_of_software_form = User::update_main_settings_of_software_form(Auth::user()->id, Auth::user()->name,$common_drug,$common_diet,$common_return_date,$phone_number,$college_branch,$contact_address,$common_hypersensitivity,$options_for_user,$cms_menu_title,$gap_time_between_appointments,$clinic_doctors_name) ;

            if($result_update_main_settings_of_software_form)
            {
                return redirect(route('show_main_settings_of_software_form'))
                ->with(['success_message' => 'The New Settings of Software Successfully Updated']);
            }
            return redirect(route('show_main_settings_of_software_form'))
            ->with(['success_message' => '<b style="color:blue;" >We have an error to update New Settings of Software</b>']);
        }
        catch (\Exception $exception)
        {
            return redirect(route('show_main_settings_of_software_form'))
            ->with(['success_message' => '<b style="color:blue;" >We have an error to update New Settings of Software</b>']);
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
            return redirect(route('show_change_password_form'))
            ->with(['success_message' => '<b style="color:blue;" >The current password you entered does not matches with your password <br> Try it again</b>']);
        }

        if( $request->new_password !== $request->retype_new_password )
        {
            return redirect(route('show_change_password_form'))
            ->with(['success_message' => '<b style="color:blue;" >Your News Password is NOT EQUAL to Re-Type the New Password <br> Try it again</b>']);
        }

        try
        {
            $result_run_change_password_form = user::run_change_password_form(Auth::user()->id, Auth::user()->name, Hash::make($request->new_password)) ;

            if(!$result_run_change_password_form)
            {
                return redirect(route('show_change_password_form'))
                ->with(['success_message' => '<b style="color:blue;" >We have an error to update this password <br> Try it again</b>']);
            }
            return redirect(route('show_change_password_form'))
            ->with(['success_message' => 'Your Password Successfully Updated']);
        }
        catch ( \Exception $exception )
        {
            return redirect(route('show_change_password_form'))
            ->with(['success_message' => '<b style="color:blue;" >We have an error to update this password <br> Try it again</b>']);
        }
    }
}