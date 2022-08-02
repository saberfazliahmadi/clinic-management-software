<?php
use Illuminate\Support\Facades\Auth;
// Add your custom css files here. (will located in header)
$extra_links_header = '' ;
// Add your custom js files here. (will located in footer)
$extra_links_footer = '' ;

// Call the header include.
include 'layout/header.php' ;
?>
<style>
    .btn-default.active
    {
        border: 3px solid #169F85;
        border-radius: 4px!important;
    }

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
    
    <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top:70px;" >  
        <form method="post" action="'.route('store_patient_time_appointment_table').'" id="medical-file-form" data-parsley-validate >
            <input type="hidden" name="_token" value="'.csrf_token().'" >
            <input type="hidden" name="_method" value="put" >
            <input type="hidden" name="choose_time_for_this_patient_id" value="'.$choose_time_for_this_patient_id.'" >
            <input type="hidden" name="choose_time_for_this_date" value="'.$choose_time_for_this_date.'" >' ;

            $clinic_doctors_name = Auth::user()->clinic_doctors_name;

            // START of show doctors of clinic
            if( strlen($clinic_doctors_name) > 0 )
            {
                echo '
                <div class="form-group col-md-12 col-sm-12 col-xs-12" style="margin-bottom:25px;" >
                
                    <center>
                        <label class="control-label col-md-12 col-sm-12 col-xs-12" style="font-size:22px;font-weight:normal;text-align: center!important;margin-bottom:15px;" >
                            Choose Doctor of Patient
                        </label>
                    
                        <div class="col-md-12 col-sm-12 col-xs-12" >
                          <div class="form-group" >
                            <div class="col-md-12 col-sm-12 col-xs-12" >
                                <div class="col-md-12 col-sm-12 col-xs-12" >';

                                // Explode and make array type variable
                                $common_clinic_dr_1      = explode(",",$clinic_doctors_name);
                                // Estimate how many index exist in this variable
                                $common_clinic_dr_number = count($common_clinic_dr_1);
                                // Make end number for loop
                                $end 					 = $common_clinic_dr_number;
                                for( $start='0' ; $start < $end ; $start++ )
                                {
                                    if(strlen($common_clinic_dr_1[$start])>'0')
                                    {
                                        echo '
                                        <label class="btn btn-default well" data-toggle-class="btn-primary" style="font-size:20px;background-color:white;" >
                                            <input type="radio" name="appointment_child_dr_related_name" value="'.$common_clinic_dr_1[$start].'" > '.$common_clinic_dr_1[$start].'
                                        </label>';
                                    }
                                }

                                echo '
                                </div>
                             </div>
                         </div>
                        </div>
                    </center>
                </div>' ;
            }
            // END of show doctors of clinic

            // START of select service type of appointment
            if( strlen(Auth::user()->financial_management) > 0 )
            {
                echo '
                <center>
                    <label class="control-label col-md-12 col-sm-12 col-xs-12" style="font-size:22px;font-weight:normal;text-align: center!important;margin-bottom:15px;margin-top:5px;" >
                        Choose Type Service of This Appointment
                    </label>
                    
                    <div style="margin-top:10px;margin-bottom:30px;" class="col-md-12 col-sm-12 col-xs-12" >' ;
                        // Explode and make array type variable
                        $appointment_service_type = explode(",", Auth::user()->financial_management) ;
                        // Estimate how many index exist in this variable
                        $appointment_service_type_number = count($appointment_service_type);
                        // Make end number for loop
                        $end = $appointment_service_type_number ;
                        for( $start ='0' ; $start < $end ; $start++ )
                        {
                            if( strlen($appointment_service_type[$start]) > 0 )
                            {
                                echo '
                                <label class="btn btn-default well" data-toggle-class="btn-primary" style="font-size:20px;background-color:white;border: 1px solid #ccc;border-radius: 4px!important;margin-top:5px;margin-bottom:5px;" >
                                    <input type="radio" name="appointment_service_type" value="' . $appointment_service_type[$start] . '" > ' . $appointment_service_type[$start] . '
                                </label>';
                            }
                        }
                    echo '
                   </div>
                </center>';
            }
            // END of select service type of appointment

            echo '
            <center>'
                .$text_trick.'
            </center>

            <button type="submit" name="submit" class="btn btn-success btn-group-justified uiuxtrick" style="font-size:28px;position: fixed;bottom: 0px;right: 0px;z-index: 1;margin-bottom:0px;margin-right:0px;" >
               <i class="fa fa-clock-o" aria-hidden="true"></i> Book This Appointment Time on Date '.$choose_time_for_this_date.'
            </button>
        </form>
    </div>
    
</div>      
<!-- /page content -->' ;

// Call the footer include.
include 'layout/footer.php' ;
?>
