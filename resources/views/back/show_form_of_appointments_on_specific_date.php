<?php
// Add your custom css files here. (will located in header)
$extra_links_header = '
<!-- MD.BootstrapPersianDateTimePicker css -->
<link href="'.url('back/vendors/MD.BootstrapPersianDateTimePicker/Content/MdBootstrapPersianDateTimePicker/jquery.Bootstrap-PersianDateTimePicker.css').'" rel="stylesheet">' ;

// Add your custom js files here. (will located in footer)
// <script src="'.url('back/vendors/MD.BootstrapPersianDateTimePicker/Scripts/MdBootstrapPersianDateTimePicker/jalaali.js').'"></script>
$extra_links_footer = '
<!-- MD.BootstrapPersianDateTimePicker js -->
<script src="'.url('back/vendors/MD.BootstrapPersianDateTimePicker/Scripts/MdBootstrapPersianDateTimePicker/jquery.Bootstrap-PersianDateTimePicker.js').'"></script>' ;

// Call the header include.
include 'layout/header.php' ;

echo '
<!-- page content -->
<div class="right_col" role="main" >
    
    <div style="width: 100%;height: 80px;padding: 10px 0;" >
	  <center>
		 <h3 style="text-align:center;">
			 '.$title_of_page.'
			 <br>
		 </h3>
	  </center>
	</div>
    
    <div class="col-md-12 col-sm-12 col-xs-12">  
        <form method="get" action="'.route('run_show_form_of_appointments_on_specific_date').'" id="medical-file-form" data-parsley-validate  >
        
            <input type="hidden" name="_token" value="'.csrf_token().'" >
            
            <center>
                <div class="form-group col-md-12 col-sm-12 col-xs-12 justify-content-between" style="margin-top:55px;" >
                    <h2 class="col-md-12 col-sm-12 col-xs-12">
                        Choose Your Desired Date to Display Appointments 
                    </h2>
                    
                    <div class="col-md-12 col-sm-12 col-xs-12" >
                        <div class="input-group date" >
                            <input type="text" name="show_all_appointments_on_this_date" class="form-control col-md-7 col-xs-12" id="dateMiladi" placeholder="Choose a Date" data-mddatetimepicker="true" data-trigger="click" data-targetselector="#dateMiladi" data-enabletimepicker="false"
        data-placement="bottom" data-disablebeforetoday="false" data-isgregorian="true" autocomplete="off" aria-autocomplete="list" aria-expanded="false" aria-haspopup="true" role="combobox" spellcheck="false" />
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar" style="opacity: 0.5;" ></span>
                            </span>
                        </div>
                    </div>
                </div>
            </center>';

            // START of If count of appointments was more than 0 , show them.
            if ( isset($count_of_appointment) && $count_of_appointment > 0 )
            {
                // START of if we have result.
                if (isset($result_show_form_of_appointments_on_specific_date))
                {
                    echo '
                    <div class="col-md-2 col-sm-2 col-xs-2" style="font-size:15pt;float:right;" >
                        <h2 style="line-height: inherit;margin-top:12px;text-align:center;" >
                            Appointment Number
                            Patient Attendance Status
                        </h2>
                        <br>
                    </div>
                    <div class="col-md-2 col-sm-2 col-xs-2" style="font-size:15pt;float:right;" >
                        <h2 style="line-height: inherit;text-align:center;" >
                            Time of Appointment
                            <br>
                            Service Type
                        </h2>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-3" style="font-size:15pt;float:right;" >
                        <h2 style="line-height: inherit;text-align:center;" >
                           Name
                           <br>
                           Mobile Number of Patient
                        </h2>
                        <br>
                    </div>
                    <div class="col-md-3 col-sm-3 col-xs-3" style="font-size:15pt;float:right;text-align:center;" >
                        <h2 style="line-height: inherit;text-align:center;" >
                            Name of Doctor
                            <br>
                            Cost of a Patient Visit
                        </h2>
                        <br>
                    </div>
                    
                    <div class="col-md-2 col-sm-2 col-xs-2" style="font-size:15pt;float:right;text-align:center;" >
                        <h2 style="line-height: inherit;text-align:center;" >
                            Send Group Message by Bot
                            <br>
                            <a id="various222" href="#submit_send_sms_notif_turn_to_all_patient" style="line-height: inherit;text-align:center;" >
                                ...+
                                <i class="glyphicon glyphicon-envelope" aria-hidden="true" style="font-size:28px;" title="Send Group Message By Bale Bot"></i>
                                +<i class="glyphicon glyphicon-envelope" aria-hidden="true" style="font-size:28px;" title="Send Group Message By Bale Bot"></i>
                                +<i class="glyphicon glyphicon-envelope" aria-hidden="true" style="font-size:28px;" title="Send Group Message By Bale Bot"></i>
                            </a>
                        </h2>
                        <br>
                    </div>
                    
                    <!-- START of login fancy console panel submit_send_sms_notification_turn_to_all_patient -->
                    <div style="display:none;" >
                        <div id="submit_send_sms_notif_turn_to_all_patient" style="overflow:scroll;overflow-x: hidden;background-color:white;" class="well" >
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <center>
                                        <p style="font-size:24px;" >
                                             Are you sure that sending a group reminder SMS to patients with a robot will be done?
                                        </p>
                                        <br>
                                        <br>
                                        <a href="" style="font-size:24px;padding-right:55px;padding-left:55px;" class="btn btn-success uiuxtrick" >
                                           Yes
                                        </a>
                                    </center>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END of login fancy console panel submit_send_sms_notification_turn_to_all_patient -->';

                    // Create a variable to use on counting number of all appointments.
                    $count_trick = '' ;

                    // START of foreach.
                    foreach ($result_show_form_of_appointments_on_specific_date as $key)
                    {
                        $encrypted_patient_id = encrypt_decrypt('encrypt', $key->patient_id) ;
                        // Add 1 to previous value
                        ++$count_trick;

                        // Let to make a trick to show Good time OR Bad time for user appointment.
                        if( $key->appointment_status === '1' && $key->appointment_canceling_status == 'f' )
                        {
                            $appointment_status_div_color_trick = 'green;' ;

                            if( $admin_accessibility_to_telegram === 'true')
                            { $trick_of_show_check_box            = 'Approved <input type="radio" name="appointment_id" value="'.$key->appointment_id.'" class="flat" required  >' ;}
                            else{ $trick_of_show_check_box            = '<div style="width:20px;">&nbsp;</div>' ; }

                            $opacity_appointment_trick 	        = '' ;
                        }
                        elseif( $key->appointment_status === '1' && $key->appointment_canceling_status === NULL )
                        {
                            $appointment_status_div_color_trick = '#orange;' ;

                            if( $admin_accessibility_to_telegram === 'true')
                            { $trick_of_show_check_box            = 'Not Defined <input type="radio" name="appointment_id" value="'.$key->appointment_id.'" class="flat" required >' ;}
                            else{ $trick_of_show_check_box            = '<div style="width:20px;">&nbsp;</div>' ; }

                            $opacity_appointment_trick 	        = '' ;
                        }
                        elseif( $key->appointment_canceling_status == 't' )
                        {
                            $appointment_status_div_color_trick = 'red;' ;

                            if( $admin_accessibility_to_telegram === 'true')
                            { $trick_of_show_check_box            = 'Canceled <input type="radio" name="appointment_id" value="'.$key->appointment_id.'" class="flat" required >' ; }
                            else{ $trick_of_show_check_box            = '<div style="width:20px;">&nbsp;</div>' ; }

                            $opacity_appointment_trick          = 'opacity: 0.5;' ;
                        }
                        else
                        {
                            $appointment_status_div_color_trick = 'black;' ;
                            $trick_of_show_check_box            = '<div style="width:20px;">&nbsp;</div>' ;
                            $opacity_appointment_trick 	        = 'opacity: 0.5;' ;
                        }

                        echo '
                        <div class="col-md-12 col-sm-12 col-xs-12" style="float:right;border-bottom: 1px solid #bfbdbd;margin-top:15px;" >
                            <label class="col-md-2 col-sm-2 col-xs-2 form-group btn-default" style="float:right;cursor: pointer;background: #F7F7F7!important;" >
                                <div class="well" style="display: table-cell;vertical-align: middle;border:1px solid #7387a7;border-radius:50%;width:68px;height:68px;float:right;text-align:center!important;background-color:#F7F7F7;box-shadow: none!important;color:'.$appointment_status_div_color_trick.$opacity_appointment_trick.'" >
                                    <font size="+2" >
                                        '.$count_trick.'
                                    </font>
                                </div>
                                <div style="float:right;border:0px;background-color:#F7F7F7;box-shadow: none!important;color:'.$appointment_status_div_color_trick.'" class="well" >
                                    '.$trick_of_show_check_box.'
                                    <input type="hidden" name="current_date" value="'.$show_all_appointments_on_this_date.'" >
                                </div>
                                <br>
                            </label>
                            
                            <div class="col-md-8 col-sm-8 col-xs-8 well" style="border:0px solid;padding-bottom:0px;margin-bottom:0px;padding-top:0px;margin-top:0px;float:right;background-color:#F7F7F7;box-shadow: none!important;">

                                <div class="col-md-2 col-sm-2 col-xs-2" style="float:right;" >
                                    <center>
                                    <div style="float:right;margin-top:14px;font-size:15pt;color:'.$appointment_status_div_color_trick.$opacity_appointment_trick.'" >
                                        
                                        '.$key->appointment_time.'
                                        <br>
                                        <span title="'.$key->appointment_service_type.'" style="font-size:12px;">' ;
                                            if(strlen($key->appointment_service_type) > 30 )
                                            {
                                                echo substr($key->appointment_service_type, 0, 30).'...' ;
                                            }
                                            else
                                            {
                                                echo $key->appointment_service_type ;
                                            }
                                        echo '
                                        </span>
                                        
                                    </div>
                                    </center>
                                </div>

                                <div class="col-md-5 col-sm-5 col-xs-5" style="font-size:15pt;float:right;color:'.$appointment_status_div_color_trick.$opacity_appointment_trick.'" >
                                    <div style="float:right;margin-top:12px;text-align:left;" >
                                        '.$key->patient_first_name.' '.$key->patient_last_name.'
                                        <br>
                                        '.$key->patient_mobile_number ;

                                        if( $admin_accessibility_to_telegram === 'true')
                                        {
                                            if (strlen($key->patient_from_external_platform_id) > 0)
                                            {
                                                echo '
                                                <div style="float:left;font-size:13px;" class="col-md-12 col-sm-12 col-xs-12" >
                                                    Already Connected to BALE Bot
                                                    <span class="glyphicon glyphicon-ok" aria-hidden="true" ></span>
                                                </div>';
                                            }
                                            else
                                            {
                                                echo '
                                                <a href="' . route('edit_patient_form', $encrypted_patient_id ) . '" >
                                                    <div style="float:left;font-size:13px;" class="col-md-12 col-sm-12 col-xs-12" >
                                                        NOT Connected to BALE Bot
                                                        <span class="glyphicon glyphicon-remove" aria-hidden="true" ></span>
                                                    </div>
                                                </a>';
                                            }
                                        }
                                echo '
                                </div>
                            </div>

                            <div class="col-md-5 col-sm-5 col-xs-5" style="font-size:15pt;float:right;color:'.$appointment_status_div_color_trick.$opacity_appointment_trick.'" >
                                <div style="float:right;margin-top:12px;text-align:center;" class="col-md-12 col-sm-12 col-xs-12" >
                                    '.$key->appointment_child_dr_related_name.'
                                </div>' ;
                                // START of if doctor filled out financial data.
                                if( strlen($financial_management_data) > 0 )
                                {
                                    echo '
                                    <div style="float:right;margin-right:15px;margin-top:12px;" class="col-md-12 col-sm-12 col-xs-12" >
                                        <select name="money_receive[]" id="dates-field2" class="multiselect-ui form-control" multiple="multiple" style="font-size:18px!important;" >';
                                            // Explode and make array type variable
                                            $financial_management = explode(",",$financial_management_data) ;
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
                                    </div>';
                                } // END of if doctor filled out financial data.
                                echo '
                                <div class="col-md-12 col-sm-12 col-xs-12" style="float:right;text-align:center;font-size:14px;" >';
                                    if($key->appointment_received_financial_status > 0)
                                    {
                                        echo '$'.$key->appointment_received_financial_status.'<span class="fa fa-money" aria-hidden="true" style="margin-left:5px;font-size:20px;" title="$'.$key->appointment_received_financial_status.' of This Appointment Received" ></span>' ;
                                    }
                                    else
                                    {
                                        echo '&nbsp;' ;
                                    }
                                echo '
                                </div>
                            </div>
                        </div>
                            
                        <div class="col-md-2" style="padding-right:0px;padding-left:0px;margin-right:0px;margin-left:0px;margin-top:10px;" >
                            
                            <div class="col-md-12" style="'.$opacity_appointment_trick.';" >
                                <a title="Display EHR Document" href="'.route('show_patients_ehr_document_page' , [ 'patient_id' => $encrypted_patient_id ] ).'" style="float:left;color: white; font-size: 13px; float: left;background-color:#5A738E;border:1px solid #5A738E; " class="uiuxtrick btn btn-success" >
                                    <i class="fa fa-clone"></i>
                                    EHR Document
                                </a>
                            </div>
                            <div class="col-md-12" style="'.$opacity_appointment_trick.';" > ';
                                // If the patient has mobile number and active ROBOT then make link of send message by BOT.
                                if( strlen($key->patient_mobile_number) > 0  && strlen($key->patient_from_external_platform_id) > 0)
                                {
                                    echo '
                                    <a href="" class="uiuxtrick" style="float:left;color: white; font-size: 13px; float: left;background-color:#5A738E;border:1px solid #5A738E; " class="uiuxtrick btn btn-success" >
                                        <i class="glyphicon glyphicon-envelope" aria-hidden="true" title="Send a reminder SMS with the BALE robot to this patient" ></i>
                                    </a>';
                                }

                                echo '
                                <a href="'.route('edit_patient_form', $encrypted_patient_id ).'" style="float:left;color: white; font-size: 13px; float: left;background-color:#5A738E;border:1px solid #5A738E; " class="uiuxtrick btn btn-success" >
                                     <i class="fa fa-edit" aria-hidden="true" ></i>
                                     Edit Patient Info
                                </a>
                            </div>
                            
                            <div class="col-md-12" style="'.$opacity_appointment_trick.';" >
                                <a id="various222" href="#a'.$count_trick.'" title="Quick Show Patient Profile" style="float:left;color: white; font-size: 13px; float: left;background-color:#5A738E;border:1px solid #5A738E;" class="btn btn-success" type="button" >
                                    <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                                    Profile
                                </a>
                                <div style="display:none;" >
                                    <div id="a'.$count_trick.'" style="overflow:scroll;width:900px;height:600px;overflow-x: hidden;padding-left:20px;padding-right:20px;padding-top:15px;" >
                                    
                                    <h3 style="line-height: inherit;" >
                                        Full Name: '.$key->patient_first_name.' '.$key->patient_last_name.'
                                        <hr>
                                        Mobile Number: '.$key->patient_mobile_number.'
                                        <hr>
                                        Last Appointment Date & time: '.$key->patient_last_appointment_date.' '.$key->patient_last_appointment_time.'
                                        <hr>
                                        Last Appointment Service Type: '.$key->appointment_service_type.'
                                        <hr>
                                        Birthday: '.$key->patient_birth_day.'
                                        <hr>
                                        Nationality Number: '.$key->patient_nationality_number.'
                                        <hr>
                                        Address: '.$key->patient_address.'
                                        <hr>
                                        Phone Number: '.$key->patient_phone_number.'
                                        <hr>
                                        Phone Mobile number: '.$key->patient_mobile_number.'
                                        <hr>
                                        Email Address: '.$key->patient_email_address.'
                                        <hr>
                                        Relationship Status: '.$key->patient_relationship_status.'
                                        <hr>
                                        Gender: '.$key->patient_gender.'
                                        <hr>
                                        Submission Type: '.$key->patient_submit_type.'
                                        <hr>
                                        Surgery History: '.$key->patient_surgery_history.'
                                        <hr>
                                        Disease Background: '.$key->patient_disease_background.'
                                        <hr>
                                        Medication history: '.$key->patient_medication_history.'
                                        <hr>
                                        More Description: '.$key->patient_more_description.'
                                    </h3>
                                     
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-12" style="'.$opacity_appointment_trick.'" >
                                <a href="'.route('delete_this_appointment_by_this_id' , [ 'appointment_id' => $key->appointment_id , 'show_all_appointments_this_date' => $show_all_appointments_on_this_date ] ).'" style="float:left;color: white; font-size: 13px; float: left;background-color:#5A738E;border:1px solid #5A738E; " class="uiuxtrick btn btn-success" ' ; ?> onclick="return confirm('Are you sure to delete this appointment?') <?php echo '" title="Delete This Appointment" >
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
                    <button type="submit" name="Search" class="btn btn-success btn-group-justified uiuxtrick" style="font-size:28px;position: fixed;bottom: 0px;right: 0px;z-index: 1;margin-bottom:0px;margin-right:0px;" onclick="this.disabled=true;this.form.submit();" >
                        Display All Appointments on This Date
                    </button>' ;

                } // END of if we have result.
            } // END of If count of appointments was more than 0 , show them.

            // If there is not any appointment in database for this specific date show search button to search for another date.
            else
            {
                echo '
                <button type="submit" name="Search" class="btn btn-success btn-group-justified uiuxtrick" style="font-size:28px;position: fixed;bottom: 0px;right: 0px;z-index: 1;margin-bottom:0px;margin-right:0px;" onclick="this.disabled=true;this.form.submit();" >
                    Display All Appointments on This Date
                </button>' ;
            }

        echo '
        </form>
    </div>
</div>      
<!-- /page content -->' ;

// Call the footer include.
include 'layout/footer.php' ;
?>
