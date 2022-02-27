<?php

// Add your custom css files here.
use Illuminate\Support\Facades\Auth;

$extra_links_header = '' ;
// Add your custom js files here.
$extra_links_footer = '' ;

// call the header include.
include 'layout/header.php' ;

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

// Call the footer include.
include 'layout/footer.php' ;
?>


