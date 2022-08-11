<?php
// Add your custom css files here. (will be located in header section)
$extra_links_header = '' ;
$extra_links_footer = '
<!-- jQuery Tags Input -->
<script src="'.url('back/vendors/jquery.tagsinput/src/jquery.tagsinput.js').'"></script>' ;

// Call the header section
include_once 'layout/header.php' ;

?>
<style>
span.tag
    {
        font-size:23px;
    }

.modal-dialog {
    width: 100%;
    height: 100%;
    margin: 0;
    padding: 0;
}

.modal-content {
    height: auto;
    min-height: 100%;
    border-radius: 0;
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
			  <div class="form-group col-md-12 col-sm-12 col-xs-12" >
			  
                <center><h3>List of all users</h3></center>';

                    foreach( $result_of_all_users_related_to_this_super_admin as $key )
                    {
                        $cms_menu_title_trick = explode(",", $key->cms_menu_title) ;
                        $random_string = mt_rand('0' , '1000000') ;
                        echo '
                        <!-- Button trigger modal -->
                        <button type="button" class="col-md-12 col-sm-12 col-xs-12 btn btn-'.config('global.'.$key->status).'" data-toggle="modal" data-target="#user_detail_'.$random_string.'" style="margin:5px 5px 5px 5px;font-size:2.5vw;margin-top:20px;" >
                            <span class="fa fa-user-md" ></span> '.$key->name.' => '.ucwords($key->status).' ('.ucwords(config('global.'.$key->user_level)).')
                        </button>
                        
                        <!-- START Modal -->
                        <div class="modal fade" id="user_detail_'.$random_string.'" tabindex="-1'.$random_string.'" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            
                              <div class="modal-header">
                                    <div class="col-md-9" style="margin-top:20px;">
                                        <h3 class="modal-title" id="exampleModalLabel"  >
                                            <center>
                                                <span class="fa fa-user-md" ></span> Name: '.$key->name.'
                                            </center>
                                        </h3>
                                    </div>
                                    <div class="col-md-3">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
                                      <span aria-hidden="true" style="font-size:74px!important;">&times;</span>
                                    </button>
                                    </div>
                              </div>
                              
                              <div class="modal-body" style="overflow: auto!important;" >
                              
                                    <div class="col-md-12 col-sm-12 col-xs-12" >
                                    <form method="post" action="'.route('update_user_info_by_super_admin' ).'" id="medical-file-form" >
                                        <input type="hidden" name="_token" value="'.csrf_token().'" >
                                        <input type="hidden" name="name_of_user" value="'.$key->name.'" >
                                        <input type="hidden" name="id_of_user" value="'.encrypt_decrypt( 'encrypt', $key->id ).'" >
                                         
                                        <h3 class="modal-title" id="exampleModalLabel"  >
                                            <center>
                                                Current Status: '.ucwords($key->status).'
                                                <div class="col-md-12 col-sm-12 col-xs-12" >
                                                    <select name="status_of_user" id="status_of_user_'.$key->remember_token.'" class="col-md-12 col-sm-12 col-xs-12" >' ;

                                                      if( $key->status === config('global.active') )
                                                      {
                                                        $selected_value_trick = '
                                                        <option value="'.config('global.active').'" selected >Active</option>
                                                        <option value="'.config('global.ban').'">Change to Ban</option>' ;
                                                      }
                                                      elseif( $key->status === config('global.ban') )
                                                      {
                                                          $selected_value_trick = '
                                                          <option value="'.config('global.ban').'" selected >Ban</option>
                                                          <option value="'.config('global.active').'">Change to Active</option>' ;
                                                      }

                                                      echo
                                                      $selected_value_trick.'
                                                    </select>
                                                </div>
                                                <hr>
                                                <hr>
                                                Current Level: '.$key->user_level.' => ('.ucwords(config('global.'.$key->user_level)).')
                                                <br>
                                                <div class="col-md-12 col-sm-12 col-xs-12" >
                                                    <select name="level_of_user" id="level_of_user_'.$key->remember_token.'" class="col-md-12 col-sm-12 col-xs-12" >' ;

                                                        if( $key->user_level == config('global.guest_level') )
                                                        {
                                                            $selected_value_trick_2 = '
                                                            <option value="'.config('global.guest_level').'" selected >Guest</option>
                                                            <option value="'.config('global.user_level').'">Change to User</option>
                                                            <option value="'.config('global.admin_level').'">Change to Admin</option>' ;
                                                        }
                                                        elseif( $key->user_level == config('global.user_level') )
                                                        {
                                                            $selected_value_trick_2 = '
                                                            <option value="'.config('global.user_level').'" selected >User</option>
                                                            <option value="'.config('global.guest_level').'" >Change to Guest</option>
                                                            <option value="'.config('global.admin_level').'">Change to Admin</option>' ;
                                                        }
                                                        elseif( $key->user_level == config('global.admin_level') )
                                                        {
                                                            $selected_value_trick_2 = '
                                                            <option value="'.config('global.admin_level').'" selected >Admin</option>
                                                            <option value="'.config('global.user_level').'" >Change to User</option>
                                                            <option value="'.config('global.guest_level').'" >Change to Guest</option>' ;
                                                        }

                                                      echo $selected_value_trick_2.'
                                                    </select>
                                                </div>
                                            </center>
                                            <hr>
                                            &nbsp;
                                            <br>
                                            User Profile Created at: '.$key->created_at.'
                                            <hr>
                                            User Profile Updated at: '.$key->updated_at.'
                                            <hr>
                                        </h3>
                                    
                                          <div class="form-group col-md-12 col-sm-12 col-xs-12" style="border-bottom:1px solid #aba5a5;padding-bottom:50px;" >
                                            <center>
                                                <label class="control-label col-md-12 col-sm-12 col-xs-12" style="margin-bottom:5px;margin-top:5px;font-size:19px;font-weight:normal;" >
                                                    Names of the doctors who work in clinic			
                                                </label>
                                            </center>
                                            <div class="col-md-12 col-sm-12 col-xs-12" >
                                              <input id="tags_00'.$key->remember_token.'" type="text" name="clinic_doctors_name" class="tags form-control" value="' . $key->clinic_doctors_name . '" > 
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
                                              <input id="tags_0'.$key->remember_token.'" type="text" name="common_hypersensitivity" class="tags form-control" value="' . $key->common_hypersensitivity . '" > 
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
                                              <input id="tags_1'.$key->remember_token.'" type="text" name="common_drug" class="tags form-control" value="' . $key->common_drug . '" > 
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
                                              <input id="tags_2'.$key->remember_token.'" type="text" name="common_diet" class="tags form-control" value="' . $key->common_diet . '" > 
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
                                              <input id="tags_3'.$key->remember_token.'" type="text" name="common_return_date" class="tags form-control" value="' . $key->common_return_date . '" > 
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
                                              <input type="text" name="gap_time_between_appointments" class="form-control col-md-7 col-xs-12" value="' . $key->gap_time_between_appointments . '" autocomplete="off" aria-autocomplete="list" aria-expanded="false" aria-haspopup="true" role="combobox" spellcheck="false"  >
                                            </div>
                                          </div>
                            
                                          <div class="form-group col-md-12 col-sm-12 col-xs-12" >
                                            <center>
                                                <label class="control-label col-md-12 col-sm-12 col-xs-12" style="margin-bottom:5px;margin-top:5px;font-size:19px;font-weight:normal;" >
                                                    Clinic Phone Number
                                                </label>
                                            </center>
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                              <input type="text" name="phone_number" class="form-control col-md-7 col-xs-12 has-feedback-right" value="' . $key->phone_number . '" autocomplete="off" aria-autocomplete="list" aria-expanded="false" aria-haspopup="true" role="combobox" spellcheck="false" >
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
                                              <input type="text" name="college_branch" class="form-control col-md-7 col-xs-12" value="' . $key->college_branch . '" autocomplete="off" aria-autocomplete="list" aria-expanded="false" aria-haspopup="true" role="combobox" spellcheck="false"  >
                                            </div>
                                          </div>
                                          
                                          <div class="form-group col-md-12 col-sm-12 col-xs-12" >
                                            <center>
                                                <label class="control-label col-md-12 col-sm-12 col-xs-12" style="margin-bottom:5px;margin-top:5px;font-size:19px;font-weight:normal;" >
                                                    Clinic Address
                                                </label>
                                            </center>
                                            <div lass="col-md-12 col-sm-12 col-xs-12">
                                              <input type="text" name="contact_address" class="form-control col-md-7 col-xs-12" value="' . $key->contact_address . '" autocomplete="off" aria-autocomplete="list" aria-expanded="false" aria-haspopup="true" role="combobox" spellcheck="false"  >
                                            </div>
                                          </div>';

                                            $options_for_user = (unserialize($key->options_for_user));

                                            if ($options_for_user[0] === 't')
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
                                            </div>
                                            
                                            <div class="col-md-12" >

                                                <center>
                                                    <h3>Types of Financial Services</h3>
                                                    <label class="control-label col-md-12 col-sm-12 col-xs-12" style="margin-bottom:5px;font-size:19px;font-weight:normal;" >
                                                        Please enter the name of the service and the cost of the service only in the below format in example,
                                                        <br>
                                                        and then press the ENTER key on your keyboard for the next service
                                                    </label>
                                                    
                                                    <label class="control-label col-md-12 col-sm-12 col-xs-12" style="margin-bottom:25px;margin-top:15px;font-size:19px;font-weight:normal;" >
                                                         <span data-toggle="collapse" data-target="#more_details" class="btn-primary btn-lg" type="button" style="cursor:pointer;color:gray;background-color:white;border:1px solid #bfbdbd;" >
                                                             <span class="glyphicon glyphicon-plus" aria-hidden="true" style="color:#ccc;margin-left:5px;" ></span>
                                                             Example 
                                                         </span>
                                                        
                                                        <div id="more_details" class="collapse col-md-12 col-sm-12 col-xs-12">
                                                            <center>
                                                                <div class="well col-md-12" align="center" style="float:none;" >
                                                                    <div class="well col-md-6 text-center"  style="float:none;" >
                                                                        Service name: Amount of your desire money of this service
                                                                    </div>
                                                                    <div class="well col-md-4" align="center" style="float:none;" >
                                                                        Visit Patient : 50000
                                                                    </div>
                                                                </div>
                                                            </center>
                                                        </div>
                                                    </label>
                                                            
                                                    <div class="col-md-12 col-sm-12 col-xs-12" style="font-size:22px!important;"  >
                                                       <textarea id="tags_financial'.$key->remember_token.'" type="text" name="financial_management" class="tags form-control" >'.$key->financial_management.'</textarea>
                                                      <div id="suggestions-container" ></div>
                                                    </div>
                                                    
                                                </center>
                        
                                              </div>';

                                            // Explode and array these cms_menu_title.
                                            $cms_menu_title = explode(",", $key->cms_menu_title);

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
                                            </div>
                                            
                                          <div class="form-group col-md-12 col-sm-12 col-xs-12" style="margin-top:30px;margin-bottom:150px;" >                  
                                            <center>
                                                <label class="control-label col-md-12 col-sm-12 col-xs-12" style="margin-bottom:5px;margin-top:5px;font-size:19px;font-weight:normal;" >
                                                     Remaining SMS credit: ' . $key->notif_sms_credit . '
                                                </label>
                                            </center>
                                          </div>
                                          
                                          <div class="modal-footer">
                                            <button type="button" class="btn btn-primary btn-lg btn-block" data-dismiss="modal">Close X</button>
                                          </div>
                                          <br>
                                          <hr>
                                          &nbsp;
                                          
                                          <button type="submit" name="setting_status" value="true" class="btn btn-success btn-group-justified uiuxtrick" style="font-size:27px;" >
                                                <i class="fa fa-mail-forward" aria-hidden="true"></i> Update '.$key->name.' Information
                                          </button>	
                            
                                    </form>
                                    </div>
                
                              </div>
                              
                            </div>
                          </div>
                        </div>
                        <!-- END Modal --> ';
                    }

                    echo '
			  </div>
		  </div>
		</div>
     
    </div>
</div>      
<!-- /page content -->' ;

// Call the footer
include_once 'layout/footer.php' ;

foreach( $result_of_all_users_related_to_this_super_admin as $key )
{
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
    $('#tags_00<?php echo $key->remember_token ; ?>').tagsInput({
      width: 'auto'
    });
    });

    $(document).ready(function() {
    $('#tags_0<?php echo $key->remember_token ; ?>').tagsInput({
      width: 'auto'
    });
    });

    $(document).ready(function() {
    $('#tags_1<?php echo $key->remember_token ; ?>').tagsInput({
      width: 'auto'
    });
    });

    $(document).ready(function() {
    $('#tags_2<?php echo $key->remember_token ; ?>').tagsInput({
      width: 'auto'
    });
    });

    $(document).ready(function() {
    $('#tags_3<?php echo $key->remember_token ; ?>').tagsInput({
      width: 'auto'
    });
    });

    $(document).ready(function() {
    $('#tags_4<?php echo $key->remember_token ; ?>').tagsInput({
      width: 'auto'
    });
    });

    function onAddTag(tag) {
		alert("Add Item: " + tag);
	  }

	  function onRemoveTag(tag) {
		alert("Delete Item: " + tag);
	  }

	  function onChangeTag(input, tag) {
		alert("Change Item: " + tag);
	  }

	  $(document).ready(function() {
		$('#tags_financial<?php echo $key->remember_token ; ?>').tagsInput({
		  width: 'auto' ,
		  height: 'auto'
		});
	  });
	</script>
    <!-- /jQuery Tags Input -->
    <?php
}
?>
