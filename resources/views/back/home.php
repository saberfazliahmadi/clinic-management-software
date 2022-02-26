<?php

// Add your custom css files here.
use Illuminate\Support\Facades\Auth;

$extra_links_header = '' ;
// Add your custom js files here.
$extra_links_footer = '' ;

// call the header include.
include 'layout/header.php' ;

if(isset($show_ehr_report))
{

?>
<style>
    /* The device with borders */
    .smartphone {
        position: relative;
        width: 360px;
        height: auto;
        margin: auto;
        border: 16px black solid;
        border-top-width: 60px;
        border-bottom-width: 60px;
        border-radius: 36px;
    }

    /* The horizontal line on the top of the device */
    .smartphone:before {
        content: '';
        display: block;
        width: 60px;
        height: 5px;
        position: absolute;
        top: -30px;
        left: 50%;
        transform: translate(-50%, -50%);
        background: #333;
        border-radius: 10px;
    }

    /* The circle on the bottom of the device */
    .smartphone:after {
        content: '';
        display: block;
        width: 35px;
        height: 35px;
        position: absolute;
        left: 50%;
        bottom: -65px;
        transform: translate(-50%, -50%);
        background: #333;
        border-radius: 50%;
    }

    /* The screen (or content) of the device */
    .smartphone .contentphone {
        width: auto;
        height: auto;
        background: white;
        padding-right:30px;
        padding-left:30px;
    }
</style>

<?php

$telegram_text_content = '' ;
$cms_menu_title = explode("," , Auth::user()->cms_menu_title)  ;

if( strlen($EHR_document_prescribed_common_drug) > 0 )
{
    // Make a trick to prevent from POST method error (post method should'nt have Space in him content)
    $common_drug 			= str_replace( "_" , " " , $EHR_document_prescribed_common_drug ) 		;
    $common_drug 			= str_replace( "," , "<br>" , $common_drug )   ;
    $telegram_text_content .= $cms_menu_title[4].':<br>'.$common_drug ;
}

if( strlen($EHR_document_prescribed_common_diet) > 0 )
{
    // Make a trick to prevent from POST method error (post method should'nt have Space in him content)
    $common_diet 		   = str_replace( "_" , " " , $EHR_document_prescribed_common_diet )        ;
    $common_diet 		   = str_replace( "," , "<br>" , $common_diet )   ;
    $telegram_text_content .= '<br>'.$cms_menu_title[3].':<br>'.$common_diet ;
}

if( strlen($EHR_document_prescribed_next_appointment) > 0 )
{
    // Make a trick to prevent from POST method error (post method should'nt have Space in him content)
    $common_return_date_text = str_replace( "_" , " " , $EHR_document_prescribed_next_appointment ) ;
    $common_return_date_text = str_replace( "," , "<br>" , $common_return_date_text ) 			 ;
    // Make a trick to prevent from POST method error (post method should'nt have Space in him content)
    $telegram_text_content  .= '<br>'.$cms_menu_title[2].':<br>'.$common_return_date_text ;
}

// Remove some character to prevent GET conflicting or crashing error
$telegram_text_content = str_replace( "&" , ""    , $telegram_text_content ) 				   ;
$telegram_text_content = str_replace( "=" , ""    , $telegram_text_content ) 				   ;
$telegram_text_content = str_replace( "#" , ""    , $telegram_text_content ) 				   ;
$telegram_text_content = str_replace( "~" , ""    , $telegram_text_content ) 				   ;

echo '
<center>
        <div style="margin-top:0px;" class="col-md-12 col-sm-12 col-xs-12" align="center" >
            <h1 style="text-align:center;font-size:17pt;margin-top:10px;" align="center" >
                <div class="col-md-12 col-sm-12 col-xs-12" >
                    <span class="glyphicon glyphicon-ok" aria-hidden="true" style="color:green;"></span>
                    '.$title_of_page.'
                </div>
                <br>
                <br>
            </h1>
        </div>
</center>
<br>
<br>
<center>
    <div style="margin-top:15px;" class="col-md-12 col-sm-12 col-xs-12" align="center" >
        <h1 style="text-align:center;font-size:17pt;margin-top:10px;;" align="center" >
            <div class="col-md-12 col-sm-12 col-xs-12" >
                This information will be sent to patient smartphone by BOT
                <br>
                <br>
                
                <div class="smartphone">
                    <div class="contentphone">
                        <br>
                        In the name of God
                        <br>
                        <br>
                        '.$telegram_text_content.'
                        <br>
                        Your health is our wish
                        <br>
                        This message was sent to you on date '.date("Y/m/d").'
                    </div>
                </div>
                
            </div>
            <br>
            <br>
        </h1>
    </div>
</center>
</div>' ;
}
else
{
echo '
<!-- page content -->
<div class="right_col" role="main">
   
    <div style="width: 100%;height: 80px;padding: 10px 0;margin-bottom:100px;" >
      <center>
         <h3 style="text-align:center;">
             Welcome to Clinic Management Software
             <br>
         </h3>
      </center>
    </div>
    
    <div class="col-md-12 col-sm-12 col-xs-12 form_wizard wizard_horizontal" style="font-size:20px!important;" >
      <ul class="wizard_steps">
      
        <li>
          <a href="' . route('submit_new_patient_form') . '" >
            <span class="step_no">1</span>
            <span class="step_descr">
                <center>
                    <i class="glyphicon glyphicon-plus"></i>
                   Submit New Patient 
                </center>
              </span>
          </a>
        </li>
    
        <li>
          <a href="' . route('submit_new_patient_form') . '" >
            <span class="step_no">2</span>
            <span class="step_descr">
                <center>
                    <i class="fa fa-list"></i>
                   Booking an Appointment 
                </center>
            </span>
          </a>
        </li>
    
        <li>
          <a href="">
            <span class="step_no">3</span>
            <span class="step_descr">
                <center>
                    <i class="fa fa-clone"></i>
                   Send Patient to Doctors Room by <br> Patient Medical EHR 
                </center>
              </span>
          </a>
        </li>
    
        <li>
          <a href="' . route('show_form_of_appointments_on_specific_date') . '" >
            <span class="step_no">4</span>
            <span class="step_descr">
                <center>
                    <i class="glyphicon glyphicon-phone"></i>
                     Automatically SMS Reminder 
                </center>
              </span>
          </a>
        </li>
    
      </ul>
    </div>
    
    <center>
        <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top:40px;" >
            <div data-toggle="collapse" data-target="#more_details" class="btn btn-primary col-md-6 col-sm-6 col-xs-6" type="button" style="color:gray;background-color:white;border:1px solid #bfbdbd;float:none;font-size:21px;" >
                <span class="glyphicon glyphicon-plus" aria-hidden="true" style="color:#ccc;margin-left:5px;"></span>
                More Description
            </div>
        </div>
    </center>
        
    <div id="more_details" class="collapse col-md-12 col-sm-12 col-xs-12">
        <div class="clearfix"></div>
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12" >
                <!-- Smart Wizard -->
                <div id="wizard" class="form_wizard wizard_horizontal">
                  <br>
                  <div id="step-1" style="border:0px;">
                    <center><h1 class="StepTitle well" style="text-align:center;border:0px solid white;margin-right:40px;margin-left:40px;    background: #F7F7F7;" >Step 1: the patient will be submitted by the secretary</h1></center>
                  </div>
        
                  <div id="step-2" style="border:0px;">
                    <center><h1 class="StepTitle well" style="text-align:center;border:0px solid white;margin-right:40px;margin-left:40px;    background: #F7F7F7;" >Step 2: the secretary gives the patient an appointment</h1></center>
                  </div>
                    
                  <div id="step-3" style="border:0px;">
                    <center><h1 class="StepTitle well" style="text-align:center;border:0px solid white;margin-right:40px;margin-left:40px;    background: #F7F7F7;" >Step 3: the patient enters the doctor\'s room and the patient\'s EHR is displayed on the doctor\'s screen</h1></center>
                  </div>
                
                  <div id="step-4" style="border:0px;">
                    <center><h1 class="StepTitle well" style="text-align:center;border:0px solid white;margin-right:40px;margin-left:40px;    background: #F7F7F7;" >Step 4: an SMS containing recommendations and prescribed medications will automatically sent to the patient mobile number</h1></center>
                  </div>
                </div>
                <!-- End SmartWizard Content -->
          </div>
        </div>
    </div>	
    
    
</div>
<!-- /page content -->';
}

// Call the footer include.
include 'layout/footer.php' ;
?>


