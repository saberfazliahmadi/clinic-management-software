<?php

// Add your custom css files here. (will located in header)
$extra_links_header = '
' ;

// Add your custom js files here. (will located in footer)
$extra_links_footer = '
<!-- jQuery Tags Input -->
<script src="'.url('back/vendors/jquery.tagsinput/src/jquery.tagsinput.js').'"></script>
' ;

// Call the header include.
include 'layout/header.php' ;
?>

<style>
    span.tag
    {
    font-size:23px;
    }
</style>

<?php
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
    
    <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top:50px;">  
        <div class="clearfix"></div>
	
		<div class="row">
		  <div class="col-md-12 col-sm-12 col-xs-12" >
			
			  <hr style="width:1px;">
			  <div class="form-group col-md-12 col-sm-12 col-xs-12" > ' ;

				foreach ( $result_show_main_settings_of_software_form as $key_settings )
				{

                $cms_menu_title_trick = explode(",", $key_settings->cms_menu_title) ;

                echo '
			    <form method="post" action="'.route('update_show_main_settings_of_software_form').'" id="medical-file-form" >
			        <input type="hidden" name="_token" value="'.csrf_token().'" >
                    
                    
                  <div class="form-group col-md-12 col-sm-12 col-xs-12" style="border-bottom:1px solid #aba5a5;padding-bottom:50px;" >
                    <center>
                        <label class="control-label col-md-12 col-sm-12 col-xs-12" style="margin-bottom:5px;margin-top:5px;font-size:19px;font-weight:normal;" >
                            Names of the doctors who work in clinic			
                        </label>
                    </center>
                    <div class="col-md-12 col-sm-12 col-xs-12" >
                      <input id="tags_00" type="text" name="clinic_doctors_name" class="tags form-control" value="' . $key_settings->clinic_doctors_name . '" > 
                      <div id="suggestions-container" ></div>
                    </div>
                  </div>
                
                  <div class="form-group col-md-12 col-sm-12 col-xs-12" style="border-bottom:1px solid #aba5a5;padding-bottom:50px;" >
                    <center>
                        <label class="control-label col-md-12 col-sm-12 col-xs-12" style="margin-bottom:5px;margin-top:5px;font-size:19px;font-weight:normal;" >
                            ' . $cms_menu_title_trick[5] . ' 
                            <br>
                            Predefined medications, predefined allergies and predefined surgeries of patients that doctor will need to add to the patient previous records
                        </label>
                    </center>
                    <div class="col-md-12 col-sm-12 col-xs-12" >
                      <input id="tags_0" type="text" name="common_hypersensitivity" class="tags form-control" value="' . $key_settings->common_hypersensitivity . '" > 
                      <div id="suggestions-container" ></div>
                    </div>
                  </div>
                    
                  <div class="form-group col-md-12 col-sm-12 col-xs-12" style="border-bottom:1px solid #aba5a5;padding-bottom:50px;" >
                    <center>
                        <label class="control-label col-md-12 col-sm-12 col-xs-12" style="margin-bottom:5px;margin-top:5px;font-size:19px;font-weight:normal;" >
                            ' . $cms_menu_title_trick[4] . '
                            <br>
                            Default Predefined Medicines that the doctor prescribes to her patients
                        </label>
                    </center>
                    <div class="col-md-12 col-sm-12 col-xs-12"  >
                      <input id="tags_1" type="text" name="common_drug" class="tags form-control" value="' . $key_settings->common_drug . '" > 
                      <div id="suggestions-container" ></div>
                    </div>
                  </div>
                
                  <div class="form-group col-md-12 col-sm-12 col-xs-12" style="border-bottom:1px solid #aba5a5;padding-bottom:50px;" >
                    <center>
                        <label class="control-label col-md-12 col-sm-12 col-xs-12" style="margin-bottom:5px;margin-top:5px;font-size:19px;font-weight:normal;" >
                            ' . $cms_menu_title_trick[3] . '
                            <br>
                            Common predefined recommendations that doctor will prescribing to patient
                        </label>
                    </center>
                    <div class="col-md-12 col-sm-12 col-xs-12" >
                      <input id="tags_2" type="text" name="common_rejim" class="tags form-control" value="' . $key_settings->common_rejim . '" > 
                      <div id="suggestions-container" ></div>
                    </div>
                  </div>
                  
                  <div class="form-group col-md-12 col-sm-12 col-xs-12" style="border-bottom:1px solid #aba5a5;padding-bottom:50px;" >
                    <center>
                        <label class="control-label col-md-12 col-sm-12 col-xs-12" style="margin-bottom:5px;margin-top:5px;font-size:19px;font-weight:normal;" >
                             ' . $cms_menu_title_trick[2] . '
                             <br>
                             Predefined time periods for the patient\'s next visit
                        </label></center>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <input id="tags_3" type="text" name="common_return_date" class="tags form-control" value="' . $key_settings->common_return_date . '" > 
                      <div id="suggestions-container" ></div>
                    </div>
                  </div>
                  
                  <div class="form-group col-md-12 col-sm-12 col-xs-12" >
                    <center>
                        <label class="control-label col-md-12 col-sm-12 col-xs-12" style="margin-bottom:5px;margin-top:5px;font-size:19px;font-weight:normal;" >
                            Gap time between appointments (should be between 5 and 60 minutes)
                        </label>
                    </center>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <input type="text" name="gap_time_between_appointments" class="form-control col-md-7 col-xs-12" value="' . $key_settings->gap_time_between_appointments . '" autocomplete="off" aria-autocomplete="list" aria-expanded="false" aria-haspopup="true" role="combobox" spellcheck="false"  >
                    </div>
                  </div>
    
                  <div class="form-group col-md-12 col-sm-12 col-xs-12" >
                    <center>
                        <label class="control-label col-md-12 col-sm-12 col-xs-12" style="margin-bottom:5px;margin-top:5px;font-size:19px;font-weight:normal;" >
                            Clinic Phone Number
                        </label>
                    </center>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <input type="text" name="phone_number" class="form-control col-md-7 col-xs-12 has-feedback-right" value="' . $key_settings->phone_number . '" autocomplete="off" aria-autocomplete="list" aria-expanded="false" aria-haspopup="true" role="combobox" spellcheck="false" >
                      <span class="fa fa-phone form-control-feedback right" aria-hidden="true"></span>
                    </div>
                  </div>
                  
                  <div class="form-group col-md-12 col-sm-12 col-xs-12" >
                    <center>
                        <label class="control-label col-md-12 col-sm-12 col-xs-12" style="margin-bottom:5px;margin-top:5px;font-size:19px;font-weight:normal;" >
                            Clinic Name
                        </label>
                    </center>
                    <div lass="col-md-12 col-sm-12 col-xs-12">
                      <input type="text" name="college_branch" class="form-control col-md-7 col-xs-12" value="' . $key_settings->college_branch . '" autocomplete="off" aria-autocomplete="list" aria-expanded="false" aria-haspopup="true" role="combobox" spellcheck="false"  >
                    </div>
                  </div>
                  
                  <div class="form-group col-md-12 col-sm-12 col-xs-12" >
                    <center>
                        <label class="control-label col-md-12 col-sm-12 col-xs-12" style="margin-bottom:5px;margin-top:5px;font-size:19px;font-weight:normal;" >
                            Clinic Address
                        </label>
                    </center>
                    <div lass="col-md-12 col-sm-12 col-xs-12">
                      <input type="text" name="contact_address" class="form-control col-md-7 col-xs-12" value="' . $key_settings->contact_address . '" autocomplete="off" aria-autocomplete="list" aria-expanded="false" aria-haspopup="true" role="combobox" spellcheck="false"  >
                    </div>
                  </div>';

                    $options_for_user = (unserialize($key_settings->options_for_user));

                    if ($options_for_user[0] == 't')
                    {
                        $money_console_status_trick_text = 'checked';
                    } else
                    {
                        $money_console_status_trick_text = '';
                    }

                    echo '
                    <div class="form-group col-md-12 col-sm-12 col-xs-12" style="margin-top:35px;" >
                        <center>
                            <label class="control-label col-md-12 col-sm-12 col-xs-12" style="margin-bottom:5px;margin-top:5px;font-size:19px;font-weight:normal;" >
                                Select the below box to activate the financial section
                            </label>
                        </center>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <input type="checkbox" name="money_console_status" class="form-control" value="true" autocomplete="off"  aria-expanded="false" aria-haspopup="true" role="combobox" spellcheck="false" ' . $money_console_status_trick_text . ' >
                        </div>
                    </div>';

                    // Explode and array these cms_menu_title.
                    $cms_menu_title = explode(",", $key_settings->cms_menu_title);

                    echo '
                    <div class="form-group col-md-12 col-sm-12 col-xs-12" style="border-top:1px solid #aba5a5;padding-top:50px;" >
                    
                        <center>
                            <label class="control-label col-md-12 col-sm-12 col-xs-12" style="margin-bottom:5px;margin-top:5px;font-size:19px;font-weight:normal;" >
                                In the following section, you can change the title of the tab on the patient\'s medical records page  
                                <br>
                                <br>
                                The arranging flow of the fields below from right to left will be same as arranging the tabs on the patient\'s medical record page
                                <br>
                                <br>
                                Leaving a field blank will disabled the relevant tab on the patient\'s medical record page
                                <br>
                                <br>
                                After making the changes, be sure to click on the "Update Settings of Software" button
                                <br>
                                <br>
                                Go to the patient\'s medical records page to view the updated Title of tabs
                            </label>
                        </center>
                        <hr style="width:1px;" >
                        
                        <div class="col-md-12 col-sm-12 col-xs-12" >
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <center>
                                    <h2 class="text-center" style="text-align:center;float:none;">
                                        Patient Previous Records
                                    </h2>
                                </center>
                                <input type="text" name="cms_menu_title_5" class="form-control" value="' . $cms_menu_title[5] . '" autocomplete="off" aria-expanded="false" aria-haspopup="true" role="combobox" spellcheck="false"  >
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <center>
                                    <h2 class="text-center" style="text-align:center;float:none;">
                                        Default Predefined Medicines
                                    </h2>
                                </center>
                                <input type="text" name="cms_menu_title_4" class="form-control" value="' . $cms_menu_title[4] . '" autocomplete="off" aria-expanded="false" aria-haspopup="true" role="combobox" spellcheck="false"  >
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <center>
                                    <h2 class="text-center" style="text-align:center;float:none;">
                                        Default Predefined Recommendations
                                    </h2>
                                </center>
                                <input type="text" name="cms_menu_title_3" class="form-control" value="' . $cms_menu_title[3] . '" autocomplete="off" aria-expanded="false" aria-haspopup="true" role="combobox" spellcheck="false"  >
                            </div>
                        </div>
                        
                        <div class="col-md-12 col-sm-12 col-xs-12">    
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <center>
                                    <h2 class="text-center" style="text-align:center;float:none;">
                                        Default Predefined Next Appointments
                                    </h2>
                                </center>
                                <input type="text" name="cms_menu_title_2" class="form-control" value="' . $cms_menu_title[2] . '" autocomplete="off" aria-expanded="false" aria-haspopup="true" role="combobox" spellcheck="false"  >
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <center>
                                    <h2 class="text-center" style="text-align:center;float:none;">
                                        Para Clinic Section
                                    </h2>
                                </center>
                                <input type="text" name="cms_menu_title_1" class="form-control" value="' . $cms_menu_title[1] . '" autocomplete="off" aria-expanded="false" aria-haspopup="true" role="combobox" spellcheck="false"  >
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <center>
                                    <h2 class="text-center" style="text-align:center;float:none;">
                                        Previous Medical EHR of Patient	
                                    </h2>
                                </center>
                                <input type="text" name="cms_menu_title_0" class="form-control" value="' . $cms_menu_title[0] . '" autocomplete="off" aria-expanded="false" aria-haspopup="true" role="combobox" spellcheck="false"  >
                            </div>
                        </div>
                        
                        <div class="col-md-12 col-sm-12 col-xs-12">
                         
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <center>
                                    <h2 class="text-center" style="text-align:center;float:none;">
                                        Charts	
                                    </h2>
                                </center>
                                <input type="text" name="cms_menu_title_9" class="form-control" value="' . $cms_menu_title_trick[9] . '" autocomplete="off" aria-expanded="false" aria-haspopup="true" role="combobox" spellcheck="false"  >
                            </div>
        
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <center>
                                    <h2 class="text-center" style="text-align:center;float:none;">
                                        Chart 1	
                                    </h2>
                                </center>
                                <input type="text" name="cms_menu_title_10" class="form-control" value="' . $cms_menu_title_trick[10] . '" autocomplete="off" aria-expanded="false" aria-haspopup="true" role="combobox" spellcheck="false" >
                            </div>
        
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <center>
                                    <h2 class="text-center" style="text-align:center;float:none;">
                                        Chart 2	
                                    </h2>
                                </center>
                                <input type="text" name="cms_menu_title_11" class="form-control" value="' . $cms_menu_title_trick[11] . '" autocomplete="off" aria-expanded="false" aria-haspopup="true" role="combobox" spellcheck="false" >
                            </div>
        
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <center>
                                    <h2 class="text-center" style="text-align:center;float:none;">
                                       Chart 3	
                                    </h2>
                                </center>
                                <input type="text" name="cms_menu_title_12" class="form-control" value="' . $cms_menu_title_trick[12] . '" autocomplete="off" aria-expanded="false" aria-haspopup="true" role="combobox" spellcheck="false" >
                            </div>
        
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <center>
                                    <h2 class="text-center" style="text-align:center;float:none;">
                                        Chart 4	
                                    </h2>
                                </center>
                                <input type="text" name="cms_menu_title_13" class="form-control" value="' . $cms_menu_title_trick[13] . '" autocomplete="off" aria-expanded="false" aria-haspopup="true" role="combobox" spellcheck="false"  >
                            </div>
                        
                        </div>
                    </div>
                    
                    <div class="form-group col-md-12 col-sm-12 col-xs-12" >
                    
                        <div class="col-md-12 col-sm-12 col-xs-12"  >
                            <div class="col-md-12 col-sm-12 col-xs-12"  >
                                <center>
                                    <h2 class="text-center" >
                                        The patient\'s first fixed sheet
                                    </h2>
                                </center>
                                <input type="text" name="cms_menu_title_7" class="form-control" value="' . $cms_menu_title[7] . '" autocomplete="off" aria-expanded="false" aria-haspopup="true" role="combobox" spellcheck="false" >
                            </div>
                        </div>
                        <hr style="width:1px;" >
                        <div class="col-md-12 col-sm-12 col-xs-12" style="border-bottom:1px solid #aba5a5;padding-bottom:50px;" >
                            <div class="col-md-12 col-sm-12 col-xs-12" >
                                <center>
                                    <h2 class="text-center"  >
                                        The patient\'s second fixed sheet	
                                    </h2>
                                </center>
                                <input type="text" name="cms_menu_title_8" class="form-control" value="' . $cms_menu_title[8] . '" autocomplete="off" aria-expanded="false" aria-haspopup="true" role="combobox" spellcheck="false" >
                            </div>
                        </div>
                        
                        <div class="col-md-12 col-sm-12 col-xs-12" >
                         
                         <hr style="margin-top:25px;">
                         <br>
                         
                            <div class="col-md-4 col-sm-4 col-xs-12" >
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <center>
                                        <h2 class="text-center" style="text-align:center;float:none;">
                                           Search Patients
                                        </h2>
                                    </center>
                                    <input type="text" name="cms_menu_title_14" class="form-control" value="' . $cms_menu_title_trick[14] . '" autocomplete="off" aria-expanded="false" aria-haspopup="true" role="combobox" spellcheck="false" >
                                </div>
                                
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <center>
                                        <h2 class="text-center" style="text-align:center;float:none;">
                                           Submit New Patient
                                        </h2>
                                    </center>
                                    <input type="text" name="cms_menu_title_15" class="form-control" value="' . $cms_menu_title_trick[15] . '" autocomplete="off" aria-expanded="false" aria-haspopup="true" role="combobox" spellcheck="false" >
                                </div>
                            </div>
                            
                            <div class="col-md-3 col-sm-3 col-xs-12" >
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <center>
                                        <h2 class="text-center" style="text-align:center;float:none;">
                                            Appointments
                                        </h2>
                                    </center>
                                    <input type="text" name="cms_menu_title_16" class="form-control" value="' . $cms_menu_title_trick[16] . '" autocomplete="off" aria-expanded="false" aria-haspopup="true" role="combobox" spellcheck="false" >
                                </div>
                            </div>
        
                            <div class="col-md-5 col-sm-5 col-xs-12" >
                            
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <center>
                                        <h2 class="text-center" style="text-align:center;float:none;">
                                            Welcome
                                        </h2>
                                    </center>
                                    <input type="text" name="cms_menu_title_17" class="form-control" value="' . $cms_menu_title_trick[17] . '" autocomplete="off" aria-expanded="false" aria-haspopup="true" role="combobox" spellcheck="false" >
                                </div>
            
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <center>
                                        <h2 class="text-center" style="text-align:center;float:none;">
                                           Appointment on a Specific Date
                                        </h2>
                                    </center>
                                    <input type="text" name="cms_menu_title_18" class="form-control" value="' . $cms_menu_title_trick[18] . '" autocomplete="off" aria-expanded="false" aria-haspopup="true" role="combobox" spellcheck="false" >
                                </div>
        
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <center>
                                        <h2 class="text-center" style="text-align:center;float:none;">
                                            Appointments Reminder by Bot
                                        </h2>
                                    </center>
                                    <input type="text" name="cms_menu_title_19" class="form-control" value="' . $cms_menu_title_trick[19] . '" autocomplete="off" aria-expanded="false" aria-haspopup="true" role="combobox" spellcheck="false" >
                                </div>
            
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <center>
                                        <h2 class="text-center" style="text-align:center;float:none;">
                                            Financial Management
                                        </h2>
                                    </center>
                                    <input type="text" name="cms_menu_title_20" class="form-control" value="' . $cms_menu_title_trick[20] . '" autocomplete="off" aria-expanded="false" aria-haspopup="true" role="combobox" spellcheck="false" >
                                </div>
            
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <center>
                                        <h2 class="text-center" style="text-align:center;float:none;">
                                            Submit a Financial Transaction
                                        </h2>
                                    </center>
                                    <input type="text" name="cms_menu_title_21" class="form-control" value="' . $cms_menu_title_trick[21] . '" autocomplete="off" aria-expanded="false" aria-haspopup="true" role="combobox" spellcheck="false" >
                                </div>
            
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <center>
                                        <h2 class="text-center" style="text-align:center;float:none;">
                                           Financial Transactions Report
                                        </h2>
                                    </center>
                                    <input type="text" name="cms_menu_title_22" class="form-control" value="' . $cms_menu_title_trick[22] . '" autocomplete="off" aria-expanded="false" aria-haspopup="true" role="combobox" spellcheck="false" >
                                </div>
            
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <center>
                                        <h2 class="text-center" style="text-align:center;float:none;">
                                            Financial Settings of Receiving Money (Just Accessible for Admin)
                                        </h2>
                                    </center>
                                    <input type="text" name="cms_menu_title_23" class="form-control" value="' . $cms_menu_title_trick[23] . '" autocomplete="off" aria-expanded="false" aria-haspopup="true" role="combobox" spellcheck="false" >
                                </div>
            
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <center>
                                        <h2 class="text-center" style="text-align:center;float:none;">
                                             Change Password
                                        </h2>
                                    </center>
                                    <input type="text" name="cms_menu_title_24" class="form-control" value="' . $cms_menu_title_trick[24] . '" autocomplete="off" aria-expanded="false" aria-haspopup="true" role="combobox" spellcheck="false" >
                                </div>
                                
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <center>
                                        <h2 class="text-center" style="text-align:center;float:none;">
                                             Settings Of Software
                                        </h2>
                                    </center>
                                    <input type="text" name="cms_menu_title_25" class="form-control" value="' . $cms_menu_title_trick[25] . '" autocomplete="off" aria-expanded="false" aria-haspopup="true" role="combobox" spellcheck="false" >
                                </div>
            
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <center>
                                        <h2 class="text-center" style="text-align:center;float:none;">
                                           Supporting 
                                        </h2>
                                    </center>
                                    <input type="text" name="cms_menu_title_26" class="form-control" value="' . $cms_menu_title_trick[26] . '" autocomplete="off" aria-expanded="false" aria-haspopup="true" role="combobox" spellcheck="false" >
                                </div>
                                
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <center>
                                        <h2 class="text-center" style="text-align:center;float:none;">
                                            Help
                                        </h2>
                                    </center>
                                    <input type="text" name="cms_menu_title_27" class="form-control" value="' . $cms_menu_title_trick[27] . '" autocomplete="off" aria-expanded="false" aria-haspopup="true" role="combobox" spellcheck="false" >
                                </div>
                                
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <center>
                                        <h2 class="text-center" style="text-align:center;float:none;">
                                            Logout
                                        </h2>
                                    </center>
                                    <input type="text" name="cms_menu_title_28" class="form-control" value="' . $cms_menu_title_trick[28] . '" autocomplete="off" aria-expanded="false" aria-haspopup="true" role="combobox" spellcheck="false" >
                                </div>
                                
                                
        
                            </div>
                        
                         </div>
                    
                      <div class="form-group col-md-12 col-sm-12 col-xs-12" style="margin-top:30px;margin-bottom:150px;" >
    
                        <center>
                            <label class="control-label col-md-12 col-sm-12 col-xs-12" style="margin-bottom:5px;margin-top:5px;font-size:19px;font-weight:normal;" >
                                 Remaining SMS credit: ' . $key_settings->notif_sms_credit . '
                            </label>
                        </center>
                        <div lass="col-md-12 col-sm-12 col-xs-12">
                          <div class="form-control col-md-7 col-xs-12" style="border:0px solid;background:none;-webkit-box-shadow: none;text-align: center;padding-left: 0px!important;" contenteditable="false" >
                            The cost of sending each SMS is 60 Tomans
                            <br>
                            <br>
                            Please call 09125790902 to recharge your SMS credit.
                          </div>
                        </div>
    
                      </div>
                      
                  <button type="submit" name="setting_status" value="true" class="btn btn-success btn-group-justified uiuxtrick" style="font-size:27px;position: fixed;bottom: 0px;right: 0px;z-index: 1;" >
                        Update Settings of Software
                  </button>	
    
                </form>';

                }

                echo '
			  </div>
		  </div>
		</div>
     
    </div>
</div>      
<!-- /page content -->' ;

// Call the footer include.
include 'layout/footer.php' ;
?>

<!-- jQuery Tags Input -->
<script>
function onAddTag(tag) {
alert("افزودن مورد: " + tag);
}

function onRemoveTag(tag) {
alert("حذف مورد: " + tag);
}

function onChangeTag(input, tag) {
alert("تغییر مورد: " + tag);
}

$(document).ready(function() {
$('#tags_00').tagsInput({
  width: 'auto'
});
});

$(document).ready(function() {
$('#tags_0').tagsInput({
  width: 'auto'
});
});

$(document).ready(function() {
$('#tags_1').tagsInput({
  width: 'auto'
});
});

$(document).ready(function() {
$('#tags_2').tagsInput({
  width: 'auto'
});
});

$(document).ready(function() {
$('#tags_3').tagsInput({
  width: 'auto'
});
});

$(document).ready(function() {
$('#tags_4').tagsInput({
  width: 'auto'
});
});
</script>
<!-- /jQuery Tags Input -->
