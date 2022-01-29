<?php

// Add your custom css files here. (will located in header)
$extra_links_header = '
<!-- MD.BootstrapPersianDateTimePicker css -->
<link href="'.url('back/vendors/MD.BootstrapPersianDateTimePicker/Content/MdBootstrapPersianDateTimePicker/jquery.Bootstrap-PersianDateTimePicker.css').'" rel="stylesheet">' ;

// Add your custom js files here. (will located in footer)
$extra_links_footer = '
<!-- jQuery Tags Input -->
<script src="'.url('back/vendors/jquery.tagsinput/src/jquery.tagsinput.js').'"></script>' ;

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
    
    <div class="col-md-12 col-sm-12 col-xs-12">' ;

    // START of If user came to this page from route('submit_new_patient_form').
    if( $title_of_page == 'Submit a New Patient' )
    {
        echo '
        <form method="POST" action="' . route('store_new_patient_form') . '" data-parsley-validate class="form-horizontal form-label-left" style="text-align:left!important;direction:ltr!important;font-size:15pt;margin-top:40px!important;" id="medical-file-form" >
            
            <input type="hidden" name="_token" value="' . csrf_token() . '" >
            <input type="hidden" name="_method" value="put" >
            
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name" title="Maximum 35 words" >
                Name
            <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" name="patient_first_name" value="' . old('patient_first_name') . '" required class="form-control col-md-7 col-xs-12 has-feedback-right" autocomplete="off" aria-autocomplete="list" aria-expanded="false" aria-haspopup="true" role="combobox" spellcheck="false">
              <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
            </div>
          </div>
          
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name" title="Maximum 35 words" >
                Family
            <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" name="patient_last_name" value="' . old('patient_last_name') . '" required class="form-control col-md-7 col-xs-12 has-feedback-right" autocomplete="off" aria-autocomplete="list" aria-expanded="false" aria-haspopup="true" role="combobox" spellcheck="false" >
              <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
            </div>
          </div>
          
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" title="Maximum 20 words" >
                Mobile Number
            <span class="required">*</span>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" name="patient_mobile_number" value="' . old('patient_mobile_number') . '" required class="form-control col-md-7 col-xs-12 has-feedback-right"  autocomplete="off" aria-autocomplete="list" aria-expanded="false" aria-haspopup="true" role="combobox" spellcheck="false" />
              <span class="fa fa-phone form-control-feedback right" aria-hidden="true"></span>
            </div>
          </div>
          
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" title="Maximum 50 words" >
                Nationality Number
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" name="patient_nationality_number" value="' . old('patient_nationality_number') . '" class="form-control col-md-7 col-xs-12 has-feedback-right" autocomplete="off" aria-autocomplete="list" aria-expanded="false" aria-haspopup="true" role="combobox" spellcheck="false" >
              <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
            </div>
          </div>
          
          <div class="form-group">
          
            <label class="control-label col-md-3 col-sm-3 col-xs-12" title="Maximum 20 words">
                Date of Appointment
            </label>
            
            <div class="form-group col-md-6 col-sm-6 col-xs-12" >
                <div class="input-group date" >
                    <input type="text" class="form-control col-md-7 col-xs-12" id="dateMiladi" placeholder="Choose a Date" data-mddatetimepicker="true" data-trigger="click" data-targetselector="#dateMiladi" data-enabletimepicker="false"
        data-placement="bottom" data-disablebeforetoday="false" data-isgregorian="true" value="' . old('patient_last_appointment_date') . '" name="patient_last_appointment_date" autocomplete="off" aria-autocomplete="list" aria-expanded="false" aria-haspopup="true" role="combobox" spellcheck="false" />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar" style="opacity: 0.5;" ></span>
                    </span>
                </div>
            </div>
             
          </div> 
          
        <br>
        <center>
            <span data-toggle="collapse" data-target="#more_details" class="btn-primary btn-lg" type="button" style="cursor:pointer;color:gray;background-color:white;border:1px solid #bfbdbd;" >
                <span class="glyphicon glyphicon-plus" aria-hidden="true" style="color:#ccc;margin-left:5px;" ></span>
                More Details
            </span>
        </center>
        <br>

        <div id="more_details" class="collapse col-md-12 col-sm-12 col-xs-12">


          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">
                Birth Date
            </label>
            
            <div class="col-md-6 col-sm-6 col-xs-12" >
                <input type="text" name="patient_birth_day" value="' . old('patient_birth_day') . '" class="form-control col-md-7 col-xs-12 has-feedback-right" id="" data-MdDateTimePicker="true"  autocomplete="off" aria-autocomplete="list" aria-expanded="false" aria-haspopup="true" role="combobox" spellcheck="false" />
                <span class="glyphicon glyphicon-calendar form-control-feedback right" aria-hidden="true"></span>
            </div>
          </div>
          
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" >
                Address
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" name="patient_address" value="' . old('patient_address') . '" class="form-control col-md-7 col-xs-12 has-feedback-right" autocomplete="off" aria-autocomplete="list" aria-expanded="false" aria-haspopup="true" role="combobox" spellcheck="false" >
              <span class="fa fa-location-arrow form-control-feedback right" aria-hidden="true"></span>
            </div>
          </div>
          
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12"  >
                Phone Number 
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" name="patient_phone_number" value="' . old('patient_phone_number') . '" class="form-control col-md-7 col-xs-12 has-feedback-right" autocomplete="off" aria-autocomplete="list" aria-expanded="false" aria-haspopup="true" role="combobox" spellcheck="false" >
              <span class="fa fa-phone form-control-feedback right" aria-hidden="true"></span>
            </div>
          </div>
          
          <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" >
                Email Address 
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input type="text" name="patient_email_address" value="' . old('patient_email_address') . '" class="form-control col-md-7 col-xs-12 has-feedback-right" autocomplete="off" aria-autocomplete="list" aria-expanded="false" aria-haspopup="true" role="combobox" spellcheck="false" > 
              <span class="fa fa-envelope form-control-feedback right" aria-hidden="true"></span>
            </div>
          </div>
          
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">
                    Marital Status
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="col-md-12 col-sm-12 col-xs-12 btn-group btn-group-justified" >
                  
                    <label class="btn btn-default well" data-toggle-class="btn-primary" style="background-color:white;border: 1px solid #ccc;border-radius: 4px!important;margin-top:5px;margin-bottom:5px;" >
                      <input type="radio" name="patient_relationship_status" value="divorced" > Divorced
                    </label>
                    
                    <label class="btn btn-default well" data-toggle-class="btn-primary" style="background-color:white;border: 1px solid #ccc;border-radius: 4px!important;margin-top:5px;margin-bottom:5px;" >
                      <input type="radio" name="patient_relationship_status" value="married" > Married
                    </label>
                    
                    <label class="btn btn-default well" data-toggle-class="btn-primary" style="background-color:white;border: 1px solid #ccc;border-radius: 4px!important;margin-top:5px;margin-bottom:5px;" >
                      <input type="radio" name="patient_relationship_status" value="single"  > Single
                    </label> 
                    
                  </div>
                </div>
              </div>
              
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">
                    Gender
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <div class="col-md-12 col-sm-12 col-xs-12 btn-group btn-group-justified" >
                    <label class="btn btn-default well" data-toggle-class="btn-primary" style="background-color:white;border: 1px solid #ccc;border-radius: 4px!important;margin-top:5px;margin-bottom:5px;" >
                      <input type="radio" name="patient_gender" value="male" > Male
                    </label>
                    <label class="btn btn-default well" data-toggle-class="btn-primary" style="background-color:white;border: 1px solid #ccc;border-radius: 4px!important;margin-top:5px;margin-bottom:5px;" >
                      <input type="radio" name="patient_gender" value="female" > Female
                    </label>
                  </div>
                </div>
              </div>
              
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">
                    patient surgery history
                </label>
                <div class="col-md-6 col-sm-12 col-xs-12"  >
                  <input id="tags_1" type="text" name="patient_surgery_history" value="' . old('patient_surgery_history') . '" class="tags form-control" > 
                  <div id="suggestions-container" style="position: relative; float: right; width: 250px; margin: 10px;"></div>
                </div>
              </div>
       
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">
                    patient disease background
                </label>
                <div class="col-md-6 col-sm-12 col-xs-12"  >
                  <input id="tags_2" type="text" name="patient_disease_background" value="' . old('patient_disease_background') . '" class="tags form-control" > 
                  <div id="suggestions-container" ></div>
                </div>
              </div>
              
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">
                    patient medication history
                </label>
                <div class="col-md-6 col-sm-12 col-xs-12"  >
                  <input id="tags_3" type="text" name="patient_medication_history" value="' . old('patient_medication_history') . '" class="tags form-control" > 
                  <div id="suggestions-container" ></div>
                </div>
              </div>
              
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">
                    patient allergies history
                </label>
                <div class="col-md-6 col-sm-12 col-xs-12" >
                  <input id="tags_4" type="text" name="patient_allergies_history" value="' . old('patient_allergies_history') . '" class="tags form-control" > 
                  <div id="suggestions-container" ></div>
                </div>
              </div>
              
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">
                    patient more description
                </label>
                <div class="col-md-6 col-sm-12 col-xs-12">
                    <textarea name="patient_more_description" id="descr" class="form-control" rows="4" cols="50" style="overflow:auto;">' . old('patient_more_description') . '</textarea>
                </div>
              </div>
              
              <br>
              <hr style="width:1px;" >
              <br>
              <br>
              <hr style="width:1px;" >
              <br>
                  
            </div>
    
            <div class="form-group" style="margin-top:40px;">
                <div class="form-group col-md-12 col-sm-12 col-xs-12 ">
                
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <button type="submit" name="booking_status" class="btn btn-success btn-group-justified uiuxtrick" style="margin-bottom:0px;margin-right:0px;font-size:28px;position: fixed;bottom: 0px;right: 0px;z-index: 1;"  >
                            Submit
                        </button>				
                    </div>
                    
                </div>
            </div>
              
        </form>';
    }
    // END of If user came to this page from route('submit_new_patient_form').

    // START of If user came to this page from route('update_this_patient').
    else
    {
        foreach ( $result_edit_patient_form as $key )
        {
            echo '
            <form method="POST" action="'.route('update_this_patient' , $key->patient_id ).'" data-parsley-validate class="form-horizontal form-label-left" style="text-align:left!important;direction:ltr!important;font-size:15pt;margin-top:40px!important;" id="medical-file-form" >
                
                <input type="hidden" name="_token" value="' . csrf_token() . '" >
                <input type="hidden" name="_method" value="put" >
                
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name" title="Maximum 35 words">
                        Name
                    <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="text" name="patient_first_name" value="' .$key->patient_first_name. '" required class="form-control col-md-7 col-xs-12 has-feedback-right" autocomplete="off" aria-autocomplete="list" aria-expanded="false" aria-haspopup="true" role="combobox" spellcheck="false">
                      <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name" title="Maximum 35 words">
                        Family
                    <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="text" name="patient_last_name" value="' .$key->patient_last_name. '" required class="form-control col-md-7 col-xs-12 has-feedback-right" autocomplete="off" aria-autocomplete="list" aria-expanded="false" aria-haspopup="true" role="combobox" spellcheck="false" >
                      <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" title="Maximum 20 words" >
                        Mobile Number
                    <span class="required">*</span>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="text" name="patient_mobile_number" value="' .$key->patient_mobile_number. '" required class="form-control col-md-7 col-xs-12 has-feedback-right"  autocomplete="off" aria-autocomplete="list" aria-expanded="false" aria-haspopup="true" role="combobox" spellcheck="false" />
                      <span class="fa fa-phone form-control-feedback right" aria-hidden="true"></span>
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" title="Maximum 50 words" >
                        Nationality Number
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="text" name="patient_nationality_number" value="' .$key->patient_nationality_number. '" class="form-control col-md-7 col-xs-12 has-feedback-right" autocomplete="off" aria-autocomplete="list" aria-expanded="false" aria-haspopup="true" role="combobox" spellcheck="false" >
                      <span class="fa fa-user form-control-feedback right" aria-hidden="true"></span>
                    </div>
                  </div> ' ;

                    // If the length of this variable was more than 2 character,
                    // it means this patient has a least 1 appointment in database.
                    if( strlen($result_show_all_appointments_of_this_id ) > 2 )
                    {
                      echo '
                      <div class="form-group">
                        
                        <br>
                        <center>
                            <span data-toggle="collapse" data-target="#more_appointment" title="The last appointment date and time you submitted for this patient" class="btn-primary btn-lg" type="button" style="cursor:pointer;color:gray;background-color:white;border:1px solid #bfbdbd;" >
                                <span class="glyphicon glyphicon-plus" aria-hidden="true" style="color:#ccc;margin-left:5px;" ></span>
                                Last Appointments
                            </span>
                        </center>
                        <br>
                        
                        <div id="more_appointment" class="collapse col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group col-md-12 col-sm-12 col-xs-12" >
                                <div class="input-group date" >';

                                foreach ($result_show_all_appointments_of_this_id as $key_2)
                                {
                                    echo '
                                    <label class="well form-group btn-default well" style="text-align:center;font-weight:normal;cursor: pointer;font-size:14px;border:1px solid #ccc;">
                                        <span>
                                            ' . $key_2->appointment_date . ' => ' . $key_2->appointment_time . '
                                        </span>';
                                        if( $key_2->appointment_status === '1' && $key_2->appointment_status_unique === '0' )
                                        {
                                           echo '
                                           <span class="glyphicon glyphicon-refresh" aria-hidden="true" style="margin-left:5px;" title="Waiting to be visited..." ></span>' ;
                                        }
                                        elseif( $key_2->appointment_status === '0' && $key_2->appointment_status_unique === '1' )
                                        {
                                            echo '
                                           <span class="glyphicon glyphicon-ok" aria-hidden="true" style="margin-left:5px;" title="Visited" ></span>' ;
                                        }

                                        echo '
                                        <span>
                                            <br>';
                                            if(strlen($key_2->appointment_child_dr_related_name) > 0)
                                            {
                                                echo '<span title="Related Doctors Name">'.$key_2->appointment_child_dr_related_name.'</span>' ;
                                            }
                                            else
                                            {
                                                echo '&nbsp;' ;
                                            }
                                            echo '
                                        </span>
                                        
                                        <span>
                                            <br>';
                                            if($key_2->appointment_received_financial_status > 0)
                                            {
                                                echo '$'.$key_2->appointment_received_financial_status.'<span class="fa fa-money" aria-hidden="true" style="margin-left:5px;font-size:20px;" title="Money of Appointment Received" ></span>' ;
                                            }
                                            else
                                            {
                                                echo '&nbsp;' ;
                                            }
                                            echo '
                                        </span>
                                        
                                    </label>&nbsp;';
                                }

                                echo '
                                </div>
                            </div>
                      </div> ';
                    }

                  echo '
                  <div class="form-group">
                  
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" title="Maximum 20 words" >
                        Change Date of Last Appointment
                    </label>
                    
                    <div class="form-group col-md-6 col-sm-6 col-xs-12" >
                        <div class="input-group date" id="datetimepicker7" >
                            <input type="text" class="form-control col-md-7 col-xs-12" data-name="datepicker1" id="dateMiladi" data-englishnumber="true" placeholder="Choose Date" data-mddatetimepicker="true" data-trigger="click" data-targetselector="#dateMiladi" data-enabletimepicker="false"
                data-placement="bottom" data-disablebeforetoday="false" data-isgregorian="true" value="' .$key->patient_last_appointment_date. '" name="patient_last_appointment_date" autocomplete="off" aria-autocomplete="list" aria-expanded="false" aria-haspopup="true" role="combobox" spellcheck="false" />
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar" style="opacity: 0.5;" ></span>
                            </span>
                        </div>
                    </div>
                    
                    <div class="col-md-12 col-sm-12 col-xs-12" >
                        <b>
                          <center>
                              <span data-name="getValue1" class="btn btn-success uiuxtrick" >
                                Book a New Appointment Time for This Date
                                <span class="glyphicon glyphicon-time" aria-hidden="true"></span>
                              </span>
                          </center>
                        </b>
                    </div>
                    
                  </div>
                  
                <br>
                <center>
                    <span data-toggle="collapse" data-target="#more_details" class="btn-primary btn-lg" type="button" style="cursor:pointer;color:gray;background-color:white;border:1px solid #bfbdbd;" >
                        <span class="glyphicon glyphicon-plus" aria-hidden="true" style="color:#ccc;margin-left:5px;" ></span>
                        More Details
                    </span>
                </center>
                <br>
        
                <div id="more_details" class="collapse col-md-12 col-sm-12 col-xs-12">
        
        
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">
                        Birth Date
                    </label>
                    
                    <div class="col-md-6 col-sm-6 col-xs-12" >
                        <input type="text" name="patient_birth_day" value="' .$key->patient_birth_day. '" class="form-control col-md-7 col-xs-12 has-feedback-right" id="" data-MdDateTimePicker="true"  autocomplete="off" aria-autocomplete="list" aria-expanded="false" aria-haspopup="true" role="combobox" spellcheck="false" />
                        <span class="glyphicon glyphicon-calendar form-control-feedback right" aria-hidden="true"></span>
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" >
                        Address
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="text" name="patient_address" value="' .$key->patient_address. '" class="form-control col-md-7 col-xs-12 has-feedback-right" autocomplete="off" aria-autocomplete="list" aria-expanded="false" aria-haspopup="true" role="combobox" spellcheck="false" >
                      <span class="fa fa-location-arrow form-control-feedback right" aria-hidden="true"></span>
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" >
                        Phone Number 
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="text" name="patient_phone_number" value="' .$key->patient_phone_number. '" class="form-control col-md-7 col-xs-12 has-feedback-right" autocomplete="off" aria-autocomplete="list" aria-expanded="false" aria-haspopup="true" role="combobox" spellcheck="false" >
                      <span class="fa fa-phone form-control-feedback right" aria-hidden="true"></span>
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" >
                        Email Address 
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="text" name="patient_email_address" value="' .$key->patient_email_address. '" class="form-control col-md-7 col-xs-12 has-feedback-right" autocomplete="off" aria-autocomplete="list" aria-expanded="false" aria-haspopup="true" role="combobox" spellcheck="false" > 
                      <span class="fa fa-envelope form-control-feedback right" aria-hidden="true"></span>
                    </div>
                  </div>';

                        $divorced_text_trick = '' ;
                        $married_text_trick = '' ;
                        $single_text_trick = '' ;

                        if( $key->patient_relationship_status == 'divorced' )
                        {
                            $divorced_text_trick = 'checked' ;
                        }
                        elseif ( $key->patient_relationship_status == 'married' )
                        {
                            $married_text_trick = 'checked' ;
                        }
                        elseif ( $key->patient_relationship_status == 'single' )
                        {
                            $single_text_trick = 'checked' ;
                        }


                        echo '
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">
                            Marital Status
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="col-md-12 col-sm-12 col-xs-12 btn-group btn-group-justified" >
                          
                            <label class="btn btn-default well" data-toggle-class="btn-primary" style="background-color:white;border: 1px solid #ccc;border-radius: 4px!important;margin-top:5px;margin-bottom:5px;" >
                              <input type="radio" name="patient_relationship_status" value="divorced" '.$divorced_text_trick.' > Divorced
                            </label>
                            
                            <label class="btn btn-default well" data-toggle-class="btn-primary" style="background-color:white;border: 1px solid #ccc;border-radius: 4px!important;margin-top:5px;margin-bottom:5px;" >
                              <input type="radio" name="patient_relationship_status" value="married" '.$married_text_trick.' > Married
                            </label>
                            
                            <label class="btn btn-default well" data-toggle-class="btn-primary" style="background-color:white;border: 1px solid #ccc;border-radius: 4px!important;margin-top:5px;margin-bottom:5px;" >
                              <input type="radio" name="patient_relationship_status" value="single" '.$single_text_trick.' > Single
                            </label> 
                            
                          </div>
                        </div>
                      </div>' ;

                        $male_text_trick = '' ;
                        $female_text_trick = '' ;

                        if( $key->patient_gender == 'male' )
                        {
                            $male_text_trick = 'checked' ;
                        }
                        elseif ( $key->patient_gender == 'female' )
                        {
                            $female_text_trick = 'checked' ;
                        }

                      echo '  
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">
                            Gender
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <div class="col-md-12 col-sm-12 col-xs-12 btn-group btn-group-justified" >
                            <label class="btn btn-default well" data-toggle-class="btn-primary" style="background-color:white;border: 1px solid #ccc;border-radius: 4px!important;margin-top:5px;margin-bottom:5px;" >
                              <input type="radio" name="patient_gender" value="male" '.$male_text_trick.' > Male
                            </label>
                            <label class="btn btn-default well" data-toggle-class="btn-primary" style="background-color:white;border: 1px solid #ccc;border-radius: 4px!important;margin-top:5px;margin-bottom:5px;" >
                              <input type="radio" name="patient_gender" value="female" '.$female_text_trick.' > Female
                            </label>
                          </div>
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">
                            patient surgery history
                        </label>
                        <div class="col-md-6 col-sm-12 col-xs-12"  >
                          <input id="tags_1" type="text" name="patient_surgery_history" value="' .$key->patient_surgery_history. '" class="tags form-control" > 
                          <div id="suggestions-container" style="position: relative; float: right; width: 250px; margin: 10px;"></div>
                        </div>
                      </div>
               
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">
                            patient disease background
                        </label>
                        <div class="col-md-6 col-sm-12 col-xs-12"  >
                          <input id="tags_2" type="text" name="patient_disease_background" value="' .$key->patient_disease_background. '" class="tags form-control" > 
                          <div id="suggestions-container" ></div>
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">
                            patient medication history
                        </label>
                        <div class="col-md-6 col-sm-12 col-xs-12"  >
                          <input id="tags_3" type="text" name="patient_medication_history" value="' .$key->patient_medication_history. '" class="tags form-control" > 
                          <div id="suggestions-container" ></div>
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">
                            patient allergies history
                        </label>
                        <div class="col-md-6 col-sm-12 col-xs-12" >
                          <input id="tags_4" type="text" name="patient_allergies_history" value="' .$key->patient_allergies_history. '" class="tags form-control" > 
                          <div id="suggestions-container" ></div>
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">
                            patient more description
                        </label>
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <textarea name="patient_more_description" id="descr" class="form-control" rows="4" cols="50" style="overflow:auto;">' .$key->patient_more_description. '</textarea> 
                        </div>
                      </div>
                      
                      <br>
                      <hr style="width:1px;" >
                      <br>
                      <br>
                      <hr style="width:1px;" >
                      <br>
                          
                    </div>
            
                    <div class="form-group" style="margin-top:40px;">
                        <div class="form-group col-md-12 col-sm-12 col-xs-12 ">
                        
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <button type="submit" name="booking_status" class="btn btn-success btn-group-justified uiuxtrick" style="margin-bottom:0px;margin-right:0px;font-size:28px;position: fixed;bottom: 0px;right: 0px;z-index: 1;"  >
                                    Update
                                </button>				
                            </div>
                            
                        </div>
                    </div>
                  
            </form>';
        }
    }
    // END of If user came to this page from route('update_this_patient').

  echo '  
  </div>
