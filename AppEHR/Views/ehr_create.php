<?php
use Illuminate\Support\Facades\Auth;

// Add your custom css files here. (will be located in header)
$extra_links_header = '' ;
// Add your custom js files here. (will be located in footer)
$extra_links_footer = '' ;

// Call the header layout
require_once '../resources/views/back/layout/header.php' ;

?>
<style type="text/css" >

    .popover
    {
        z-index: 100000!important;
    }

    .btn-file
    {
        position: relative;
        overflow: hidden;
        border-radius: 4px 4px 0 0;
        border: 1px solid #e3e3e3;
    }

    .btn-file input[type=file]
    {
        top: 0;
        right: 0;
        min-width: 100%;
        min-height: 100%;
        font-size: 20px;
        text-align: right;
        filter: alpha(opacity=0);
        outline: none;
        background: white;
        cursor: inherit;
        display: block;
    }

    .checkbox
    {
        /*text-align: right;*/
        font-size: 19px;
    }

    /*.dropdown-menu*/
    /*{*/
    /*    width:100%;*/
    /*}*/

    .fs-container
    {
        width: 100%;
        height:800px;
        margin: auto;
    }

    .fs-container-2
    {
        width: 100%;
        height:800px;
        margin: auto;
    }

    .fs-container-3
    {
        width: 100%;
        height:800px;
        margin: auto;
    }

    .literally
    {
        width: 100%;
        height:100%;
        position: relative;
        background-color:white;
        background-repeat: no-repeat;
        background-position: center;
        background-origin: content-box;
    }

    #fancybox-buttons
    {
        display:none !important;
    }

    .fancybox-wrap
    {
        top: 0px!important;
        margin-top:0px!important;
    }

    .carousel.carousel-fit{position:relative}
    .carousel.carousel-fit.slide{overflow:hidden}
    .carousel.carousel-fit .carousel-inner>.next,.carousel.carousel-fit .carousel-inner>.prev{bottom:0}
    .carousel.carousel-fit .carousel-inner>.item{text-align:center}
    .carousel.carousel-fit .carousel-inner>.item>img{display:inline-block}
    .carousel.carousel-fit .carousel-inner>.item>.carousel-caption{bottom:0;left:0;right:0}
    .modal.modal-fullscreen .modal-dialog,.modal.modal-fullscreen .modal-content{bottom:0;left:0;position:absolute;right:0;top:0}
    .modal.modal-fullscreen .modal-dialog{margin:0;width:100%}
    .modal.modal-fullscreen .modal-content{border:none;-moz-border-radius:0;border-radius:0;-webkit-box-shadow:inherit;-moz-box-shadow:inherit;-o-box-shadow:inherit;box-shadow:inherit}
    .modal.modal-fullscreen.force-fullscreen .modal-body{padding:0;}
    .modal.modal-fullscreen.force-fullscreen .modal-header,.modal.modal-fullscreen.force-fullscreen .modal-footer{left:0;position:absolute;right:0}
    .modal.modal-fullscreen.force-fullscreen .modal-header{top:0;}
    .modal.modal-fullscreen.force-fullscreen .modal-footer{bottom:0}
    .modal.modal-fullscreen .modal-dialog, .modal.modal-fullscreen .modal-content {
        bottom: 0;
        left: 0;
        position: fixed;
        right: 0;
        top: 0;
        height: 100%;
        overflow-y: scroll;
    }

    .well{border-top: 0px;}

    .fancybox-lock , .fancybox-overlay
    {
        z-index: 999!important;
        background: initial!important;
    }

    .fancybox-inner
    {

    }

    .lc-clear , .lc-zoom-out , .lc-zoom-in
    {
        display:none !important;
    }

    #canvas-close-1 , #canvas-close-2 , #canvas-close-3
    {
        display:none;
    }

    /*#load*/
    /*{*/
    /*    width:100%;*/
    /*    height:100%;*/
    /*    position:fixed;*/
    /*    z-index:9999;*/
    /*    background:url("../../cdn/image/item/Heart_beat.gif") no-repeat center center rgba(0,0,0,0.25);*/
    /*}*/

    /*.load*/
    /*{*/
    /*    width:100%;*/
    /*    height:100%;*/
    /*    position:fixed;*/
    /*    z-index:9999;*/
    /*    background:url("../../cdn/image/item/Heart_beat.gif") no-repeat center center rgba(0,0,0,0.25);*/
    /*}*/

    .btn-group-justified>.btn
    {
        font-size: 13px!important;
        text-align:left;
        overflow-wrap: break-word;
    }

    .nav>li>a
    {
        font-size: 15px!important;
    }

    .highcharts-credits
    {
        color: #ffffff!important;
        fill: #ffffff!important;
    }

    tspan , .highcharts-text-outline
    {
        font-family:IRANSansNums!important;
        font-size: 14px;
    }

    .lc-undo , .lc-redo
    {
        display: none;
    }

    /* The device with borders */
    .smartphone {
        position: relative;
        width: 360px;
        height: 640px;
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

    .nav-tabs>li.active>a:hover {
        cursor: pointer;
    }

</style>
<?php

$cms_menu_title = explode("," , Auth::user()->cms_menu_title)  ;
echo '
<div class="right_col" role="main" >
    <div class="form-group col-md-12 col-sm-12 col-xs-12" >
    
    <!-- display a loading icon until the page loads completely -->
    <div id="load"></div>
    
  <div class="col-md-12 col-sm-12 col-xs-12" >

      <form id="medical-file-form" method="POST" action="'.route('ehr.store' , [ 'encrypted_patient_id' => $EHR_document_patient_related_id_encrypted ]).'" class="controls export-svg" enctype="multipart/form-data" onsubmit="setFormSubmitting()" >
            <input type="hidden" name="_token" value="'.csrf_token().'" >
            <input type="hidden" name="_method" value="post" >
          <div class="x_content" >

                <ul class="nav nav-tabs" role="tablist" style="float:right;font-size:18px;font-weight:bolder;" >' ;

                    // START of if $cms_menu_title[5] exist
                    if( strlen($cms_menu_title[5]) > 0 )
                    {
                        echo '
                        <li role="presentation">
                            <a id="various222" href="#patient_medical_records" type="button" aria-controls="profile" role="tab" data-toggle="tab" >
                                '.$cms_menu_title[5].'
                            </a>
                        </li>
                        
                        <!-- START of fancy console panel to show all Patient medical records -->
                        <div id="patient_medical_records" style="display:none;height:550px;width:900px!important;overflow-x: hidden!important;padding-bottom:30px;padding-top:35px;" >
                    
                          <div class="form-group col-md-12 col-sm-12 col-xs-12" >' ;

                            // Explode and array these title
                            $common_hypersensitivity = explode(",",Auth::user()->common_hypersensitivity)  ;
                            // Estimate how many title this text has
                            $common_hypersensitivity_number = count($common_hypersensitivity) ;

                            // Estimate how many title exist on this text record to use of for loop.
                            $end_hypersensitivity = $common_hypersensitivity_number ;

                            // START of if dr define common_hypersensitivity.
                            if( $end_hypersensitivity > 1 )
                            {
                                echo '
                                <center>
                                    <h2 class="justify-content-center control-label col-md-12 col-sm-12 col-xs-12" style="margin-bottom:5px;margin-top:5px;text-align:center;" >
                                        Common Predefined '.$cms_menu_title[5].'
                                    </h2>
                                </center>
                                
                                <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 15px;border: 1px solid #CCC;" >
                                    <select name="common_hypersensitivity_2311[]" id="dates-field2" class="col-md-12 col-sm-12 col-xs-12 multiselect-ui" multiple="multiple" >' ;
                                    for( $start_hypersensitivity ='0' ; $start_hypersensitivity < $end_hypersensitivity ; $start_hypersensitivity ++ )
                                    {
                                        if( strlen($common_hypersensitivity[$start_hypersensitivity]) > 0 )
                                        {
                                            echo '
                                            <option value="'.$common_hypersensitivity[$start_hypersensitivity].'" class="col-md-4 col-sm-12 col-xs-12" >
                                                '.$common_hypersensitivity[$start_hypersensitivity].'
                                            </option>' ;
                                        }
                                    }
                                    echo '
                                    </select>
                                </div>';
                            }
                            // END of if dr define common_hypersensitivity.
                            else
                            {
                                echo '
                                <center>
                                    <a href="setting.php" class="btn btn-default" style="font-size:18px;margin-top:50px;border-radius: 4px 4px 0 0; border: 1px solid #CCC;" >
                                        <i class="fa fa-plus text-center col-md-12 col-sm-12 col-xs-12" style="font-size:46px;padding:19px;" ></i>
                                        <div class="col-md-12 col-sm-12 col-xs-12" style="padding-top:17px;padding-bottom:17px;" >
                                            Add predefined '.$cms_menu_title[5].' to add to patient records
                                        </div>
                                    </a>
                                </center>';
                            }

                            echo '
                            <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top:20px;" >
                                <input type="text" name="typed_keyboard_savabegh" style="width:100%;text-align:right;direction:rtl;font-size:22px;height:40px;border: 1px solid #CCC;" placeholder="Type your favorite '.$cms_menu_title[5].'" >
                            </div>';

                            // If more description value exist, then show it
                            if( strlen($result_of_patients_general_infos->patient_more_description) > 0 )
                            {
                                echo '
                                <div class="form-group col-md-12 col-sm-12 col-xs-12" style="background-color:white;margin:0px 0px 0px 0px;padding:0px 0px 0px 0px;margin-top:25px;text-align:center;background-color:white;line-height: 40px;font-size:22px; word-break: break-all;" >
                                    <center>
                                        <span>
                                            More Description
                                        </span>
                                        <br>
                                        <input type="text" name="patient_more_description" class="form-control" value="'.$result_of_patients_general_infos->patient_more_description.'" >
                                    </center>
                                </div>';
                            }

                            echo '
                          </div>
                        
                          <div class="form-group col-md-3 col-sm-3 col-xs-12" style="margin-top: 15px;" >
                            <center>
                                <h2 class="control-label col-md-12 col-sm-12 col-xs-12" style="margin-bottom:5px;margin-top:5px;text-align:center;" >
                                    History of Surgery
                                </h2>
                            
                                <div class="col-md-12 col-sm-12 col-xs-12" >
                                    <input type="text" name="patient_surgery_history" class="form-control" value="'.$result_of_patients_general_infos->patient_surgery_history.'" >
                                </div>
                            </center>
                          </div>
                        
                          <div class="form-group col-md-3 col-sm-3 col-xs-12" style="margin-top: 15px;" >
                            <center>
                                <h2 class="control-label col-md-12 col-sm-12 col-xs-12" style="margin-bottom:5px;margin-top:5px;text-align:center;" >
                                    Disease Background
                                </h2>
                            
                                <div class="col-md-12 col-sm-12 col-xs-12" >
                                    <input type="text" name="patient_disease_background" class="form-control" value="'.$result_of_patients_general_infos->patient_disease_background.'" >
                                </div>
                            </center>
                          </div>
                        
                          <div class="form-group col-md-3 col-sm-3 col-xs-12" style="margin-top: 15px;" >
                            <center>
                                <h2 class="control-label col-md-12 col-sm-12 col-xs-12" style="margin-bottom:5px;margin-top:5px;text-align:center;" >
                                    Medications
                                </h2>
                            
                                <div class="col-md-12 col-sm-12 col-xs-12" >
                                    <input type="text" name="patient_medication_history" class="form-control" value="'.$result_of_patients_general_infos->patient_medication_history.'" >
                                </div>
                            </center>
                          </div>
                        
                          <div class="form-group col-md-3 col-sm-3 col-xs-12" style="margin-top: 15px;" >
                            <center>
                                <h2 class="control-label col-md-12 col-sm-3 col-xs-12" style="margin-bottom:5px;margin-top:5px;text-align:center;" >
                                    History of Allergies
                                </h2>
                            
                                <div class="col-md-12 col-sm-12 col-xs-12" >
                                    <input type="text" name="patient_allergies_history" class="form-control" value="'.$result_of_patients_general_infos->patient_allergies_history.'" >
                                </div>
                            </center>
                          </div>

                        </div>
                        <!-- END of fancy console panel to show all Patient medical records -->';
                    } // END of if $cms_menu_title[5] exist

                    // START of if $cms_menu_title[4] exist
                    if( strlen($cms_menu_title[4]) > 0 )
                    {
                        echo '
                        <li role="presentation">
                            <a id="various222" href="#medications_picker" type="button" aria-controls="profile" role="tab" data-toggle="tab" >
                                '.$cms_menu_title[4].'
                            </a>
                        </li>

                        <!-- START of login fancy console panel medications picker -->
                        <div style="display:none;" >
                            <div id="medications_picker" style="height:550px;width:980px!important;overflow-x: hidden!important;padding-bottom:30px;padding-top:35px;" >
                        
                                <div class="col-md-12 col-sm-12 col-xs-12" style="margin-bottom:20px;" >
                                    <input type="text" name="keyboard_medications_picker" style="width:100%;text-align:right;direction:rtl;font-size:22px;height:40px;border: 1px solid #CCC;" placeholder="Type your favorite '.$cms_menu_title[4].'" class="well" >
                                </div>';

                                // START of common drug predefined
                                if(strlen(Auth::user()->common_drug))
                                {
                                    // Explode and array these title
                                    $common_drug_1 = explode("," , Auth::user()->common_drug);
                                    // Estimate how many title this text have
                                    $common_drug_number = count($common_drug_1);
                                    // Estimate how many title exist on this text record to use of for loop.
                                    $end = $common_drug_number;

                                    // START of make a for loop to update all title title a text have.
                                    for( $start='0' ; $start < $end ; $start++ )
                                    {
                                        if(strlen($common_drug_1[$start])>'0')
                                        {
                                            $common_drug_tr = $common_drug_1[$start] ;
                                            echo '
                                             <div class="form-group col-md-12 col-sm-12 col-xs-12" >
                                                <span type="button" data-toggle="collapse" data-target="#'.$start.'" class="btn-primary control-label col-md-12 col-sm-12 col-xs-12" style="font-size:27px;font-weight:normal;text-align:center;cursor:pointer;color:gray;background-color:white;border:1px solid #bfbdbd;">
                                                    '.$common_drug_1[$start].'
                                                </span>
                                                <div class="col-md-12 col-sm-12 col-xs-12 collapse" id="'.$start.'" style="font-family:Tahoma!important;" >
                                                  <div class="btn-group btn-group-justified" data-toggle="buttons" style="height:60px;" >
                                    
                                                    <label class="btn btn-default" data-toggle-class="btn-primary" >
                                                      <input type="radio" name="'.$common_drug_1[$start].'" value="روزانه یک عدد" > Daily
                                                    </label>
                                    
                                                    <label class="btn btn-default" data-toggle-class="btn-primary" >
                                                      <input type="radio" name="'.$common_drug_1[$start].'" value="هر شب یک عدد" > Qhs
                                                    </label>
                                    
                                                    <label class="btn btn-default" data-toggle-class="btn-primary" >
                                                      <input type="radio" name="'.$common_drug_1[$start].'" value="مصرف موضعی سه بار در روز" > TOP.TDS
                                                    </label>
                                    
                                                    <label class="btn btn-default" data-toggle-class="btn-primary" >
                                                      <input type="radio" name="'.$common_drug_1[$start].'" value="مصرف موضعی دو بار در روز" > TOP.BD
                                                    </label>
                                    
                                                    <label class="btn btn-default" data-toggle-class="btn-primary" >
                                                      <input type="radio" name="'.$common_drug_1[$start].'" value="هم اکنون همین یک بار" > Stat
                                                    </label>
                                    
                                                    <label class="btn btn-default" data-toggle-class="btn-primary" >
                                                      <input type="radio" name="'.$common_drug_1[$start].'" value="صبح ها قبل از صبحانه" > Fasting
                                                    </label>
                                    
                                                    <label class="btn btn-default" data-toggle-class="btn-primary" >
                                                      <input type="radio" name="'.$common_drug_1[$start].'" value="بعد از نهار" > Lunch
                                                    </label>
                                    
                                                    <label class="btn btn-default" data-toggle-class="btn-primary" >
                                                      <input type="radio" name="'.$common_drug_1[$start].'" value="بعد از شام" > Dinner
                                                    </label>
                                    
                                                    <label class="btn btn-default" data-toggle-class="btn-primary" >
                                                      <input type="radio" name="'.$common_drug_1[$start].'" value="بعد صبحانه و بعد از شام" > BD
                                                    </label>
                                    
                                                    <label class="btn btn-default" data-toggle-class="btn-primary" >
                                                      <input type="radio" name="'.$common_drug_1[$start].'" value="بعد از صبحانه بعد از نهار بعد از شام" > TDS
                                                    </label>
                                    
                                                    <label class="btn btn-default" data-toggle-class="btn-primary" >
                                                      <input type="radio" name="'.$common_drug_1[$start].'" value="هر چهار ساعت" > Q4H
                                                    </label>
                                    
                                                    <label class="btn btn-default" data-toggle-class="btn-primary" >
                                                      <input type="radio" name="'.$common_drug_1[$start].'" value="هر شش ساعت" > Q6H
                                                    </label>
                                    
                                                    <label class="btn btn-default" data-toggle-class="btn-primary" >
                                                      <input type="radio" name="'.$common_drug_1[$start].'" value="بعد از صبحانه و بعد از نهار" > F/L
                                                    </label>
                                    
                                                    <label class="btn btn-default" data-toggle-class="btn-primary" >
                                                      <input type="radio" name="'.$common_drug_1[$start].'" value="به هنگام نیاز یا به هنگام درد" > PRN
                                                    </label>
                                    
                                                    <label class="btn btn-default" data-toggle-class="btn-primary" >
                                                      <input type="radio" name="'.$common_drug_1[$start].'" value="یک روز در میان" > qod
                                                    </label>
                                    
                                                    <label class="btn btn-default" data-toggle-class="btn-primary" >
                                                      <input type="radio" name="'.$common_drug_1[$start].'" value="سه بار در هفته" >
                                                      3tw
                                                    </label>
                                    
                                                    <label class="btn btn-default" data-toggle-class="btn-primary" >
                                                      <input type="radio" name="'.$common_drug_1[$start].'" value="هفتگی" >
                                                      Weekly
                                                    </label>
                                    
                                                    <label class="btn btn-default" data-toggle-class="btn-primary" >
                                                      <input type="radio" name="'.$common_drug_1[$start].'" value="ماهانه" >
                                                      Monthly
                                                    </label>
                                    
                                                    <label class="btn btn-default" data-toggle-class="btn-primary" >
                                                      <input type="radio" name="'.$common_drug_1[$start].'" value="هر شش ماه" >
                                                      6m
                                                    </label>
                                    
                                                    <label class="btn btn-default" data-toggle-class="btn-primary" >
                                                      <input type="radio" name="'.$common_drug_1[$start].'" value="45 روز یک بار" >
                                                      45d
                                                    </label>
                                    
                                                    <label class="btn btn-default" data-toggle-class="btn-primary" >
                                                      <input type="radio" name="'.$common_drug_1[$start].'" value="هر دو ماه یک بار" >
                                                      2m
                                                    </label>
                                    
                                                  </div>
                                                </div>
                                              </div>';
                                        }
                                    }
                                } // END of common drug predefined
                                else
                                {
                                    echo '
                                    <center>
                                        <a href="setting.php" class="btn btn-default" style="font-size:18px;margin-top:50px;border-radius: 4px 4px 0 0; border: 1px solid #e3e3e3;" >
                                            <i class="fa fa-medkit text-center col-md-12 col-sm-12 col-xs-12" style="font-size:46px;padding: 19px;" ></i>
                                            <div class="col-md-12 col-sm-12 col-xs-12" style="padding-top:17px;padding-bottom:17px;" >
                                              + Add predefined '.$cms_menu_title[4].' to patients 
                                            </div>
                                        </a>
                                    </center>';
                                }

                            echo '
                           </div>
                        </div>
                        <!-- END of login fancy console panel medications picker -->';
                    } // END of if $cms_menu_title[4] exist

                    // START of if $cms_menu_title[3] exist
                    if( strlen($cms_menu_title[3]) > 0 )
                    {
                        echo '
                        <li role="presentation">
                            <a id="various222" href="#rejim" type="button" aria-controls="profile" role="tab" data-toggle="tab" >
                               '.$cms_menu_title[3].'
                            </a>
                        </li>
    
                        <!-- START of login fancy console panel common_diet -->
                        <div style="display:none;" >
                            <div id="rejim" style="min-height:600px!important;width:900px!important;overflow-x: hidden!important;padding-bottom:30px;padding-top:35px;" >';

                            if( strlen(Auth::user()->common_diet) > 0 )
                            {
                                // Explode and array these title
                                $common_rejim_1 = explode("," , Auth::user()->common_diet) ;
                                // Estimate how many title this text have
                                $common_rejim_number = count($common_rejim_1) ;
                                // Estimate how many title exist on this text record to use of for loop
                                $end = $common_rejim_number;

                                echo '
                                <center>
                                    <h2 class="control-label col-md-12 col-sm-12 col-xs-12" style="margin-bottom:5px;margin-top:5px;text-align:center;" >
                                        Common Predefined '.$cms_menu_title[3].' 
                                    </h2>
                                </center>

                                <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 15px;border:1px solid #CCC;" >
                                    <select name="common_diet[]" id="dates-field211" class="col-md-12 col-sm-12 col-xs-12 multiselect-ui" multiple="multiple" >' ;
                                        for( $start='0' ; $start < $end ; $start++ )
                                        {
                                            if(strlen($common_rejim_1[$start])>'0')
                                            {
                                                echo '
                                                <option value="'.$common_rejim_1[$start].'" class="col-md-4 col-sm-12 col-xs-12" >
                                                    '.$common_rejim_1[$start].'
                                                </option>';
                                            }
                                        }
                                    echo '
                                    </select>
                                </div>';
                            }
                            else
                            {
                                echo '
                                <center>
                                    <a href="setting.php" class="btn btn-default" style="font-size:18px;margin-top:50px;border-radius: 4px 4px 0 0; border: 1px solid #e3e3e3;" >                      
                                         <i class="fa fa-plus text-center col-md-12 col-sm-12 col-xs-12" style="font-size:46px;padding: 19px;" ></i>
                                         <div class="col-md-12 col-sm-12 col-md-12 col-sm-12 col-xs-12" style="padding-top:17px;padding-bottom:17px;" >
                                             + Add predefined '.$cms_menu_title[3].' to prescribe to patients 
                                         </div>
                                    </a>
                                </center>';
                            }

                                echo '
                                <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top:20px;" >
                                    <input type="text" name="keyboard_common_diet"  style="width:100%;text-align:right;direction:rtl;font-size:22px;height:40px;border:1px solid #CCC;" placeholder="Type your favorite '.$cms_menu_title[3].'" >
                                </div>
                            
                            </div>
                        </div>
                        <!-- END of login fancy console panel common_diet -->';
                     } // END of if $cms_menu_title[3] exist

                    // START of if $cms_menu_title[2] exist
                    if( strlen($cms_menu_title[2]) > 0 )
                    {
                        echo '
                        <li role="presentation">
                            <a id="various222" href="#common_return_date" type="button" aria-controls="profile" role="tab" data-toggle="tab" >
                                '.$cms_menu_title[2].'
                            </a>
                        </li>
                        
                        <!-- START of login fancy console panel common_return_date -->
                        <div style="display:none;" >
                            <div id="common_return_date" style="min-height:600px!important;width:900px!important;overflow-x: hidden!important;padding-bottom:30px;padding-top:35px;" >';

                                if(strlen(Auth::user()->common_return_date))
                                {
                                    // Explode and array these title.
                                    $common_return_date_1 = explode(",", Auth::user()->common_return_date);

                                    // Estimate how many title this text have.
                                    $common_return_date_number = count($common_return_date_1);

                                    // Estimate how many title exist on this text record to use of for loop.
                                    $end = $common_return_date_number;

                                    echo '
                                    <center>
                                        <h2 class="control-label col-md-12 col-sm-12 col-xs-12" style="margin-bottom:5px;margin-top:5px;text-align:center;" >
                                            Common Predefined '.$cms_menu_title[2].'
                                        </h2>
                                    </center>
                                    
                                    <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top: 15px;border:1px solid #CCC;" >
                                      <select name="common_return_date[]" id="dates-field222" class="col-md-12 col-sm-12 col-xs-12 multiselect-ui" multiple="multiple"  >' ;

                                        for( $start='0' ; $start < $end ; $start++ )
                                        {
                                            if(strlen($common_return_date_1[$start])>'0')
                                            {
                                                echo '
                                                <option value="'.$common_return_date_1[$start].'" class="col-md-4 col-sm-12 col-xs-12" >
                                                    '.$common_return_date_1[$start].'
                                                </option>';
                                            }
                                        }
                                        echo '
                                          </select>
                                      </div>';
                                }
                                else
                                {
                                    echo '
                                    <center>
                                        <a href="setting.php" class="btn btn-default text-center" style="font-size:18px;margin-top:50px;border-radius: 4px 4px 0 0; border: 1px solid #e3e3e3;" >
                                             <i class="fa fa-clock-o text-center col-md-12" style="font-size:46px;padding: 19px;" ></i>
                                             <div class="col-md-12 col-sm-12 col-xs-12" style="padding-top:17px;padding-bottom:17px;" >
                                                 + Add '.$cms_menu_title[2].' time intervals Predefined to determine the next visit of patient
                                             </div>
                                        </a>
                                    </center>';
                                }

                                echo '
                                <div class="col-md-12 col-sm-12 col-xs-12" style="margin-top:20px;" >
                                    <input type="text" name="keyboard_common_return_date"  style="width:100%;text-align:right;direction:rtl;font-size:22px;height:40px;border:1px solid #CCC;" placeholder="Type your favorite '.$cms_menu_title[2].'" >
                                </div>
                    
                            </div>
                        </div>
                        <!-- END of login fancy console panel common_return_date -->';
                    }
                    // END of if $cms_menu_title[2] exist

                    // START of if $cms_menu_title[1] exist
                    if( strlen($cms_menu_title[1]) > 0 )
                    {
                        echo '
                        <li role="presentation" >
                            <a id="various222" href="#para-clinic" type="button" aria-controls="profile" type="button" role="tab" data-toggle="tab" >
                                '.$cms_menu_title[1].'
                            </a>
                        </li>
                        
                        <!-- START of login fancy console panel para-clinic -->
                        <div style="display:none;" >
                            <div id="para-clinic" style="height:550px;width:900px!important;overflow-x: hidden!important;padding-bottom:30px;padding-top:35px;" >
                        
                                <div class="col-md-12 col-sm-12 col-xs-12 text-center" style="margin-bottom:19px;" >
                        
                                    <div class="col-md-12 col-sm-12 col-xs-12" >
                        
                                        <label class="btn btn-default btn-file" style="font-size:22px;border:1px solid #CCC;" >
                                            + Add Photo
                                            <input type="file" name="image" placeholder="Choose image" id="image">
                                        </label>
                                        
                                        <hr style="width:1px;" >
                                    
                                        <input type="text" name="keyboard_paraclinic_file_title" style="width:100%;text-align:right;direction:rtl;font-size:22px;height:40px;border:1px solid #CCC;" placeholder="Type your favorite title" >
                                        <br>
                                        <hr>
                                        
                                        <div class="col-md-12 col-sm-12 col-xs-12" >
                                            <a id="various222" href="#help_photo_upload" class="btn-primary btn-lg" type="button" style="cursor:pointer;color:black!important;background-color:#F7F7F7!important;border:1px solid #bfbdbd;font-size:14px;" >
                                                Guide - Must be Read
                                            </a>
                                        </div>
                                        
                                    </div>
                                    
                                </div>
                        
                                <!-- START of login fancy console panel help_photo_upload -->
                                <div style="display:none;" >
                                    <div id="help_photo_upload" style="width:900px;height:350px;overflow-x: hidden;" >
                                      <div class="col-md-12 col-sm-12 col-xs-12" style="line-height: 25px!important;font-family:Tahoma!important;">
                        
                                        <center>
                                            <h4 class="col-md-12 col-sm-12 col-xs-12 text-center" style="margin-top:70px;" >
                                                You can add images of surgery, CT scan, ultrasound, radiology and test results of the patient in this section and save them at the end
                                            </h4>
                                            <h4 class="col-md-12 col-sm-12 col-xs-12 text-center" >
                                                In order to save the images correctly, you must observe the following items
                                            </h4>
                                            <h4 class="col-md-12 col-sm-12 col-xs-12 text-center" >
                                                If you are taking a photo with your mobile phone or tablet, first set the quality of your mobile phone or tablet to 4 megapixels and then take a photo. If you save the photo with a scanner device
                                            </h4>
                                            <h4 class="col-md-12 col-sm-12 col-xs-12 text-center" >
                                                Photo size must be less than 700 KB
                                            </h4>
                                            <h4 class="col-md-12 col-sm-12 col-xs-12 text-center" >
                                                At the end of the patient\'s visit, be sure to click the save button
                                            </h4>
                                         <center>
                        
                                        </div>
                                    </div>
                                </div>
                                <!-- END of login fancy console panel help_photo_upload -->
                        
                                <div class="col-md-12 col-sm-12 col-xs-12" >' ;

                                    // If there was para-clinic data for this patient
                                    if( $count_result_of_patients_photo > 0)
                                    {
                                        foreach ( $result_of_patients_photo as $key_patient_photo )
                                        {
                                            // show file title in all situations
                                            if( strlen($key_patient_photo->patients_photos_file_description) > 0 )
                                            {
                                                $patients_photos_file_description = $key_patient_photo->patients_photos_file_description ;
                                            }
                                            else
                                            {
                                                // let to SUM patient_id with patients_photos_id to prevent hacking database
                                                $patients_photos_file_description = 'Without title '.$result_of_patients_general_infos->patient_id+$key_patient_photo->patients_photos_id ;
                                            }

                                            echo '
                                            <a class="fancybox-buttons" href="'.url('storage/images/'.$admin_id_from_users_table.'/'.$key_patient_photo->patients_photos_patient_related_id.'/para/'.$key_patient_photo->patients_photos_file_name).'" data-fancybox-group="button" style="text-align:center;" >
                                                <div class="col-md-3 col-sm-3 col-xs-3 well" >
                                                    <div class="block_content">
                                                      <h2 class="title" align="center" style="text-align:center;" >
                                                         <b>
                                                            <div style="float:left;font-size:17px;" class="col-md-12 col-sm-12 col-xs-12" >
                                                                '.$patients_photos_file_description.'
                                                            </div>
                                                            <i class="fa fa-picture-o col-md-12 col-sm-12 col-xs-12" style="padding:19px;" ></i>
                                                            <div style="float:right;margin-top:10px;font-size:18px;" class="col-md-12 col-sm-12 col-xs-12" >
                                                                Show Photo
                                                            </div>
                                                         </b>
                                                      </h2>
                                                    </div>
                                                </div>
                                            </a>';
                                        }
                                    }
                                    // END of if there was para-clinic data for this patient
                                    else
                                    {
                                        echo '
                                        <div class="col-md-12 col-sm-12 col-xs-12 text-center" >
                                            <div class="col-md-12 col-sm-12 col-xs-12" >
                                                <i class="fa fa fa-heartbeat" style="font-size:46px;padding: 19px;" ></i>
                                            </div>
                                            <div class="col-md-12 col-sm-12 col-xs-12" style="font-size:26px;margin-top:25px;" >
                                                No '.$cms_menu_title[1].' information was stored for this patient
                                            </div>
                                        </div>';
                                    }

                                echo '
                                </div>
                            </div>
                        </div>
                        <!-- END of login fancy console panel para-clinic -->';
                    } // END of if $cms_menu_title[1] exist

                    // START of if $cms_menu_title[0] exist
                    if( strlen($cms_menu_title[0]) > 0 )
                    {
                        echo '
                        <li role="presentation">
                            <a id="various222" href="#previous_patient_history_category" type="button" aria-controls="profile" type="button" role="tab" data-toggle="tab" >
                                '.$cms_menu_title[0].'
                            </a>
                        </li>
                        
                        <!-- START of login fancy console panel previous_patient_history_category -->
                        <div style="display:none;" >
                            <div id="previous_patient_history_category" style="height:450px!important;width:900px!important;overflow-x: hidden!important;padding-bottom:30px;padding-top:35px;" >
                                <div class="col-md-12 col-sm-12 col-xs-12 text-center" >
                                    <center>
                        
                                        <br>
                                        <hr style="width:1px;" >
                        
                                        <a id="various222" href="#prescriptions_given_to_the_patient" type="button" aria-controls="profile" role="tab" data-toggle="tab" class="btn btn-success btn-group col-md-10 col-sm-10 col-xs-10" style="float:none;font-size:25px;" >
                                            Prescriptions given to the patient
                                        </a>
                        
                                        <div style="display:none;" >
                                            <div id="prescriptions_given_to_the_patient" style="height:550px!important;width:920px!important;overflow-x: hidden!important;" >' ;

                                                // START of if there was more than 1 EHR document
                                                if( $count_result_of_patients_ehr_document > 0 )
                                                {
                                                    foreach ( $result_of_patients_ehr_document as $key_ehr )
                                                    {
                                                        $ehr_document_number_trick = $key_ehr->EHR_document_id + $result_of_patients_general_infos->patient_id ;
                                                        // Make a trick to prevent from POST method error (post method should'nt have Space in him content)
                                                        // $EHR_document_prescribed_common_diet         = $key_ehr->EHR_document_prescribed_common_diet ;
                                                        // $EHR_document_prescribed_common_drug         = $key_ehr->EHR_document_prescribed_common_drug ;
                                                        $EHR_document_prescribed_next_appointment       = str_replace("_", " ", $key_ehr->EHR_document_prescribed_next_appointment );
                                                        $EHR_document_related_clinic_doctor_name_trick  = str_replace("_", " ", $key_ehr->EHR_document_related_clinic_doctor_name );

                                                        echo '
                                                        <!-- Button trigger modal -->
                                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ehr_detail_'.$ehr_document_number_trick.'" style="margin:5px 5px 5px 5px;" >
                                                          '.$ehr_document_number_trick.' => '.substr($key_ehr->created_at , '0' , '10').'
                                                        </button>
                                                        
                                                        <!-- START Modal -->
                                                        <div class="modal fade" id="ehr_detail_'.$ehr_document_number_trick.'" tabindex="-1'.$ehr_document_number_trick.'" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                          <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                              <div class="modal-header">
                                                                <center>
                                                                    <h5 class="modal-title" id="exampleModalLabel" style="float:none;">
                                                                        '.$ehr_document_number_trick.' => '.substr($key_ehr->created_at , '0' , '10').'
                                                                    </h5>
                                                                </center>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                  <span aria-hidden="true" style="font-size:74px!important;" >&times;</span>
                                                                </button>
                                                              </div>
                                                              <div class="modal-body" style="overflow: auto!important;" >';

                                                                if (strlen($cms_menu_title[4]) > 0)
                                                                {
                                                                    echo '
                                                                    <div class="well" style="background-color: inherit;border-bottom:0px;border-left:0px;font-size:17px;margin-bottom:0px;padding-bottom:0px;" >
                                                                        ' . $cms_menu_title[4] . '
                                                                        <p class="common-drug" style="overflow-wrap: break-word; word-wrap: break-word; hyphens: auto;">'.$key_ehr->EHR_document_prescribed_common_drug.'</p>
                                                                    </div>';
                                                                }

                                                                if (strlen($cms_menu_title[3]) > 0)
                                                                {
                                                                    echo '
                                                                    <div class="well" style="background-color: inherit;border-bottom:0px;border-left:0px;font-size:17px;margin-bottom:0px;padding-bottom:0px;" >
                                                                         ' . $cms_menu_title[3] . '
                                                                        <p class="common-rejim" style="overflow-wrap: break-word; word-wrap: break-word; hyphens: auto;" >'.$key_ehr->EHR_document_prescribed_common_diet.'</p>
                                                                    </div>';
                                                                }

                                                                if (strlen($cms_menu_title[2]) > 0)
                                                                {
                                                                    echo '
                                                                    <div class="well" style="background-color: inherit;border-bottom:0px;border-left:0px;font-size:17px;margin-bottom:0px;padding-bottom:0px;" >
                                                                        '.$cms_menu_title[2] .'
                                                                        <p class="common-return-date" style="overflow-wrap: break-word; word-wrap: break-word; hyphens: auto;" >'.$EHR_document_prescribed_next_appointment.'</p>
                                                                    </div>';
                                                                }

                                                                echo '
                                                                <div class="well" style="background-color: inherit;border-bottom:0px;border-left:0px;font-size:17px;margin-bottom:0px;padding-bottom:0px;" >
                                                                    Doctor:
                                                                    <p class="child-dr-name-rel-doc" style="overflow-wrap: break-word; word-wrap: break-word; hyphens: auto;" >'.$EHR_document_related_clinic_doctor_name_trick.'</p>
                                                                </div>
                                                                
                                                              </div>
                                                              <div class="modal-footer">
                                                                <button type="button" class="btn btn-primary btn-lg btn-block" data-dismiss="modal">Close</button>
                                                              </div>
                                                            </div>
                                                          </div>
                                                        </div>
                                                        <!-- END Modal --> ';
                                                    }
                                                } // END  of if there was more than 1 document for this patient then show it on document time line.
                                                else
                                                {
                                                    echo '
                                                    <center>
                                                        <div class="col-md-12 col-sm-12 col-xs-12" >
                                                            <h3 style="padding-top:10px;font-size:25px;opacity:0.7;text-align:center;" >
                                                                <br>
                                                                No EHR document has been saved for this patient
                                                                <br>
                                                                 <i class="glyphicon glyphicon-file" style="font-size:46px;padding: 19px;float:none;" ></i>
                                                            </h3>
                                                        </div>
                                                    </center>';
                                                }

                                            echo '
                                            </div>
                                        </div>
                                        
                                    </center>
                                </div>
                            </div>
                        </div>' ;
                        // END of login fancy console panel previous_patient_history_category
                    } // END of if $cms_menu_title[0] exist

                    if( strlen($cms_menu_title[9]) > 0 )
                    {
                        echo '
                        <li role="presentation" >
                            <a id="various222" href="#chart" type="button" aria-controls="profile" type="button" role="tab" data-toggle="tab" >
                                '.$cms_menu_title[9].'
                            </a>
                        </li>

                        <!-- START of login fancy console panel chart -->
                        <div style="display:none;" >
                            <div id="chart" style="height:550px;width:900px!important;overflow-x: hidden!important;padding-bottom:30px;padding-top:35px;" >
                        
                                <div class="col-md-12 col-sm-12 col-xs-12 text-center" style="margin-bottom:9px;" >
                        
                                    <div class="col-md-3 col-sm-3 col-xs-12" style="margin-top:20px;" >
                                        <div class="btn btn-group col-md-12 col-sm-12 col-xs-12" style="font-size: 18px!important;color:gray;" >
                                            '.$cms_menu_title[10].'
                                        </div>
                                        <input type="text" name="keyboard_chart_1" style="width:100%;text-align:right;direction:rtl;font-size:14px;height:40px;" placeholder="Type your favorite value" >
                                    </div>
                        
                                    <div class="col-md-3 col-sm-3 col-xs-12" style="margin-top:20px;" >
                                        <div class="btn btn-group col-md-12 col-sm-12 col-xs-12" style="font-size: 18px!important;color:gray;" >
                                            '.$cms_menu_title[11].'
                                        </div>
                                        <input type="text" name="keyboard_chart_2" style="width:100%;text-align:right;direction:rtl;font-size:14px;height:40px;" placeholder="Type your favorite value" >
                                    </div>
                        
                                    <div class="col-md-3 col-sm-3 col-xs-12" style="margin-top:20px;" >
                                        <div class="btn btn-group col-md-12 col-sm-12 col-xs-12" style="font-size: 18px!important;color:gray;" >
                                            '.$cms_menu_title[12].'
                                        </div>
                                        <input type="text" name="keyboard_chart_3" style="width:100%;text-align:right;direction:rtl;font-size:14px;height:40px;" placeholder="Type your favorite value" >
                                    </div>
                        
                                    <div class="col-md-3 col-sm-3 col-xs-12" style="margin-top:20px;" >
                                        <div class="btn btn-group col-md-12 col-sm-12 col-xs-12" style="font-size: 18px!important;color:gray;" >
                                            '.$cms_menu_title[13].'
                                        </div>
                                        <input type="text" name="keyboard_chart_4" style="width:100%;text-align:right;direction:rtl;font-size:14px;height:40px;" placeholder="Type your favorite value" >
                                    </div>
                        
                                </div>
                        
                                <br>
                                <hr style="width:1px;" >
                        
                                <div class="form-group">
                                    <label class="control-label col-md-4 col-sm-4 col-xs-12" style="color:gray;text-align: right;" >Date of appointment</label>
                        
                                    <div class="col-md-6 col-sm-6 col-xs-12" style="" >
                                        <input type="text" name="doc_date_created" class="form-control col-md-7 col-xs-12 has-feedback-right" id="" data-MdDateTimePicker="true" value="" autocomplete="off" aria-autocomplete="list" aria-expanded="false" aria-haspopup="true" role="combobox" spellcheck="false" />
                                        <span class="glyphicon glyphicon-calendar form-control-feedback right" aria-hidden="true"></span>
                                    </div>
                                  </div>
                        
                            </div>
                        </div>
                        <!-- END of login fancy console panel chart -->';
                        }

                echo '
                </ul>

<div class="well col-md-12 col-sm-12 col-xs-12" style="min-height:52px;" >

<div style="float:right;font-size:16px;margin-right:9px;" >Name: '.$result_of_patients_general_infos->patient_first_name.' '.$result_of_patients_general_infos->patient_last_name.'</div>

<div style="float:right;font-size:16px;margin-right:10px;" >' ;
    if($result_of_patients_general_infos->patient_relationship_status === 'single')
    {
        echo 'Marital Status: Single | ' ;
    }
    elseif($result_of_patients_general_infos->patient_relationship_status === 'married')
    {
        echo 'Marital Status: Married | ' ;
    }
    elseif($result_of_patients_general_infos->patient_relationship_status === 'divorced')
    {
        echo 'Marital Status: Divorced | ' ;
    }
    echo '
</div>';

if( isset($EHR_document_related_clinic_doctor_name) )
{
    echo '<div style="float:right;font-size:16px;margin-right:10px;" >Doctor: '.$EHR_document_related_clinic_doctor_name.' | </div>' ;
}

if( strlen($result_of_patients_general_infos->patient_birth_day) > 0 )
{
    echo '<div style="float:right;font-size:16px;margin-right:10px;" >Birthday: '.$result_of_patients_general_infos->patient_birth_day.' | </div>' ;
}

if( Auth::user()->telegram === 'true' )
{
    if( strlen($result_of_patients_general_infos->patient_from_external_platform_id) > 0  )
    {
        echo '<div style="float:right;font-size:16px;margin-right:10px;" ><span class="glyphicon glyphicon-ok" aria-hidden="true" ></span> Connected to Bot | </div>' ;
    }
    else
    {
        echo '<div style="float:right;font-size:16px;margin-right:10px;" ><span class="glyphicon glyphicon-remove" aria-hidden="true" style="color:red;opacity:50%;" ></span> Dose not Connected to Bot | </div>' ;
    }
}

echo '
</div>

<!-- START Tab panes -->
<div class="tab-content">

<div style="float:right;margin-right: 20px;position: fixed;bottom: 50px;right: 0px;font-size:16pt;color: #73879C;margin-bottom:16px;" >
    to store new EHR information press the Save button at the end of visiting
    <span class="glyphicon glyphicon-arrow-down" aria-hidden="true"></span>
</div>

<input  type="hidden"  name="encrypted_patient_id"                    value="'.$EHR_document_patient_related_id_encrypted.'" >
<input  type="hidden"  name="encrypted_patient_name"                  value="'.encryptDecrypt('encrypt', $result_of_patients_general_infos->patient_first_name.' '.$result_of_patients_general_infos->patient_last_name).'" >
<input  type="hidden"  name="EHR_document_related_appointment_id"     value="'.$EHR_document_related_appointment_id.'" >
<input  type="hidden"  name="EHR_document_related_clinic_doctor_name" value="'.$EHR_document_related_clinic_doctor_name.'" >

<button type="submit"  name="final" class="btn btn-success btn-lg btn-block col-md-12 col-sm-12 col-xs-12 uiuxtrick" style="font-size:25px;position: fixed;bottom: 0px;right: 0px;z-index: 1;" onclick="this.disabled=true;this.form.submit();formSubmitting=true;" ><i class="fa fa-folder-open-o" aria-hidden="true"></i> Save</button>

                    </div>
                    <!-- END Tab panes -->

                </div>

          </form>

      </div>

    </div>
</div>' ;

// Call the footer layout
require_once '../resources/views/back/layout/footer.php' ;
?>