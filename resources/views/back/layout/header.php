<?php
use Illuminate\Support\Facades\Auth;
echo '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>'.$title_of_page.'</title>

    <!-- Bootstrap -->
    <link href="'.url('back/vendors/bootstrap/dist/css/bootstrap.min.css').'" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="'.url('back/vendors/font-awesome/css/font-awesome.min.css').'" rel="stylesheet">
    <!-- NProgress -->
    <link href="'.url('back/vendors/nprogress/nprogress.css').'" rel="stylesheet">
    <!-- iCheck -->
    <link href="'.url('back/vendors/iCheck/skins/flat/green.css').'" rel="stylesheet">
    <!-- bootstrap-progressbar -->
    <link href="'.url('back/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css').'" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="'.url('back/build/css/custom.min.css" rel="stylesheet').' " >
    '.$extra_links_header.'
</head>

<style  type="text/css" >' ;

/*
    If the language set to 'locale' => 'fa'
    in config/app.php then add persian font-family: 'IRANSansNums'
*/
if( app()->getLocale() === 'fa' )
{
    echo '
    @font-face 
    {
        font-family: \'IRANSansNums\';
        font-style: normal;
        font-weight: normal;
        src: url(\''.url('back/font/ir/iransans/IRANSansWeb(FaNum).eot').'\');
        src: url(\''.url('back/font/ir/iransans/IRANSansWeb(FaNum).eot?#iefix').'\') format(\'embedded-opentype\'),  /* IE6-8 */
        url(\''.url('back/font/ir/iransans/IRANSansWeb(FaNum).woff2').'\') format(\'woff2\'),  /* FF39+,Chrome36+, Opera24+*/
        url(\''.url('back/font/ir/iransans/IRANSansWeb(FaNum).woff').'\') format(\'woff\'),  /* FF3.6+, IE9, Chrome6+, Saf5.1+*/
        url(\''.url('back/cdn/font/ir/iransans/IRANSansWeb(FaNum).ttf').'\') format(\'truetype\');
    }
    
    body,h1,h2,h3,h4,h5,h6,p,a,li
    {
        font-family: IRANSansNums, Tahoma, Roboto, Arial, "Droid Sans", sans-serif!important;
    }' ;
}

echo '
button, .buttons, .modal-footer .btn+.btn
{
    margin-bottom: 0px!important;
    margin-right: 0px!important;
}

.btn-default
{
    border: 1px solid #F7F7F7;
}

.btn-default.hover
{
    border: 1px solid #169F85;
    border-radius: 4px!important;
}

span.multiselect-native-select select
{
    border: 0!important;
    clip: rect(0 0 0 0)!important;
    height: 1px!important;
    margin: -1px -1px -1px -3px!important;
    overflow: hidden!important;
    padding: 0!important;
    position: absolute!important;
    width: 1px!important;
}

.checkbox
{
    font-size: 18px;
    cursor:pointer!important;
}

label
{
    cursor:pointer!important;
}

.fancybox-close
{
    zoom: 1.75!important;
    right: -21px!important;
    top: -1px!important;
}
</style>

<body class="nav-md" style="background: #F7F7F7!important;" >

    <div class="container body">
        <div class="main_container">
            <div class="col-md-3 left_col" >
                <div class="left_col scroll-view" style="width:100%;" >
                    
                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu" >
                        <div class="menu_section" >
                            <ul class="nav side-menu" >
                            
                                <li>
                                    <a href="#search_form" id="various222" style="font-size: 16px!important;font-weight:bolder;" >                              
                                        <span class="glyphicon glyphicon-search" aria-hidden="true" style="float:left;margin-top:15px;color: #E7E7E7;font-weight: bolder!important;margin-top:0px;" ></span>
                                        &nbsp;&nbsp;' . $cms_menu_title_data_from_middleware[14] . '
                                    </a>
                                </li>
                                
                                <li>
                                    <a href="'.route('submit_new_patient_form').'" style="font-size: 16px!important;font-weight:bolder;" >
                                        <span class="glyphicon glyphicon-plus" aria-hidden="true" style="float:left;margin-top:15px;color: #E7E7E7;font-weight: bolder!important;margin-top:0px;" ></span>
                                        &nbsp;&nbsp;' . $cms_menu_title_data_from_middleware[15] . '
                                    </a>
                                </li>
                                
                            </ul>
                        </div>
                    </div>
                    <!-- /sidebar menu -->
                    
                    <!-- START of login fancy console panel search_form -->
                    <div style="display:none;" >
                    <div id="search_form" style="overflow:scroll;width:100%!important;height:650px;overflow-x: hidden;" >
                    
                    
                        <form method="post" action="'.route('run_patient_search_form').'" id="medical-file-form" data-parsley-validate style="padding-left:50px;padding-right:50px;"  >
                            <input type="hidden" name="_token" value="'.csrf_token().'" >
                            
                            <center>
                                <h4 class="col-md-12 col-sm-12 col-xs-12 text-center" align="center" style="margin-top:40px;" >
                                    <div class="col-md-12 col-sm-12 col-xs-12 text-center" align="center" >
                                        Your searching word should be based on just <b>1</b> of the below types
                                    </div>
                                    <hr style="width:1px;" >
                                    
                                    <div class="col-md-2 col-sm-2 col-xs-2" style="float:left;" >
                                        <i class="glyphicon glyphicon-user" aria-hidden="true" style="font-size:26px;margin-left: 10px;margin-right: 10px;" ></i>
                                        <br>
                                        Name
                                    </div>
                                    <div class="col-md-2 col-sm-2 col-xs-2" style="float:left;" >
                                        <i class="glyphicon glyphicon-user" aria-hidden="true" style="font-size:26px;margin-left: 10px;margin-right: 10px;" ></i>
                                        <br>
                                        Family
                                    </div>
                                    <div class="col-md-2 col-sm-2 col-xs-2" style="float:left;" >
                                        <i class="glyphicon glyphicon-phone" aria-hidden="true" style="font-size:26px;margin-left: 10px;margin-right: 10px;" ></i>
                                        <br>
                                        Mobile Number
                                    </div>
                                    <div class="col-md-3 col-sm-3 col-xs-3" style="float:left;" >
                                        <i class="glyphicon glyphicon-credit-card" aria-hidden="true" style="font-size:26px;margin-left: 10px;margin-right: 10px;" ></i>
                                        <br>
                                        Nationality Number
                                    </div>
                                    
                                    <div class="col-md-3 col-sm-3 col-xs-3" style="float:left;" >
                                        <i class="glyphicon glyphicon-file" aria-hidden="true" style="font-size:26px;margin-left: 10px;margin-right: 10px;" ></i>
                                        <br>
                                        Patient Number
                                    </div>
                                    
                                </h4>
                                
                                <hr style="width:1px;" >
                                <div class="col-md-12 col-sm-12 col-xs-12" align="center" style="float:none;" >
                                    <input type="text" name="search_text" style="text-align: left!important;float:none;" min="1" max="60" autocomplete="off" aria-autocomplete="list" aria-expanded="false" aria-haspopup="true" role="combobox" spellcheck="false" class="form-control" placeholder="Type your searching word based on ONE of these types: Name | Family | Mobile Number | Nationality Number | Patient Number" align="center" required >
                                </div>
                                
                            </center>
                
                            <button type="submit" name="Search" class="btn btn-success btn-lg btn-block uiuxtrick" style="font-size:28px;position: fixed;bottom: 0px;right: 0px;z-index: 1;margin-bottom:0px;margin-right:0px;" onclick="this.disabled=true;this.form.submit();" >
                                <i class="fa fa-search" aria-hidden="true"></i> Search
                            </button>
                        </form>
                        
                    
                    </div>
                    </div>
                    <!-- END of login fancy console panel search_form -->
                    
                </div>
            </div>
    
            <!-- top navigation -->
            <div class="top_nav">
                <div class="nav_menu" style="background:none;border-bottom:0px;margin-bottom:20px;">
                    <nav>
                        <div class="nav toggle">
                            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                        </div>
    
                        <ul class="nav navbar-nav navbar-right">
                       
                            <li>
                                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <span class="glyphicon glyphicon-option-vertical" style="font-size: 17pt;"></span>
                                </a>
                                <ul class="dropdown-menu dropdown-usermenu pull-right">
                                
                                    <li style="border-bottom:1px solid #bfbdbd;padding-bottom:7px;" >
                                        <span style="float:left;margin-top:15px;margin-left:15px;" >
                                            <a href="'.route('home').'" style="color:gray;" >
                                                <span class="fa fa-user-md" aria-hidden="true" style="float:left;font-size:26px;margin-left:0px;"></span>
                                                ' . $cms_menu_title_data_from_middleware[17] . ' '.ucwords(Auth::user()->name).'
                                            </a>
                                        </span>
                                    </li>
                                    
                                    <li>
                                        <span style="float:left;margin-top:15px;margin-left:15px;" >
                                            <a href="'.route('show_form_of_appointments_on_specific_date').'">
                                                <span class="fa fa-list" aria-hidden="true" style="float:left;font-size:26px;margin-left:0px;"></span>
                                                ' . $cms_menu_title_data_from_middleware[18] . '
                                            </a>
                                        </span>
                                    </li>
                                    
                                    <li>
                                        <span style="float:left;margin-top:15px;margin-left:15px;" >
                                            <a href="'.route('show_form_of_appointments_on_specific_date').'">
                                                <span class="glyphicon glyphicon-envelope" aria-hidden="true" style="float:left;font-size:26px;margin-left:0px;"></span>
                                                ' . $cms_menu_title_data_from_middleware[19] . '
                                            </a>
                                        </span>
                                    </li>
                                    
                                    <li>
                                        <span style="float:left;margin-top:15px;margin-left:15px;" >
                                            <a href="'.route('show_financial_management_main_page').'">
                                                <span class="fa fa-money" aria-hidden="true" style="float:left;font-size:26px;margin-left:0px;"></span>
                                                ' . $cms_menu_title_data_from_middleware[20] . '
                                            </a>
                                        </span>
                                    </li>
                                    
                                    <li>
                                        <span style="float:left;margin-top:15px;margin-left:15px;" >
                                            <a href="'.route('show_change_password_form').'" >
                                                <span class="fa fa-lock" aria-hidden="true" style="float:left;font-size:26px;margin-left:0px;"></span>
                                                &nbsp;&nbsp;' . $cms_menu_title_data_from_middleware[24] . '
                                            </a>
                                        </span>
                                    </li>' ;

                                    // If the user has a upper level of global.admin_level then show route show_main_settings_of_software_form to him
                                    if( Auth::user()->user_level >= config('global.admin_level') )
                                    {
                                        echo '
                                        <li>
                                            <span style="float:left;margin-top:15px;margin-left:15px;" >
                                                <a href="'.route('show_main_settings_of_software_form').'">
                                                    <span class="fa fa-cog" aria-hidden="true" style="float:left;font-size:26px;margin-left:0px;"></span>
                                                    &nbsp;' . $cms_menu_title_data_from_middleware[25] . '
                                                </a>
                                            </span>
                                        </li>' ;
                                    }

                                    // If the user has a upper level of global.super_admin_level then show route show_main_settings_of_software_form to him
                                    if( Auth::user()->user_level >= config('global.super_admin_level') )
                                    {
                                        echo '
                                        <li>
                                            <span style="float:left;margin-top:15px;margin-left:15px;" >
                                                <a href="'.route('show_management_users_of_software_form').'">
                                                    <span class="glyphicon glyphicon-user" aria-hidden="true" style="float:left;font-size:24px;margin-left:0px;"></span>
                                                    Users Management
                                                </a>
                                            </span>
                                        </li>
                                        <li>
                                            <span style="float:left;margin-top:15px;margin-left:15px;" >
                                                <a href="'.route('show_users_activities_logs').'">
                                                    <span class="fa fa-align-left" aria-hidden="true" style="float:left;font-size:24px;margin-left:0px;"></span>
                                                    Users Activities Logs
                                                </a>
                                            </span>
                                        </li>' ;
                                    }

                                    echo '
                                    <li>
                                        <span style="float:left;margin-top:15px;margin-left:15px;" >
                                            <a href="'.route('home').'">
                                                <span class="fa fa-users" aria-hidden="true" style="float:left;font-size:26px;margin-left:0px;"></span>
                                                ' . $cms_menu_title_data_from_middleware[26] . '
                                            </a>
                                        </span>
                                    </li>
                                    
                                    <li>
                                        <span style="float:left;margin-top:15px;margin-left:15px;" >
                                            <a href="'.route('home').'">
                                                <span class="fa fa-question" aria-hidden="true" style="float:left;font-size:26px;margin-left:0px;"></span>
                                                &nbsp;&nbsp;&nbsp;&nbsp;' . $cms_menu_title_data_from_middleware[27] . '
                                            </a>
                                        </span>
                                    </li>
                                    <br>
                                    
                                    <li style="margin-top:15px;" >
                                        <span class="fa fa-sign-out pull-left" aria-hidden="true" style="float:left;font-size:26px;margin-left:0px;padding-left:15px;padding-right:19px;"></span>
                                        <form method="POST" action="'.route('logout').'" >
                                            <input type="hidden" name="_token" value="'.csrf_token().'" >
                                            <input type="hidden" name="_method" value="POST" >
                                            <input type="submit" name="logout" value="' . $cms_menu_title_data_from_middleware[28] . '" class="btn btn-success" >
                                        </form>
                                    </li>
                                    
                                </ul>
                            </li>
                            
                            <li role="presentation">
                                <a id="various222" href="#today_turn_res" class="btn-primary btn-lg" type="button" style="cursor:pointer;color:gray!important;background-color:#F7F7F7!important;border:1px solid #bfbdbd;font-size:14px;padding:0px 5px 0px 5px;margin-top:11px;margin-right:10px;">' ;

                                    if( $count_of_appointment_in_header_for_patients_on_waiting_situation !== 0 )
                                    {
                                        echo '
                                        <span class="glyphicon glyphicon-bell" aria-hidden="true" style="margin-right:5px;" ></span>' ;
                                    }

                                    echo '
                                    <span style="font-weight:bolder;" >
                                        '.date('Y-m-d').' ' . $cms_menu_title_data_from_middleware[16] . '
                                    </span>' ;

                                    if( $count_of_appointment_in_header_for_patients_on_waiting_situation !== 0 )
                                    {
                                        echo '
                                        <span style="font-size:16px;" >
                                            ('.$count_of_appointment_in_header_for_patients_on_waiting_situation.')
                                        </span>' ;
                                    }

                                echo '
                                </a>
                                
                                <!-- START of login fancy console panel today_turn_res -->
                                <div style="display:none;" >
                                    <div id="today_turn_res" style="overflow:scroll;width:900px;height:650px;overflow-x: hidden;" >
                                    <div class="row">
                                    <div class="col-md-12">
                                    <div class="col-md-12 col-sm-12 col-xs-12">' ;

// START of If count of appointments was more than 0 for TODAY, show them.
if ( isset($count_of_appointment_in_header) && $count_of_appointment_in_header > 0 )
{
    echo '
    <form method="get" action="'.route('home').'" id="header_today_appointments" data-parsley-validate >
    <input type="hidden" name="_token" value="'.csrf_token().'" >
    <input type="hidden" name="send_patient_to_doctors_room" value="true" >
    
    <div class="col-md-2 col-sm-2 col-xs-2" style="float:right;" >
        <h2 style="color:#73879C;margin-top:12px;text-align:center;font-size:13px;line-height: inherit;" >
            Appointment Number
            Patient Attendance Status
        </h2>
        <br>
    </div>
    <div class="col-md-2 col-sm-2 col-xs-2" style="float:right;" >
        <h2 style="color:#73879C;font-size:13px;line-height: inherit;text-align:center;" >
            Time of Appointment
            <br>
            Service Type
        </h2>
    </div>
    <div class="col-md-3 col-sm-3 col-xs-3" style="float:right;" >
        <h2 style="color:#73879C;text-align:center;font-size:13px;line-height: inherit;" >
           Name
           <br>
           Mobile Number of Patient
        </h2>
        <br>
    </div>
    <div class="col-md-3 col-sm-3 col-xs-3" style="float:right;text-align:center;" >
        <h2 style="color:#73879C;font-size:13px;line-height: inherit;" >
            Name of Doctor
            <br>
            Cost of a Patient Visit
        </h2>
        <br>
    </div>
    <div class="col-md-2 col-sm-32 col-xs-2" style="font-size:13px;float:right;text-align:left;" >
        <h2 style="color:#73879C;font-size:13px;line-height: inherit;" >
            Today Date:
            <br>
            '.date('Y-m-d').'
        </h2>
        <br>
    </div>';

    // Create a variable to use on counting number of all appointments.
    $count_trick = '' ;

    // START of foreach.
    foreach ($result_middleware_provide_header_appointments_data_on_today as $key_appointment)
    {
        $encrypted_patient_id_header = encrypt_decrypt('encrypt', $key_appointment->patient_id) ;
        // Add 1 to previous value
        ++$count_trick;

        // Let to make a trick to show Good time OR Bad time for user appointment.
        if( $key_appointment->appointment_status === '1' && $key_appointment->appointment_canceling_status == 'f' )
        {
            $appointment_status_div_color_trick = '#green;' ;

            if( Auth::user()->telegram === 'true')
            { $trick_of_show_check_box = 'Approved <input type="radio" name="appointment_id" value="'.$key_appointment->appointment_id.'" class="flat" required >' ;}
            else{ $trick_of_show_check_box = '<input type="radio" name="appointment_id" value="'.$key_appointment->appointment_id.'" class="flat" required >' ; }

            $opacity_appointment_trick = '' ;
        }
        elseif( $key_appointment->appointment_status === '1' && $key_appointment->appointment_canceling_status === NULL )
        {
            $appointment_status_div_color_trick = '#orange;' ;

            if( Auth::user()->telegram === 'true')
            { $trick_of_show_check_box = 'Not Defined <input type="radio" name="appointment_id" value="'.$key_appointment->appointment_id.'" class="flat" required >' ;}
            else{ $trick_of_show_check_box = '<input type="radio" name="appointment_id" value="'.$key_appointment->appointment_id.'" class="flat" required >' ; }

            $opacity_appointment_trick = '' ;
        }
        elseif( $key_appointment->appointment_canceling_status == 't' )
        {
            $appointment_status_div_color_trick = 'red;' ;

            if( Auth::user()->telegram === 'true')
            { $trick_of_show_check_box = 'Canceled <input type="radio" name="appointment_id" value="'.$key_appointment->appointment_id.'" class="flat" required >' ; }
            else{ $trick_of_show_check_box = '<input type="radio" name="appointment_id" value="'.$key_appointment->appointment_id.'" class="flat" required >' ; }

            $opacity_appointment_trick = 'opacity: 0.5;' ;
        }
        else
        {
            $appointment_status_div_color_trick = 'black;' ;
            $trick_of_show_check_box            = '<div style="width:20px;">&nbsp;</div>' ;
            $opacity_appointment_trick 	        = 'opacity: 0.5;' ;
        }

        echo '
        <div class="col-md-12 col-sm-12 col-xs-12" style="float:right;border-bottom:1px solid #bfbdbd;margin-top:15px;" >
            <label class="col-md-2 col-sm-2 col-xs-2 form-group btn-default" style="float:right;cursor: pointer;background: #F7F7F7!important;" >
                <div class="well" style="display: table-cell;vertical-align: middle;border:1px solid #7387a7;border-radius:50%;width:68px;height:68px;float:right;text-align:center!important;background-color:#F7F7F7;box-shadow: none!important;color:'.$appointment_status_div_color_trick.$opacity_appointment_trick.'" >
                    <font size="+2" >
                        '.$count_trick.'
                    </font>
                </div>
                <div style="float:right;border:0px;background-color:#F7F7F7;box-shadow: none!important;color:'.$appointment_status_div_color_trick.'" class="well" >
                    '.$trick_of_show_check_box.'
                    <input type="hidden" name="current_date" value="'.$key_appointment->appointment_date.'" >
                </div>
                <br>
            </label>
            
            <div class="col-md-8 col-sm-8 col-xs-8 well" style="border:0px solid;padding-bottom:0px;margin-bottom:0px;padding-top:0px;margin-top:0px;float:right;background-color:#F7F7F7;box-shadow: none!important;">
            
                <div class="col-md-2 col-sm-2 col-xs-2" style="float:right;" >
                    <center>
                    <div style="float:right;margin-top:14px;font-size:15pt;color:'.$appointment_status_div_color_trick.$opacity_appointment_trick.'" >
                        
                        '.$key_appointment->appointment_time.'
                        <br>
                        <span title="'.$key_appointment->appointment_service_type.'" style="font-size:12px;">' ;
                            if(strlen($key_appointment->appointment_service_type) > 30 )
                            {
                                echo substr($key_appointment->appointment_service_type, 0, 30).'...' ;
                            }
                            else
                            {
                                echo $key_appointment->appointment_service_type ;
                            }
                        echo '
                        </span>
                         
                    </div>
                    </center>
                </div>
                
                <div class="col-md-5 col-sm-5 col-xs-5" style="font-size:15pt;float:right;color:'.$appointment_status_div_color_trick.$opacity_appointment_trick.'" >
                    <div style="float:right;margin-top:12px;" >
                        '.$key_appointment->patient_first_name.' '.$key_appointment->patient_last_name.'
                        <br>
                        '.$key_appointment->patient_mobile_number ;

                        if( Auth::user()->telegram === 'true')
                        {
                            if( $key_appointment->patient_from_external_platform_id )
                            {
                                echo '
                                <div style="float:left;font-size:13px;text-align:left;" class="col-md-12 col-sm-12 col-xs-12" >
                                    <span class="glyphicon glyphicon-ok" aria-hidden="true" ></span>
                                    Already Connected to Bot
                                </div>' ;
                            }
                            else
                            {
                                echo '
                                <a href="'.route('edit_patient_form', $encrypted_patient_id_header ).'" >
                                    <div style="float:left;font-size:13px;text-align:left;" class="col-md-12 col-sm-12 col-xs-12" >
                                        <span class="glyphicon glyphicon-remove" aria-hidden="true" ></span>
                                        NOT Connected to Bot
                                    </div>
                                </a>' ;
                            }
                        }
                    echo '
                    </div>
                </div>
                
                <div class="col-md-5 col-sm-5 col-xs-5" style="font-size:15pt;float:right;color:'.$appointment_status_div_color_trick.$opacity_appointment_trick.'" >
                    
                    <div class="col-md-12 col-sm-12 col-xs-12" style="float:right;margin-top:12px;text-align:center;" >
                        '.$key_appointment->appointment_child_dr_related_name.'
                    </div>
                    <br>' ;

                    // START of if doctor filled out financial data.
                    if( strlen($financial_management_data_in_header) > 0 )
                    {
                        echo '
                        <center>
                        <div style="float:right;margin-right:15px;margin-top:12px;" class="col-md-12 col-sm-12 col-xs-12" >
                            <select name="money_receive[]" id="dates-field2" class="multiselect-ui form-control" multiple="multiple" style="font-size:18px!important;" >';
                                // Explode and make array type variable
                                $financial_management = explode(",",$financial_management_data_in_header) ;
                                // Estimate how many index exist in this variable
                                $financial_management_number = count($financial_management);
                                // Make end number for loop
                                $end = $financial_management_number ;
                                for( $start ='0' ; $start < $end ; $start++ )
                                {
                                    if( strlen($financial_management[$start]) > 0 )
                                    {
                                        echo '
                                        <option value="'.trim(substr($financial_management[$start], strpos($financial_management[$start], ":") + 1)).'" class="col-md-12" >
                                            '.$financial_management[$start].'
                                        </option>' ;
                                    }
                                }
                            echo '
                            </select>
                       </div>
                       </center>';
                    } // END of if doctor filled out financial data.

                    echo '
                    <div class="col-md-12 col-sm-12 col-xs-12" style="float:right;text-align:center;font-size:14px;" >';
                        if($key_appointment->appointment_received_financial_status > 0)
                        {
                            echo '$'.$key_appointment->appointment_received_financial_status.'<span class="fa fa-money" aria-hidden="true" style="margin-left:5px;font-size:20px;" title="$'.$key_appointment->appointment_received_financial_status.' of This Appointment Received" ></span>' ;
                        }
                        elseif($key_appointment->appointment_status == '0' && !($key_appointment->appointment_received_financial_status > 0))
                        {
                            echo '<center><div style="font-size:16px;float:none;" title="The fee did not receive" >$<span class="glyphicon glyphicon-remove" aria-hidden="true" style="color:red;float:none;" ></span></div></center>' ;
                        }
                        else
                        {
                            echo '&nbsp;' ;
                        }
                    echo '
                    </div>
                </div>
                
            </div>
            
            <div class="col-md-2" style="padding-right:0px;padding-left:0px;margin-right:0px;margin-left:0px;margin-top:10px;" >';

                // This variable should always have a value cause it will use on route parameters
                // which is a require parameter for routing
                if( strlen($key_appointment->appointment_child_dr_related_name) > 0 )
                {
                    $trick_of_variable_appointment_child_dr_related_name = $key_appointment->appointment_child_dr_related_name ;
                }
                else
                {
                    $trick_of_variable_appointment_child_dr_related_name = 'free' ;
                }

                if( Auth::user()->user_level >= config('global.admin_level'))
                {
                    echo '
                    <div style="'.$opacity_appointment_trick.';margin-top:12px;" >
                        <a title="Display EHR Document" href="'.route('show_patients_ehr_document_page', ['patient_id' => $encrypted_patient_id_header, 'related_appointment_id' => $key_appointment->appointment_id, 'child_dr_related_name' => $trick_of_variable_appointment_child_dr_related_name]).'" style="float:left;color: white; font-size: 13px; float: left;background-color:#5A738E;border:1px solid #5A738E; " class="uiuxtrick btn btn-success" >
                            <i class="fa fa-clone"></i>
                            EHR Doc
                        </a>
                    </div>';
                }

                echo '
                <div style="'.$opacity_appointment_trick.';margin-top:12px;" >';
                    // If the patient has mobile number and active ROBOT then make link of send message by BOT.
                    if( strlen($key_appointment->patient_mobile_number) > 0  && strlen($key_appointment->patient_from_external_platform_id) > 0)
                    {
                        echo '
                        <a href="" class="uiuxtrick" style="float:left;color: white; font-size: 13px; float: left;background-color:#5A738E;border:1px solid #5A738E; " class="uiuxtrick btn btn-success" >
                            <i class="glyphicon glyphicon-envelope" aria-hidden="true" title="Send a reminder SMS with the BOT to this patient" ></i>
                        </a>';
                    }

                    echo '
                    <a href="'.route('edit_patient_form', $encrypted_patient_id_header ).'" title="Edit Patient Information" style="float:left;color: white; font-size: 13px; float: left;background-color:#5A738E;border:1px solid #5A738E; " class="uiuxtrick btn btn-success" >
                         <i class="fa fa-edit" aria-hidden="true" ></i>
                         Edit
                    </a>
                </div>
                
                <div style="'.$opacity_appointment_trick.';margin-top:12px;" >
                    <a id="various222" href="#a'.$count_trick.'" title="Quick Show Patient Profile" style="float:left;color: white; font-size: 13px; float: left;background-color:#5A738E;border:1px solid #5A738E;" class="btn btn-success" type="button" >
                        <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                        Profile
                    </a>
                    <div style="display:none;" >
                        <div id="a'.$count_trick.'" style="overflow:scroll;width:900px;height:600px;overflow-x: hidden;padding-left:20px;padding-right:20px;padding-top:15px;" >
                        
                        <h3 style="line-height: inherit;overflow-wrap: break-word; word-wrap: break-word; hyphens: auto;" >
                            
                            Full Name: '.$key_appointment->patient_first_name.' '.$key_appointment->patient_last_name.'
                            <hr>
                            Mobile Number: '.$key_appointment->patient_mobile_number.'
                            <hr>
                            Last Appointment Date & time: '.$key_appointment->patient_last_appointment_date.' '.$key_appointment->patient_last_appointment_time.'
                            <hr>
                            Last Appointment Service Type: '.$key_appointment->appointment_service_type.'
                            <hr>
                            Birthday: '.$key_appointment->patient_birth_day.'
                            <hr>
                            Nationality Number: '.$key_appointment->patient_nationality_number.'
                            <hr>
                            Address: '.$key_appointment->patient_address.'
                            <hr>
                            Phone Number: '.$key_appointment->patient_phone_number.'
                            <hr>
                            Phone Mobile number: '.$key_appointment->patient_mobile_number.'
                            <hr>
                            Email Address: '.$key_appointment->patient_email_address.'
                            <hr>
                            Relationship Status: '.$key_appointment->patient_relationship_status.'
                            <hr>
                            Gender: '.$key_appointment->patient_gender.'
                            <hr>
                            Submission Type: '.$key_appointment->patient_submit_type.'
                            <hr>
                            Surgery History: '.$key_appointment->patient_surgery_history.'
                            <hr>
                            Disease Background: '.$key_appointment->patient_disease_background.'
                            <hr>
                            Medication history: '.$key_appointment->patient_medication_history.'
                            <hr>
                            More Description: '.$key_appointment->patient_more_description.'
                        </h3>
                         
                        </div>
                    </div>
                </div>
                
                <div style="'.$opacity_appointment_trick.'" >
                    <a href="'.route('delete_this_appointment_by_this_id' , [ 'appointment_id' => $key_appointment->appointment_id , 'show_all_appointments_this_date' => $key_appointment->appointment_date ] ).'" style="float:left;color: white; font-size: 13px; float: left;background-color:#5A738E;border:1px solid #5A738E; " class="btn btn-success" ' ; ?> onclick="return confirm('Are you sure to delete this appointment?') <?php echo '" title="Delete This Appointment" >
                        <i class="fa fa-trash-o" aria-hidden="true" ></i>
                        Delete
                    </a>
                </div>
                
            </div>
        
        </div>' ;

    } // END of foreach.

    // Put this piece of code to make a gap between search button and the last result for better UX
    echo '
    <hr style="width:1px;" >
    
    <button type="submit" name="send_patient_to_doctor_room" class="btn btn-success btn-lg btn-block uiuxtrick" style="font-size:28px;position: fixed;bottom: 0px;right: 0px;z-index: 1;margin-bottom:0px;margin-right:0px;" onclick="this.disabled=true;this.form.submit();" >
       <i class="fa fa-send-o" aria-hidden="true"></i> Send Patient to Doctor\'s Room
    </button>
    </form>' ;

} // END of If count of appointments was more than 0 for TODAY, show them.

// If there is not any appointment in database for this specific date show search button to search for another date.
else
{
    echo '
    <center>
        <div class="col-md-12 col-sm-12 col-xs-12" style="text-align:center;margin-bottom:60px!important;" align="center">
            <h1 style="text-align:center;font-size:25pt;margin-top:40px;color:gray;" align="center">
                There is not any appointment for today '.date('Y-m-d').'
                <br>
            </h1>
        </div>
    </center>' ;
}

                                    echo '
                                    </div>
                                    </div>
                                    </div>
                                    </div>
                                </div>
							<!-- END of login fancy console panel today_turn_res -->

							</li>
                        </ul>
                        
                    </nav>
                </div>
            </div>
            <!-- /top navigation -->' ;

    if($errors->any())
    {
        foreach($errors->all() as $error)
        {
            echo '
            <div class="col-md-10 col-sm-10 col-xs-10 alert alert-danger" role="alert" style="float:right;" > <button type="button" class="close" data-dismiss="alert" aria-label="Close"  ><span aria-hidden="true">&times;</span></button> <h4 style="font-size:25px;text-align:center!important;overflow-wrap: break-word; word-wrap: break-word; hyphens: auto;" >'.$error.'</h4></div>' ;
        }
    }

    if( Session::get('success_message') !== '' && session()->has('success_message') )
    {
        echo '<div class="col-md-12 col-sm-12 col-xs-12" style="float:right!important;" ><div class="col-md-10 col-sm-10 col-xs-10 alert alert-success" role="alert" style="text-align:center!important;overflow-wrap: break-word; word-wrap: break-word; hyphens: auto;float:right!important;" > <button type="button" class="close" data-dismiss="alert" aria-label="Close" style="font-size:50px;margin-left:15px!important;" ><span aria-hidden="true">&times;</span></button><h3>'.Session::get('success_message').'</h3></div></div>' ;
        session()->pull('success_message') ;
    }

?>
