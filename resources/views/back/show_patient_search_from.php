<?php

// Add your custom css files here. (will located in header)
$extra_links_header = '
' ;

// Add your custom js files here. (will located in footer)
$extra_links_footer = '
' ;

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
        <form method="post" action="'.route('run_patient_search_form').'" id="medical-file-form" data-parsley-validate  >
            <input type="hidden" name="_token" value="'.csrf_token().'" >
            
            <center>
                <h4 class="col-md-12 col-sm-12 col-xs-12 text-center" align="center" style="direction:ltr;margin-top:40px;" >
                    <div class="col-md-12 col-sm-12 col-xs-12 text-center" align="center" >
                        your searching word should be based on just <b>1</b> of the below types
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
                        Medical Document Number
                    </div>
                    
                </h4>
                
                <hr style="width:1px;" >
                <div class="col-md-12 col-sm-12 col-xs-12" align="center" style="float:none;" >
                    <input type="text" name="search_text" style="text-align: left!important;float:none;" min="1" max="60" autocomplete="off" aria-autocomplete="list" aria-expanded="false" aria-haspopup="true" role="combobox" spellcheck="false" class="form-control" placeholder="Type your searching word based on ONE of these types: Name | Family | Mobile Number | Nationality Number | Medical Document Number" align="center" required >
                </div>
                
            </center>

            <button type="submit" name="Search" class="btn btn-success btn-lg btn-block uiuxtrick" style="font-size:28px;position: fixed;bottom: 0px;right: 0px;z-index: 1;margin-bottom:0px;margin-right:0px;" onclick="this.disabled=true;this.form.submit();" >
                Search
            </button>

        </form>
    </div>' ;

    // START of if we have result.
    if( isset($result_run_search_form) )
    {
        echo '
        <div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom:20px;margin-top:40px;">
            <div class="col-md-3 col-sm-3 col-xs-3">
                <h4>
                    <span style="font-weight:bolder;color:gray;" class="btn-link">
                        Name and Family
                    </span>
                </h4>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-3">
                <h4>
                    <span style="font-weight:bolder;color:gray;" class="btn-link">
                        Nationality Number 
                    </span>
                </h4>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-3">
                <h4>
                    <span style="font-weight:bolder;color:gray;" class="btn-link">
                        Mobile Number 
                    </span>
                </h4>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-3">
                <h4>
                    <span style="font-weight:bolder;color:gray;" class="btn-link">
                        Medical Document Number
                    </span>
                </h4>
            </div>
            
        </div>
        <br>';

        // START of foreach.
        foreach ( $result_run_search_form as $key )
        {
            echo '
            <div class="col-md-12 col-sm-12 col-xs-12 well" >
                
                <div class="col-md-3 col-sm-3 col-xs-3 btn-link">
                    <h3 style="color:gray;" >
                        '.$key->patient_first_name.' '.$key->patient_last_name.'
                    </h3>
                </div>
                
                <div class="col-md-3 col-sm-3 col-xs-3 btn-link">
                    <h3 style="color:gray;" >
                        '.$key->patient_nationality_number.'
                    </h3>
                </div>
                
                <div class="col-md-3 col-sm-3 col-xs-3 btn-link">
                    <h3 style="color:gray;" >
                        '.$key->patient_mobile_number ;

                        // START OF IF DR TELEGRAM ACTIVATED.
                        if( isset($key->telegram) )
                        {
                            if( $key->telegram == 'true' )
                            {
                                if( strlen($key->sicker_from_external_platform_id) > 0  )
                                {
                                    echo '
                                    <div style="float:left;font-size:13px;margin-left:10px;" class="col-md-12 col-sm-12 col-xs-12" >
                                        This patient is connected to Telegram
                                        <span class="glyphicon glyphicon-ok" aria-hidden="true" ></span>
                                    </div>' ;
                                }
                                else
                                {
                                    echo '
                                    <div style="float:left;font-size:13px;margin-left:10px;color:red" class="col-md-12 col-sm-12 col-xs-12" >
                                        This patient is NOT connected to Telegram
                                        <span class="glyphicon glyphicon-remove" aria-hidden="true" ></span>
                                    </div>' ;
                                }
                            }
                        } // END OF IF DR TELEGRAM ACTIVATED.

                    echo '
                    </h3>
                </div>
                
                <div class="col-md-3 col-sm-3 col-xs-3 btn-link">
                    <h3 style="color:gray;text-align:center;" >
                        '.$key->patient_id.'
                    </h3>
                </div>

                <br>
                <hr style="width:1px;" >

                <div class="col-md-12 col-sm-12 col-xs-12" >
                    <a href="'.route('show_patients_ehr_document_page' , [ 'patient_id' => $key->patient_id , 'related_appointment_id' => '0' , 'child_dr_related_name' => 'free' ] ).'" class="text-center uiuxtrick" >
                        <div class="col-md-4 col-sm-4 col-xs-12 btn btn-default" style="border:1px solid #e3e3e3;float:right;color:#337ab7;padding-top: 15px;padding-bottom: 15px;" >
                             <i class="fa fa-clone"></i>
                             Medical Document
                        </div>
                    </a>
                    <a href="" class="text-center uiuxtrick" >
                        <div class="col-md-4 col-sm-4 col-xs-12 btn btn-default" style="border:1px solid #e3e3e3;float:right;color:#337ab7;padding-top: 15px;padding-bottom: 15px;" >
                             <i class="glyphicon glyphicon-tags"></i>&nbsp;
                             Medical Prescriptions
                        </div>
                    </a>
                    <a href="'.route('edit_patient_form', $key->patient_id ).'" class="text-center uiuxtrick" >
                        <div class="col-md-3 col-sm-3 col-xs-12 btn btn-default" style="border:1px solid #e3e3e3;float:right;color:#337ab7;padding-top: 15px;padding-bottom: 15px;" >
                              <i class="fa fa-edit"></i>
                             Book Appointment | Edit Info
                        </div>
                    </a>
                </div>

            </div>' ;

        } // END of foreach.

        // Put this piece of code to make a gap between search button and the last result for better UX
        echo '<hr style="width:1px;" >' ;

    } // END of if we have result.

echo '
</div>      
<!-- /page content -->' ;

// Call the footer include.
include 'layout/footer.php' ;
?>