</div>      
<!-- /page content -->' ;

// Call the footer include.
include 'layout/footer.php' ;
?>

<!-- jQuery Tags Input -->
<script>
  function onAddTag(tag) {
    alert("Add a new item: " + tag);
  }

  function onRemoveTag(tag) {
    alert("Remove this item: " + tag);
  }

  function onChangeTag(input, tag) {
    alert("Change this item: " + tag);
  }

  $(document).ready(function() {
    $('#tags_1').tagsInput({
      width: 'auto',
      height: 'auto'
    });
  });

  $(document).ready(function() {
    $('#tags_2').tagsInput({
      width: 'auto',
      height: 'auto'
    });
  });

   $(document).ready(function() {
    $('#tags_3').tagsInput({
      width: 'auto',
      height: 'auto'
    });
  });

   $(document).ready(function() {
    $('#tags_4').tagsInput({
      width: 'auto' ,
      height: 'auto'
    });
  });
</script>
<!-- /jQuery Tags Input -->

<?php
// If user came to this page from route('update_this_patient')
if( $title_of_page == 'Edit Patient Information' )
{
?>
    <!-- Script related to redirect user if click on "Set time of Appointment" button -->
    <script type="text/javascript">
    $('[data-name="getValue1"]').on('click', function ()
    {
    var getValueResult = $('[data-name="datepicker1"]').MdPersianDateTimePicker('getValue');
    window.location.href = "../show_patient_time_appointment_table/" + getValueResult + "/<?php echo $key->patient_id; ?>" ;
    });
    </script>
<?php
}

// <script src="'.url('back/vendors/MD.BootstrapPersianDateTimePicker/Scripts/MdBootstrapPersianDateTimePicker/jalaali.js').'"></script>
echo '
<!-- MD.BootstrapPersianDateTimePicker js -->
<script src="'.url('back/vendors/MD.BootstrapPersianDateTimePicker/Scripts/MdBootstrapPersianDateTimePicker/jquery.Bootstrap-PersianDateTimePicker.js').'"></script>' ;
?>