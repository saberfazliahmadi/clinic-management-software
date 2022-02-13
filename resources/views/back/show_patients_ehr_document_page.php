<?php

// Add your custom css files here. (will located in header)
use Illuminate\Support\Facades\Auth;

$extra_links_header = '
' ;

// Add your custom js files here. (will located in footer)
$extra_links_footer = '
' ;

// Call the header include.
include 'layout/header.php' ;

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
        text-align: right;
        font-size: 19px;
    }

    .dropdown-menu
    {
        width:100%;
    }

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
    .modal.modal-fullscreen.force-fullscreen .modal-body{padding:0}
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

</style>
<?php

echo '
<!-- page content -->
<div class="right_col" role="main" >
    <div class="form-group col-md-12 col-sm-12 col-xs-12" > ' ;

// START of show to Admin user type.
if( Auth::user()->user_type == 'admin' )
{
foreach ( $result_of_show_patients_general_infos as $key )
{
    $cms_menu_title = explode("," , Auth::user()->cms_menu_title)  ;

    // START of content.
    echo '
    <!-- display a loading icon until the page loads completely -->
    <div id="load"></div>

    <!-- START of page content -->
    
  <div class="col-md-12 col-sm-12 col-xs-12" >

      <form id="medical-file-form" method="POST" action="'.route('store_patients_ehr_document_page' , ['patient_id' => $key->patient_id ]).'" class="controls export-svg" enctype="multipart/form-data" onsubmit="setFormSubmitting()" >
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

                            // Make a trick to prevent from POST method error (post method should'nt have Space in content)
                            $common_hypersensitivity = str_replace( " " , "_" , Auth::user()->common_hypersensitivity ) ;
                            // Explode and array these title.
                            $common_hypersensitivity = explode(",",$common_hypersensitivity)  ;
                            // Estimate how many title this text have.
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
                                <input type="text" name="keyboard_savabegh" style="width:100%;text-align:right;direction:rtl;font-size:22px;height:40px;border: 1px solid #CCC;" placeholder="Type your favorite '.$cms_menu_title[5].'" >
                            </div>';

                            // If there was any more description value then show it
                            if( strlen($key->patient_more_description) > 0 )
                            {
                                echo '
                                <div class="form-group col-md-12 col-sm-12 col-xs-12 well" style="background-color:white;margin:0px 0px 0px 0px;padding:0px 0px 0px 0px;margin-top:25px;border: 1px solid #CCC;text-align:center;background-color:white;line-height: 40px;font-size:22px; word-break: break-all;" >
                                    <center>
                                        <span>
                                            More Description
                                        </span>
                                        <br>
                                    '.$key->patient_more_description.'
                                    </center>
                                </div>';
                            }

                            echo '
                            <input type="hidden" name="more_description" class="tags form-control" value="'.$key->more_description.'" >
                        
                          </div>
                        
                          <div class="form-group col-md-3 col-sm-3 col-xs-12" style="margin-top: 15px;" >
                            <center>
                                <h2 class="control-label col-md-12 col-sm-12 col-xs-12" style="margin-bottom:5px;margin-top:5px;text-align:center;" >
                                    History of Surgery
                                </h2>
                            
                                <div class="col-md-12 col-sm-12 col-xs-12" >
                                  '.$key->patient_surgery_history.'
                                </div>
                            </center>
                          </div>
                        
                          <div class="form-group col-md-3 col-sm-3 col-xs-12" style="margin-top: 15px;" >
                            <center>
                                <h2 class="control-label col-md-12 col-sm-12 col-xs-12" style="margin-bottom:5px;margin-top:5px;text-align:center;" >
                                    Disease Background
                                </h2>
                            
                                <div class="col-md-12 col-sm-12 col-xs-12" >
                                  '.$key->patient_disease_background.'
                                </div>
                            </center>
                          </div>
                        
                          <div class="form-group col-md-3 col-sm-3 col-xs-12" style="margin-top: 15px;" >
                            <center>
                                <h2 class="control-label col-md-12 col-sm-12 col-xs-12" style="margin-bottom:5px;margin-top:5px;text-align:center;" >
                                    Medications
                                </h2>
                            
                                <div class="col-md-12 col-sm-12 col-xs-12" >
                                  '.$key->patient_medication_history.'
                                </div>
                            </center>
                          </div>
                        
                          <div class="form-group col-md-3 col-sm-3 col-xs-12" style="margin-top: 15px;" >
                            <center>
                                <h2 class="control-label col-md-12 col-sm-3 col-xs-12" style="margin-bottom:5px;margin-top:5px;text-align:center;" >
                                    History of Allergies
                                </h2>
                            
                                <div class="col-md-12 col-sm-12 col-xs-12" >
                                    '.$key->patient_allergies_history.'
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
                                    // Make a trick to prevent from POST method error (post method should not have Space in its content)
                                    $common_drug = str_replace( " " , "_" , Auth::user()->common_drug ) ;
                                    // Explode and array these title.
                                    $common_drug_1 = explode("," , $common_drug);
                                    // Estimate how many title this text have.
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
                                                <div class="col-md-12 col-sm-12 col-xs-12 collapse" id="'.$start.'" style="font-family:tahoma!important;" >
                                                  <div class="btn-group btn-group-justified" data-toggle="buttons" style="font-size: 13px!important;height:60px;" >
                                    
                                                    <label class="btn btn-default" data-toggle-class="btn-primary" >
                                                      <input type="radio" name="'.$common_drug_1[$start].'" value="روزانه_یک_عدد" > Daily
                                                    </label>
                                    
                                                    <label class="btn btn-default" data-toggle-class="btn-primary" >
                                                      <input type="radio" name="'.$common_drug_1[$start].'" value="هر_شب_یک_عدد" > Qhs
                                                    </label>
                                    
                                                    <label class="btn btn-default" data-toggle-class="btn-primary" >
                                                      <input type="radio" name="'.$common_drug_1[$start].'" value="مصرف_موضعی_سه_بار_در_روز" > TOP.TDS
                                                    </label>
                                    
                                                    <label class="btn btn-default" data-toggle-class="btn-primary" >
                                                      <input type="radio" name="'.$common_drug_1[$start].'" value="مصرف_موضعی_دو_بار_در_روز" > TOP.BD
                                                    </label>
                                    
                                                    <label class="btn btn-default" data-toggle-class="btn-primary" >
                                                      <input type="radio" name="'.$common_drug_1[$start].'" value="هم_اکنون_همین_یک_بار" > Stat
                                                    </label>
                                    
                                                    <label class="btn btn-default" data-toggle-class="btn-primary" >
                                                      <input type="radio" name="'.$common_drug_1[$start].'" value="صبح_ها_قبل_از_صبحانه" > Fasting
                                                    </label>
                                    
                                                    <label class="btn btn-default" data-toggle-class="btn-primary" >
                                                      <input type="radio" name="'.$common_drug_1[$start].'" value="بعد_از_نهار" > Lunch
                                                    </label>
                                    
                                                    <label class="btn btn-default" data-toggle-class="btn-primary" >
                                                      <input type="radio" name="'.$common_drug_1[$start].'" value="بعد_از_شام" > Dinner
                                                    </label>
                                    
                                                    <label class="btn btn-default" data-toggle-class="btn-primary" >
                                                      <input type="radio" name="'.$common_drug_1[$start].'" value="بعد_صبحانه_و_بعد_از_شام" > BD
                                                    </label>
                                    
                                                    <label class="btn btn-default" data-toggle-class="btn-primary" >
                                                      <input type="radio" name="'.$common_drug_1[$start].'" value="بعد_از_صبحانه_بعد_از_نهار_بعد_از_شام" > TDS
                                                    </label>
                                    
                                                    <label class="btn btn-default" data-toggle-class="btn-primary" >
                                                      <input type="radio" name="'.$common_drug_1[$start].'" value="هر_چهار_ساعت" > Q4H
                                                    </label>
                                    
                                                    <label class="btn btn-default" data-toggle-class="btn-primary" >
                                                      <input type="radio" name="'.$common_drug_1[$start].'" value="هر_شش_ساعت" > Q6H
                                                    </label>
                                    
                                                    <label class="btn btn-default" data-toggle-class="btn-primary" >
                                                      <input type="radio" name="'.$common_drug_1[$start].'" value="بعد_از_صبحانه_و_بعد_از_نهار" > F/L
                                                    </label>
                                    
                                                    <label class="btn btn-default" data-toggle-class="btn-primary" >
                                                      <input type="radio" name="'.$common_drug_1[$start].'" value="به_هنگام_نیاز_یا_به_هنگام_درد" > PRN
                                                    </label>
                                    
                                                    <label class="btn btn-default" data-toggle-class="btn-primary" >
                                                      <input type="radio" name="'.$common_drug_1[$start].'" value="یک_روز_در_میان" > qod
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
                                                      <input type="radio" name="'.$common_drug_1[$start].'" value="هر_شش_ماه" >
                                                      6m
                                                    </label>
                                    
                                                    <label class="btn btn-default" data-toggle-class="btn-primary" >
                                                      <input type="radio" name="'.$common_drug_1[$start].'" value="45_روز_یک_بار" >
                                                      45d
                                                    </label>
                                    
                                                    <label class="btn btn-default" data-toggle-class="btn-primary" >
                                                      <input type="radio" name="'.$common_drug_1[$start].'" value="هر_دو_ماه_یک_بار" >
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
                                // Make a trick to prevent from POST method error (post method should'nt have Space in content)
                                $common_rejim = str_replace( " " , "_" , Auth::user()->common_diet ) ;
                                // Explode and array these title
                                $common_rejim_1 = explode(",",$common_rejim) ;
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
                                    <select name="rejim[]" id="dates-field211" class="col-md-12 col-sm-12 col-xs-12 multiselect-ui" multiple="multiple" >' ;
                                        // START of make a for loop to access all common_rejim_1
                                        for( $start='0' ; $start < $end ; $start++ )
                                        {
                                            if(strlen($common_rejim_1[$start])>'0')
                                            {
                                                echo '
                                                <option value="'.$common_rejim_1[$start].'" class="col-md-4 col-sm-12 col-xs-12" >
                                                    '.$common_rejim_1[$start].'
                                                </option>';
                                            }
                                        } // END of make a for loop to access all common_rejim_1
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
                                <input type="text" name="keyboard_rejim"  style="width:100%;text-align:right;direction:rtl;font-size:22px;height:40px;border:1px solid #CCC;" placeholder="Type your favorite '.$cms_menu_title[3].'" >
                            </div>';

                            echo '
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
                                    // Make a trick to prevent from POST method error (post method should'nt have Space in content)
                                    $common_return_date = str_replace( " " , "_" , Auth::user()->common_return_date ) ;
                                    // Explode and array these title.
                                    $common_return_date_1 = explode(",",$common_return_date);

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
                                        // START of make a for loop to access all common_return_date_1 .
                                        for( $start='0' ; $start < $end ; $start++ )
                                        {
                                            if(strlen($common_return_date_1[$start])>'0')
                                            {
                                                echo '
                                                <option value="'.$common_return_date_1[$start].'" class="col-md-4 col-sm-12 col-xs-12" >
                                                    '.$common_return_date_1[$start].'
                                                </option>';
                                            }
                                        } // END of make a for loop to access all common_return_date_1 .
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
                                    <input type="text" name="keyboard_moraje_badi"  style="width:100%;text-align:right;direction:rtl;font-size:22px;height:40px;border:1px solid #CCC;" placeholder="Type your favorite '.$cms_menu_title[2].'" >
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
                            <a id="various222" href="#paraclinic" type="button" aria-controls="profile" type="button" role="tab" data-toggle="tab" >
                                '.$cms_menu_title[1].'
                            </a>
                        </li>
                        
                        <!-- START of login fancy console panel paraclinic -->
                        <div style="display:none;" >
                            <div id="paraclinic" style="height:550px;width:900px!important;overflow-x: hidden!important;padding-bottom:30px;padding-top:35px;" >
                        
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
                                                Guide - Must Read
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
                                                می توانید تصاویر جراحی, سی تی اسکن, سونوگرافی, رادیولوژی و جواب آزمایشات بیمار را در این قسمت اضافه و در انتها ذخیره نمایید
                                            </h4>
                                            <h4 class="col-md-12 col-sm-12 col-xs-12 text-center" >
                                                جهت ذخیره صحیح تصاویر باید موارد زیر را رعایت بفرمایید
                                            </h4>
                                            <h4 class="col-md-12 col-sm-12 col-xs-12 text-center" >
                                                اگر با گوشی موبایل یا تبلت خود عکس می گیرید ابتدا کیفیت دوربین موبایل یا تبلت تان را روی 4 مگاپیکسل تنظیم نمایید و سپس عکس بگیرید
                                            </h4>
                                            <h4 class="col-md-12 col-sm-12 col-xs-12 text-center" >
                                                اگر با دستگاه اسکنر عکس را ذخیره می کنید حجم عکس باید کمتر از 700 کیلو بایت باشد
                                            </h4>
                                            <h4 class="col-md-12 col-sm-12 col-xs-12 text-center" >
                                                در انتهای ویزیت بیمار حتما روی دکمه ذخیره کلیک نمایید
                                            </h4>
                                         <center>
                        
                                        </div>
                                    </div>
                                </div>
                                <!-- END of login fancy console panel help_photo_upload -->
                        
                                <div class="col-md-12 col-sm-12 col-xs-12" >' ;

                                    // START of if there was paraclinic data for this sicker.
                                    if( $num_result_of_patients_photo > 0)
                                    {
                                        // Make a count variable trick
                                        $count_trick_paraclinic_photo = 0 ;

                                        foreach ( $result_of_patients_photo as $key_patient_photo )
                                        {
                                            $count_trick_paraclinic_photo  = $key_patient_photo->patients_photos_id ;
                                            // let to sum patients_photos_id with 17 to prevent hack calculation
                                            $count_trick_paraclinic_photo += 17		     ;

                                            // Let to make a variable trick for show file title in all situation
                                            if( strlen($key_patient_photo->patients_photos_file_description) > 0 )
                                            {
                                                $patients_photos_file_description = $key_patient_photo->patients_photos_file_description ;
                                            }
                                            else
                                            {
                                                $patients_photos_file_description = 'Without title '.$count_trick_paraclinic_photo ;
                                            }

                                            echo '
                                            <a class="fancybox-buttons" href="'.url('images/'.Auth::user()->name.'/'.$key_patient_photo->patients_photos_patient_related_id.'/para/'.$key_patient_photo->patients_photos_file_name).'" data-fancybox-group="button" style="text-align:center;" >
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
                                                            </div>l
                                                         </b>
                                                      </h2>
                                                    </div>
                                                </div>
                                            </a>';
                                        }
                                    }
                                    // END of if there was paraclinic data for this sicker
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
                        <!-- END of login fancy console panel paraclinic -->';
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
                        
                        <!-- START of login fancy console panel sharhe_hal_haye_pishin_category -->
                        <div style="display:none;" >
                            <div id="previous_patient_history_category" style="height:550px;width:900px!important;overflow-x: hidden!important;padding-bottom:30px;padding-top:35px;" >
                                <div class="col-md-12 col-sm-12 col-xs-12 text-center" >
                                    <center>
                        
                                        <br>
                                        <hr style="width:1px;" >
                        
                                        <a id="various222" href="#sharhe_hal_haye_pishin_normal" type="button" aria-controls="profile" role="tab" data-toggle="tab" class="btn btn-success btn-group col-md-10 col-sm-10 col-xs-10" style="float:none;font-size:25px;" >
                                            Prescriptions given to the patient
                                        </a>
                        
                                        <!-- START of login fancy console panel sharhe_hal_haye_pishin_normal -->
                                        <div style="display:none;" >
                                            <div id="sharhe_hal_haye_pishin_normal" style="height:80px!important;width:920px!important;overflow-x: hidden!important;" >' ;

                                                //// Create mysql query for extract all of titles record in mysql data base we want to avoid these title.
                                                // $res_sik_doc_time_line = mysql_query( " SELECT sic_rel_id , doc_rel_id , doc_id , doc_turn_id , child_dr_name_rel_doc , doc_date_created FROM $DB_NAME_LOGIN.sik_doc
                                                //                                                                                                WHERE sic_rel_id     = '".filter($sicker_id)."'
                                                //                                                                                                AND   doc_rel_id     = '".filter($_SESSION['user_id'])."'
                                                //                                                                                                ORDER BY doc_id DESC
                                                //                                                                                              " , $database_connection) or die( " Error : Connection section res_sik_doc_time_line . " .mysql_error() ) ;

                                                $res_sik_doc_time_line = $count_number_of_ehr_document ;
                                                // START  of if there was more than 1 document for this sicker then show it on document time line
                                                if( $res_sik_doc_time_line > 0 )
                                                {
                                                    echo '
                                                    <div class="col-md-12 col-sm-12 col-xs-12" >'.$res_sik_doc_time_line ;

                                                    // Make a trick to prevent from POST method error (post method should'nt have Space in him content)
                                                    $common_rejim = str_replace( "_" , " " , $common_rejim ) ;
                                                    //$common_rejim = str_replace( "," , "\n" , $common_rejim ) ;

                                                    $common_drug = str_replace( "_" , " " , $common_drug ) ;
                                                    //$common_drug = str_replace( "," , "\n" , $common_drug ) ;

                                                    $common_return_date = str_replace( "_" , " " , $common_return_date ) ;
                                                    //$common_return_date = str_replace( "," , "\n" , $common_return_date ) ;

                                                    echo '
                                                    <!-- START Modal -->
                                                    <div id="amghezi" class="modal fade modal-fullscreen" role="dialog" >
                                                        <div class="modal-dialog">
                                                            <!-- Modal content-->
                                                            <div class="modal-content" style="margin-top: 100px!important;" >' ;

                                                                if( strlen($cms_menu_title[4]) > 0 )
                                                                {
                                                                    echo '
                                                                    <div class="well col-md-3 col-sm-3 col-xs-3" style="background-color: inherit;border-bottom:0px;border-left:0px;font-size:17px;margin-bottom:0px;padding-bottom:0px;" >
                                                                        : '.$cms_menu_title[4].' added
                                                                        <p class="common-drug"></p>
                                                                    </div>';
                                                                }

                                                                if( strlen($cms_menu_title[3]) > 0 )
                                                                {
                                                                    echo '
                                                                    <div class="well col-md-3 col-sm-3 col-xs-3" style="background-color: inherit;border-bottom:0px;border-left:0px;font-size:17px;margin-bottom:0px;padding-bottom:0px;" >
                                                                        : '.$cms_menu_title[3].' added
                                                                        <p class="common-rejim"></p>
                                                                    </div>';
                                                                }

                                                                if( strlen($cms_menu_title[2]) > 0 )
                                                                {
                                                                    echo '
                                                                    <div class="well col-md-3 col-sm-3 col-xs-3" style="background-color: inherit;border-bottom:0px;border-left:0px;font-size:17px;margin-bottom:0px;padding-bottom:0px;" >
                                                                        : '.$cms_menu_title[2].'
                                                                        <p class="common-return-date"></p>
                                                                    </div>' ;
                                                                }

                                                                echo '
                                                                <div class="well col-md-3 col-sm-3 col-xs-3" style="background-color: inherit;border-bottom:0px;border-left:0px;font-size:17px;margin-bottom:0px;padding-bottom:0px;" >
                                                                    : Doctor
                                                                    <p class="child-dr-name-rel-doc"></p>
                                                                </div>
                                                                
                                                                <div class="modal-body" align="center" style="margin-top:0px;padding-top:0px;">
                                                                    <img src="" class="img-responsive" />
                                                                </div>
                                                                
                                                                <hr style="width:1px;" >
                                                                <hr style="width:1px;" >
                                                                <hr style="width:1px;" >
                                                                <hr style="width:1px;" >
                                                                
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-success btn-group col-md-12 col-sm-12 col-xs-12" data-dismiss="modal" style="font-size: 25px;position: fixed;bottom: 0px;right: 0px;z-index: 1;">
                                                                        Close
                                                                    </button>
                                                                </div>
                                                    
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- END Modal -->' ;

                                                //    // START of while.
                                                //    while( $row_sik_doc_time_line = mysql_fetch_array($res_sik_doc_time_line) )
                                                //    {
                                                //        extract( $row_sik_doc_time_line ) ;
                                                //
                                                //        // Create mysql query for extract all of titles record in mysql data base we want to avoid these title.
                                                //        $res_turns_flow = mysql_query( " SELECT * FROM $DB_NAME_LOGIN.turns_flow
                                                //                                             WHERE turn_id        = '".filter($doc_turn_id)."'
                                                //                                             AND   dr_related_id  = '".filter($_SESSION['user_id'])."'
                                                //                                             LIMIT 1
                                                //                                           " , $database_connection) or die( " Error : Connection section res_turns_flow Failed . " .mysql_error() ) ;

                                                //        if( mysql_num_rows($res_turns_flow) > 0 )
                                                //        {
                                                //            // START of while.
                                                //            while( $row_turns_flow = mysql_fetch_array($res_turns_flow) )
                                                //            {
                                                //                extract( $row_turns_flow ) ;

                                                //                echo '
                                                //                <div style="float:left;" >
                                                //                    <button type="button" class="btn btn-default showAmghezi" data-toggle="modal" data-target="#amghezi" url="'.$INDEX_LINK.'show_svg.php?doc_id='.$doc_id.'&sicker_id='.$sicker_id.$st_2_trick.'" target="_blank style="float:left;font-size:16px!important;width:auto;height:35px;" >
                                                //                        Date of appointment : '.$turn_date.'
                                                //                        <i class="fa fa-clone" style="font-size:18px!important;" ></i>
                                                //                    </button>
                                                //                    <span class="glyphicon glyphicon-triangle-right" aria-hidden="true" style="top:10px;font-size: 21pt;opacity: 0.5;"></span>
                                                //                </div>' ;
                                                //            }
                                                //        }
                                                //        else
                                                //        {
                                                //            echo '
                                                //             <div style="float:left;" >
                                                //                    <button type="button" class="btn btn-default showAmghezi" data-toggle="modal" data-target="#amghezi" url="'.$INDEX_LINK.'show_svg.php?doc_id='.$doc_id.'&sicker_id='.$sicker_id.$st_2_trick.'" target="_blank style="float:left;font-size:16px!important;width:auto;height:35px;" >
                                                //                        Without date of appointment : '.$doc_date_created.'
                                                //                        <i class="fa fa-clone" style="font-size:18px!important;" ></i>
                                                //                    </button>
                                                //                    <span class="glyphicon glyphicon-triangle-right" aria-hidden="true" style="top:10px;font-size: 21pt;opacity: 0.5;"></span>
                                                //              </div>' ;
                                                //        }

                                                //    }
                                                //    // END of while.

                                                    echo '
                                                    </div>' ;

                                                }
                                                // END  of if there was more than 1 document for this sicker then show it on document time line.
                                                else
                                                {
                                                    echo '
                                                    <center>
                                                        <div class="col-md-12 col-sm-12 col-xs-12" >
                                                            <h3 style="padding-top:10px;font-size:25px;opacity:0.7;text-align:center;" >
                                                                 <i class="glyphicon glyphicon-file" style="font-size:46px;padding: 19px;float:right;" ></i>
                                                                 No appointment has been booked for this patient so far and there are no referral details
                                                            </h3>
                                                        </div>
                                                    </center>';
                                                }

                                            echo '
                                            </div>
                                        </div>
                                        <!-- END of login fancy console panel sharhe_hal_haye_pishin_normal -->' ;

                        if ( strlen($cms_menu_title[7]) > 0 )
                        {
                            echo '
                            <br>
                            <hr style="width:1px;" >
                        
                            <a id="various222" href="#sharhe_hal_haye_pishin_normal_1" type="button" aria-controls="profile" role="tab" data-toggle="tab" class="btn btn-success btn-group col-md-10 col-sm-10 col-xs-10" style="float:none;font-size:25px;" >
                                '.$cms_menu_title[0].' '.$cms_menu_title[7].'
                            </a>
                        
                            <!-- START of login fancy console panel sharhe_hal_haye_pishin_normal_1 -->
                            <div style="display:none;" >
                                <div id="sharhe_hal_haye_pishin_normal_1" style="height:80px!important;width:900px!important;overflow-x: hidden!important;" >' ;

                            // Create mysql query for extract all of titles record in mysql data base we want to avoid these title.
                        //    $res_sharhe_hal_haye_pishin_normal_1 = mysql_query( " SELECT sicker_uniqe_doc_paper_id , sicker_uniqe_doc_paper_sicker_id , sicker_uniqe_doc_paper_dr_rel_id , sicker_uniqe_doc_paper_date_created FROM $DB_NAME_LOGIN.sicker_uniqe_doc_extra_paper
                        //                                         WHERE sicker_uniqe_doc_paper_sicker_id     = '".filter($sicker_id)."'
                        //                                          AND   sicker_uniqe_doc_paper_dr_rel_id     = '".filter($_SESSION['user_id'])."'
                        //                                          ORDER BY sicker_uniqe_doc_paper_id DESC
                        //                                        " , $database_connection) or die( " Error : Connection section res_sharhe_hal_haye_pishin_normal_1 . " .mysql_error() ) ;

                        //    // Let to make a variable to cound sicker_uniqe_doc_paper.
                        //    $mysql_num_rows_res_sharhe_hal_haye_pishin_normal_1 = mysql_num_rows($res_sharhe_hal_haye_pishin_normal_1) ;

                        //    // START  of if there was more than 1 documnet for this sicker then show it on documnet time line.
                        //    if( $mysql_num_rows_res_sharhe_hal_haye_pishin_normal_1 > 0 )
                        //    {
                        //        echo '
                        //        <div class="col-md-12 col-sm-12 col-xs-12" >' ;
                        //
                        //        // Let to Sum this value with 1 to start count from 1 instead of zero
                        //        $mysql_num_rows_res_sharhe_hal_haye_pishin_normal_1 += 1 ;
                        //
                        //        // START of while.
                        //        while( $row_sharhe_hal_haye_pishin_normal_1 = mysql_fetch_array($res_sharhe_hal_haye_pishin_normal_1) )
                        //        {
                        //            extract( $row_sharhe_hal_haye_pishin_normal_1 ) ;
                        //
                        //            // Decrise ONE value from prevues value to count it.
                        //            $mysql_num_rows_res_sharhe_hal_haye_pishin_normal_1 -= 1 ;
                        //
                        //            echo '
                        //                <div style="float:left;" >
                        //                    <button type="button" class="btn btn-default showAmghezi_1" data-toggle="modal" data-target="#amghezi_1" url="'.$INDEX_LINK.'show_svg_1.php?sicker_uniqe_doc_paper_id='.$sicker_uniqe_doc_paper_id.'&sicker_uniqe_doc_paper_sicker_id='.$sicker_uniqe_doc_paper_sicker_id.$st_2_trick.'" target="_blank style="float:left;font-size:18px!important;width:180px;height:35px;" >
                        //                    '.$mysql_num_rows_res_sharhe_hal_haye_pishin_normal_1.'=  '.$sicker_uniqe_doc_paper_date_created.'
                        //                        <i class="fa fa-clone" style="font-size:18px!important;" ></i>
                        //                    </button>
                        //                    <span class="glyphicon glyphicon-triangle-right" aria-hidden="true" style="top:10px;font-size: 21pt;opacity: 0.5;"></span>
                        //                </div>' ;
                        //        }
                        //        // END of while.
                        //
                        //        echo '
                        //        </div>' ;
                        //    }
                        //    // END  of if there was more than 1 documnet for this sicker then show it on documnet time line.
                        //    else
                        //    {
                                echo '
                                <center>
                                    <div class="col-md-12 col-sm-12 col-xs-12" >
                                        <h3 style="font-size:21px;opacity:0.7;text-align:center;" >
                                             <i class="glyphicon glyphicon-file" style="font-size:46px;padding: 19px;float:right;" ></i>
                                             '.$cms_menu_title[0].' for this patient
                                             <br>
                                             '.$cms_menu_title[7].'
                                             <br>
                                             Dose not exist 
                                        </h3>
                                    </div>
                                </center>';
                        //    }

                            echo '
                                </div>
                            </div>
                            <!-- END of login fancy console panel sharhe_hal_haye_pishin_normal_1 -->' ;
                        }

                        if ( strlen($cms_menu_title[8]) > 0 )
                        {
                            echo '
                            <br>
                            <hr style="width:1px;" >
                        
                            <a id="various222" href="#sharhe_hal_haye_pishin_normal_2" type="button" aria-controls="profile" role="tab" data-toggle="tab" class="btn btn-success btn-group col-md-10 col-sm-10 col-xs-10" style="float:none;font-size:25px;" >
                                 '.$cms_menu_title[0].' '.$cms_menu_title[8].'
                            </a> ' ;

                        //    echo '
                        //    <!-- START of login fancy console panel sharhe_hal_haye_pishin_normal_2 -->
                        //    <div style="display:none;" >
                        //    <div id="sharhe_hal_haye_pishin_normal_2" style="height:80px!important;width:900px!important;overflow-x: hidden!important;" >' ;
                        //    $res_sharhe_hal_haye_pishin_normal_2 = mysql_query( " SELECT sicker_uniqe_doc_paper_id_3 , sicker_uniqe_doc_paper_sicker_id_3 , sicker_uniqe_doc_paper_dr_rel_id_3 , sicker_uniqe_doc_paper_date_created_3 FROM $DB_NAME_LOGIN.sicker_uniqe_doc_extra_paper_3
                        //    WHERE sicker_uniqe_doc_paper_sicker_id_3     = '".filter($sicker_id)."'
                        //    AND   sicker_uniqe_doc_paper_dr_rel_id_3     = '".filter($_SESSION['user_id'])."'
                        //    ORDER BY sicker_uniqe_doc_paper_id_3 DESC
                        //    " , $database_connection) or die( " Error : Connection section sicker_uniqe_doc_extra_paper_3 . " .mysql_error() ) ;
                        //
                        //    // Let to make a variable to cound sicker_uniqe_doc_paper.
                        //    $mysql_num_rows_res_sharhe_hal_haye_pishin_normal_2 = mysql_num_rows($res_sharhe_hal_haye_pishin_normal_2) ;
                        //
                        //    // START  of if there was more than 1 documnet for this sicker then show it on documnet time line.
                        //    if( $mysql_num_rows_res_sharhe_hal_haye_pishin_normal_2 > 0 )
                        //    {
                        //    echo '
                        //    <div class="col-md-12 col-sm-12 col-xs-12" >' ;
                        //
                        //    // Let to Sum this value with 1 to start count from 1 instead of zero
                        //    $mysql_num_rows_res_sharhe_hal_haye_pishin_normal_2 += 1 ;
                        //
                        //    // START of while.
                        //    while( $row_sharhe_hal_haye_pishin_normal_3 = mysql_fetch_array($res_sharhe_hal_haye_pishin_normal_2) )
                        //    {
                        //
                        //    extract( $row_sharhe_hal_haye_pishin_normal_3 ) ;
                        //
                        //    // Decrise ONE value from prevues value to count it.
                        //    $mysql_num_rows_res_sharhe_hal_haye_pishin_normal_2 -= 1 ;
                        //
                        //
                        //    echo '
                        //        <div style="float:left;" >
                        //            <button type="button" class="btn btn-default showAmghezi_2" data-toggle="modal" data-target="#amghezi_2" url="'.$INDEX_LINK.'show_svg_2.php?sicker_uniqe_doc_paper_id_3='.$sicker_uniqe_doc_paper_id_3.'&sicker_uniqe_doc_paper_sicker_id_3='.$sicker_uniqe_doc_paper_sicker_id_3.$st_2_trick.'" target="_blank style="float:left;font-size:18px!important;width:180px;height:35px;" >					'.$mysql_num_rows_res_sharhe_hal_haye_pishin_normal_2.'=  '.$sicker_uniqe_doc_paper_date_created_3.'
                        //                <i class="fa fa-clone" style="font-size:18px!important;" ></i>
                        //            </button>
                        //            <span class="glyphicon glyphicon-triangle-right" aria-hidden="true" style="top:10px;font-size: 21pt;opacity: 0.5;"></span>
                        //        </div>' ;
                        //    }
                        //    // END of while.
                        //
                        //    echo '
                        //
                        //    </div>' ;
                        //    }
                        //    // END  of if there was more than 1 documnet for this sicker then show it on documnet time line.
                        //    else
                        //    {
                        //    echo '
                        //    <center>
                        //    <div class="col-md-12 col-sm-12 col-xs-12" >
                        //        <h3 style="font-size:21px;opacity:0.7;text-align:center;" >
                        //             <i class="glyphicon glyphicon-file" style="font-size:46px;padding: 19px;float:right;" ></i>
                        //              برای این بیمار '.$cms_menu_title[0].'
                        //              <br>
                        //              '.$cms_menu_title[8].'
                        //              <br>
                        //              وجود ندارد
                        //        </h3>
                        //    </div>
                        //    </center>';
                        //    }
                        //
                        //    echo '
                        //    </div>
                        //    </div>
                        //    <!-- END of login fancy console panel sharhe_hal_haye_pishin_normal_2 -->' ;
                        }

                                    echo '
                                    </center>
                                </div>
                            </div>
                        </div>
                        <!-- END of login fancy console panel sharhe_hal_haye_pishin_category -->';
                    }
                    // END of if $cms_menu_title[0] exist

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

        <div class="col-md-12 col-sm-12 col-xs-12" >

            <hr style="width:1px;" >
            <hr style="width:1px;" >' ;

            //// Create mysql query for extract chart data.
            //$res_sik_doc_chart = mysql_query( " SELECT sic_rel_id , doc_rel_id , doc_id , doc_date_created , chart_1 , chart_2 ,chart_3 , chart_4 FROM $DB_NAME_LOGIN.sik_doc
            //                                        WHERE sic_rel_id     = '".filter($sicker_id)."'
            //                                        AND   doc_rel_id     = '".filter($_SESSION['user_id'])."'
            //                                        ORDER BY doc_id ASC
            //                                      " , $database_connection) or die( " Error : Connection section res_sik_doc_time_line . " .mysql_error() ) ;
            //
            //if( mysql_num_rows($res_sik_doc_chart) > 0 )
            //{
            //    echo '
            //    <div class="col-md-12 col-sm-12 col-xs-12" >
            //        <center>
            //            <font size="+2" class="text-center" style="float:none;" >
            //                <span> مقایسه همزمان شاخص های حیاتی بیمار بر روی نمودار در گذر زمان </span>
            //            </font>
            //        </center>
            //        <hr style="width:1px;" >
            //        <hr style="width:1px;" >
            //        <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
            //    </div>' ;
            //
            //    $data_chart_date_1  = '' ;
            //    $data_chart_value_1 = '' ;

            //    // START of while.
            //    while( $row_sik_doc_chart = mysql_fetch_array($res_sik_doc_chart) )
            //    {
            //        extract( $row_sik_doc_chart ) ;
            //
            //        // make label chart string variable to use on charts.
            //        $data_chart_date_1    .= "'".$doc_date_created."'," ;
            //        // make data chart string variable to use on charts.
            //        $data_chart_value_1   .= $chart_1.',' 			   ;
            //        $data_chart_value_2   .= $chart_2.',' 			   ;
            //        $data_chart_value_3   .= $chart_3.',' 			   ;
            //        $data_chart_value_4   .= $chart_4.',' 			   ;
            //    }
            //    // END of while.
//
//                echo '
//                <p align="center" style="text-align:center" >
//                    با کلیک بر روی اسم هر نمودار در بالا می توانید نمودار مربوطه را فعال یا غیر فعال نمایید
//                </p>' ;
//            }
//            else
//            {
//                echo '
//                <center>
//                    <div class="col-md-12 col-sm-12 col-xs-12" >
//                        <h3 style="padding-top:10px;font-size:25px;opacity:0.7;text-align:center;" >
//                             <i class="glyphicon glyphicon-file" style="font-size:46px;padding: 19px;float:right;" ></i>
//                             تا به حال برای این بیمار اطلاعاتی ثبت نشده
//                        </h3>
//                    </div>
//                </center>';
//            }

        echo '
        </div>

    </div>
</div>
<!-- END of login fancy console panel chart -->';
}


if ( strlen($cms_menu_title[7]) > 0 || strlen($cms_menu_title[8]) > 0 )
{

    echo '
    <li role="presentation" >
        <a id="various222" href="#new_sicker_uniqe_doc_paper_plz_console" type="button" aria-controls="profile" role="tab" data-toggle="tab" >
            New Paper
        </a>
    </li>
    
    <!-- START of login fancy console panel new_sicker_uniqe_doc_paper_plz_console -->
    <div style="display:none;" >
        <div id="new_sicker_uniqe_doc_paper_plz_console" style="height:550px;width:900px!important;overflow-x: hidden!important;padding-bottom:30px;padding-top:35px;" >
            <div class="col-md-12 col-sm-12 col-xs-12 text-center" >
                <center>
    
                    <div class="col-md-12 col-sm-12 col-xs-12" style="font-size:26px;margin-top:25px;" >
                        If the patient\'s current tab is full, you can add a new tab with a pre-defined design
                    </div>' ;

                    if ( strlen($cms_menu_title[7]) > 0 )
                    {
                        echo '
                        <br>
                        <hr style="width:1px;" >
                        <br>
                        <hr style="width:1px;" >
                        <a id="various222" href="#new_sicker_uniqe_doc_paper_plz" type="button" aria-controls="profile" role="tab" data-toggle="tab" class="btn btn-success btn-group col-md-10 col-sm-10 col-xs-10" style="float:none;font-size:25px;" >
                            Add New '.$cms_menu_title[7].' Paper
                        </a>
                        <br>
                        <hr style="width:1px;" >' ;
                    }
                    if ( strlen($cms_menu_title[8]) > 0 )
                    {
                        echo '
                        <a id="various222" href="#new_sicker_uniqe_doc_paper_plz_3" type="button" aria-controls="profile" role="tab" data-toggle="tab" class="btn btn-success btn-group col-md-10 col-sm-10 col-xs-10" style="float:none;font-size:25px;" >
                             Add New '.$cms_menu_title[8].' Paper
                        </a>' ;
                    }

                echo '
                </center>
            </div>
        </div>
    </div>
    <!-- END of login fancy console panel new_sicker_uniqe_doc_paper_plz_console -->';
}

echo '
</ul>

<div class="well col-md-12 col-sm-12 col-xs-12" style="min-height:52px;" >

    <div style="float:right;font-size:16px;margin-right:9px;" >
        Name: '.$key->patient_first_name.' '.$key->patient_last_name.'
    </div>

    <div style="float:right;font-size:16px;margin-right:10px;" >' ;
        if($key->patient_relationship_status == 'single')
        {
            echo '| marital status Single' ;
        }
        elseif($key->patient_relationship_status == 'married')
        {
            echo '| marital status: Married' ;
        }
        elseif($key->patient_relationship_status == 'divorced')
        {
            echo '| Marital status: Divorced' ;
        }
        echo '
    </div>';

if( isset($_GET['EHR_document_related_clinic_doctor_name']) )
{
    echo '
    <div style="float:right;font-size:16px;margin-right:10px;" >
         &nbsp; Doctor : '.$_GET['EHR_document_related_clinic_doctor_name'].' |
    </div>' ;
}

if( strlen($key->patient_birth_day) > 0 && $key->patient_birth_day !== '0000-00-00' )
{
    echo '
    <div style="float:right;font-size:16px;margin-right:10px;" >
         &nbsp;	Birthdate : '.$key->patient_birth_day.' |
    </div>' ;
}

$options_for_user = (unserialize(Auth::user()->options_for_user)) ;

// START of if user active money section.
if( $options_for_user[0] == 't' )
{
    if( isset($_GET['money_receive']) )
    {
        if( $_GET['money_receive'] == '0' )
        {
            echo '
            <div style="float:right;font-size:16px;margin-right:10px;" title="The fee did not receive" >
                 <span class="glyphicon glyphicon-remove" aria-hidden="true" style="color:red;" ></span> Pay &nbsp; |
            </div>';
        }
        else
        {
            echo '
            <div style="float:right;font-size:16px;margin-right:10px;" title="The fee received '.$_GET['money_receive'].'" >
                 <span class="glyphicon glyphicon-ok" aria-hidden="true" ></span> Pay &nbsp; |
            </div>';
        }
    }
} // END of if user active money section

// START OF IF DR TELEGRAM ACTIVATED
if( Auth::user()->telegram == 'true' )
{
    if( strlen($key->patient_from_external_platform_id) > 0  )
    {
        echo '
        <div style="float:right;font-size:16px;margin-right:10px;" >
             <span class="glyphicon glyphicon-ok" aria-hidden="true" ></span> Connected to Bot &nbsp; |
        </div>' ;
    }
    else
    {
        echo '
        <div style="float:right;font-size:16px;margin-right:10px;" >
             <span class="glyphicon glyphicon-remove" aria-hidden="true" style="color:red;" ></span> Dose not Connected to Bot &nbsp; |
        </div>' ;
    }
}
// END OF IF DR TELEGRAM ACTIVATED

echo '
</div>

<!-- START Tab panes -->
<div class="tab-content">

<div style="float:right;margin-right: 20px;position: fixed;bottom: 50px;right: 0px;font-size:16pt;color: #73879C;margin-bottom:16px;" >
to store new EHR information press the Save button at the end of visiting
<span class="glyphicon glyphicon-arrow-down" aria-hidden="true"></span>
</div> ';

//<input  type="hidden" name="turn_id"               value="'.$_GET['turn_id'].'"               >
//<input  type="hidden" name="sicker_id"             value="'.$_GET['sicker_id'].'" 			   >
//<input  type="hidden" name="dr_visit_stat"         value="dr_visited" 						  >
//<input  type="hidden" name="related_child_dr_name" value="'.$_GET['related_child_dr_name'].'" >
//<input  type="hidden" name="svg_post"              value="" id="svg"  						  >

echo '
<button type="submit" name="final" class="btn btn-success btn-group col-md-12 col-sm-12 col-xs-12 uiuxtrick" data-action="export-as-svg" value="Export as SVG" style="font-size:25px;position: fixed;bottom: 0px;right: 0px;z-index: 1;" onclick="this.disabled=true;this.form.submit();formSubmitting=true;" >
Save
</button>';

//if ( strlen($cms_menu_title[6]) > 0 )
//{
//echo '
//<div class="col-md-12 col-sm-12 col-xs-12" style="margin:0px 0px 0px 0px;padding:0px 0px 0px 0px;" >
//    <div class="export-svg fs-container" style="float:right;margin:0px 0px 0px 0px;padding:0px 0px 0px 0px;" >
//        <div id="lc" ></div>
//    </div>
//</div>
//
//<a id="canvas-fullscreen" style="float:left;font-size:25px;position:fixed;bottom:0px;left:0px;z-index:250;margin-bottom:0px;min-width:230px;" class="btn btn-success btn-group" >
//    '.$cms_menu_title[6].'
//</a>
//
//<a id="canvas-close-1" style="float: right; position: absolute;z-index: 1000000;background-image: url(../vendors/fancybox/fancybox_sprite.png);zoom: 3 !important;right: -10px !important;top: -18px !important;cursor: pointer;width: 36px;height: 36px;" >
//
//</a>';
//}

echo '
<!-- START Modal -->
<div id="amghezi" class="modal fade modal-fullscreen" role="dialog" >
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content" style="margin-top: 100px!important;" >' ;

            if( strlen($cms_menu_title[4]) > 0 )
            {
                echo '
                <div class="well col-md-3 col-sm-3 col-xs-3" style="background-color: inherit;border-bottom:0px;border-left:0px;font-size:17px;margin-bottom:0px;padding-bottom:0px;" >
                    : '.$cms_menu_title[4].' added
                    <p class="common-drug"></p>
                </div>';
            }

            if( strlen($cms_menu_title[3]) > 0 )
            {
                echo '
                <div class="well col-md-3 col-sm-3 col-xs-3" style="background-color: inherit;border-bottom:0px;border-left:0px;font-size:17px;margin-bottom:0px;padding-bottom:0px;" >
                    : '.$cms_menu_title[3].' added
                    <p class="common-rejim"></p>
                </div>';
            }

            if( strlen($cms_menu_title[2]) > 0 )
            {
                echo '
                <div class="well col-md-3 col-sm-3 col-xs-3" style="background-color: inherit;border-bottom:0px;border-left:0px;font-size:17px;margin-bottom:0px;padding-bottom:0px;" >
                    : '.$cms_menu_title[2].'
                    <p class="common-return-date"></p>
                </div>' ;
            }

            echo '
            <div class="well col-md-3 col-sm-3 col-xs-3" style="background-color: inherit;border-bottom:0px;border-left:0px;font-size:17px;margin-bottom:0px;padding-bottom:0px;" >
                : Doctor
                <p class="child-dr-name-rel-doc"></p>
            </div>
            
            <div class="modal-body" align="center" style="margin-top:0px;padding-top:0px;">
                <img src="" class="img-responsive" />
            </div>
            
            <hr style="width:1px;" >
            <hr style="width:1px;" >
            <hr style="width:1px;" >
            <hr style="width:1px;" >
            
            <div class="modal-footer">
                <button type="button" class="btn btn-success btn-group col-md-12 col-sm-12 col-xs-12" data-dismiss="modal" style="font-size: 25px;position: fixed;bottom: 0px;right: 0px;z-index: 1;">
                    Close
                </button>
            </div>

        </div>
    </div>
</div>
<!-- END Modal -->' ;

// START of Let to check user visit this page with SUMSUNG GALAXY TAB S3
$is_campatible_android_device = '' 			;
$ua = strtolower($_SERVER['HTTP_USER_AGENT']) ;
if( ( stripos( $ua , 'SM-T825') == true ) && (stripos( $ua , 'Chrome') == true ) )
{ // && stripos($ua,'mobile') !== false) {
$is_campatible_android_device = 'true'    ;

// START of if user visit this page with compatible device with software and PORTRAIT SCREEN THEN alert message to him.
?>
<style type="text/css" >
    /* if portrait mode is detected hidden every thing with css */
    @media (orientation: portrait)
    {
        .body { display: none; }
        div   { display: none; }
        body  { display: none; }
    }
</style>

<script type="text/javascript" >

    // Find matches
    var mql = window.matchMedia("(orientation: portrait)");

    // If there are matches, we're in portrait
    if(mql.matches)
    {
        // Portrait orientation
        alert("Please reset your tablet to landscape mode") ;
    }
    else
    {
    }

    // Add a media query change listener
    mql.addListener(function(m)
    {
        if(m.matches)
        {
            // Changed to Portrait
            // Portrait orientation
            alert("Please reset your tablet to landscape mode") ;
        }
        else
        {
        }
    });

</script>
<?php
// END of if user visit this page with compatible device with software and PORTRAIT SCREEN THEN alert message to him.
}
else
{
    $is_campatible_android_device = 'false' ;
}
// END of Let to check user visit this page with SUMSUNG GALAXY TAB S3

if ( strlen($cms_menu_title[7]) > 0 )
{
    // Let to show this section just on SUMSUNG GALAXY TAB S3
    if( $is_campatible_android_device == 'true' )
    {
        echo '
        <div class="col-md-12 col-sm-12 col-xs-12" style="margin:0px 0px 0px 0px;padding:0px 0px 0px 0px;" >
            <div class="export-svg-2 fs-container-2" style="float:right;margin:0px 0px 0px 0px;padding:0px 0px 0px 0px;" >
                <div id="lc2" ></div>
            </div>
        </div>
    
        <a id="canvas-fullscreen-2" style="float:left;font-size:25px;border: 1px solid #e3e3e3;border-radius: 4px;" class="btn btn-group col-md-12 col-sm-12 col-xs-12" >
             '.$cms_menu_title[7].'
        </a>
    
        <a id="canvas-close-2" style="float: right; position: absolute;z-index: 1000000;background-image: url(../vendors/fancybox/fancybox_sprite.png);zoom: 1.75 !important; right: -14px !important;top:-28px !important;cursor: pointer;width: 36px;height: 36px;" >
    
        </a>';
    }

    echo '
    <!-- START Modal 1 -->
    <div id="amghezi_1" class="modal fade modal-fullscreen" role="dialog" >
      <div class="modal-dialog">

        <!-- Modal 1 content-->
        <div class="modal-content" style="margin-top: 100px!important;" >

          <div class="modal-body" align="center" style="margin-top:0px;padding-top:0px;">
            <img src="" class="img-responsive" />
          </div>
          <hr style="width:1px;" >
          <hr style="width:1px;" >
          <hr style="width:1px;" >
          <hr style="width:1px;" >
          <div class="modal-footer">
            <button type="button" class="btn btn-success btn-group col-md-12 col-sm-12 col-xs-12" data-dismiss="modal" style="font-size: 25px;position: fixed;bottom: 0px;right: 0px;z-index: 1;">
                Close
            </button>
          </div>
        </div>

      </div>
    </div>
    <!-- END Modal 1 -->';
}

if ( strlen($cms_menu_title[8]) > 0 )
{
    // Let to show this section just on SUMSUNG GALAXY TAB S3
    if( $is_campatible_android_device == 'true' )
    {
        echo '
        <div class="col-md-12 col-sm-12 col-xs-12" style="margin:0px 0px 0px 0px;padding:0px 0px 0px 0px;" >
            <div class="export-svg-3 fs-container-3" style="float:right;margin:0px 0px 0px 0px;padding:0px 0px 0px 0px;" >
                <div id="lc3" >
                </div>
            </div>
        </div>
    
    
    
        <a id="canvas-fullscreen-3" style="float:left;font-size:25px;border: 1px solid #e3e3e3;border-radius: 4px;" class="btn btn-group col-md-12 col-sm-12 col-xs-12" >
             '.$cms_menu_title[8].'
        </a>
    
        <a id="canvas-close-3" style="float: right; position: absolute;z-index: 1000000;background-image: url(../vendors/fancybox/fancybox_sprite.png);zoom: 1.75 !important; right: -14px !important;top:-28px !important;cursor: pointer;width: 36px;height: 36px;" >
    
        </a>' ;
    }

    echo '
    <!-- START Modal 2 -->
    <div id="amghezi_2" class="modal fade modal-fullscreen" role="dialog" >
      <div class="modal-dialog">

        <!-- Modal 2 content-->
        <div class="modal-content" style="margin-top: 100px!important;" >

          <div class="modal-body" align="center" style="margin-top:0px;padding-top:0px;">
            <img src="" class="img-responsive" />
          </div>
          <hr style="width:1px;" >
          <hr style="width:1px;" >
          <hr style="width:1px;" >
          <hr style="width:1px;" >
          <div class="modal-footer">
            <button type="button" class="btn btn-success btn-group col-md-12 col-sm-12 col-xs-12" data-dismiss="modal" style="font-size: 25px;position: fixed;bottom: 0px;right: 0px;z-index: 1;">
                Close
            </button>
          </div>
        </div>

      </div>
    </div>
    <!-- END Modal 2 -->';
}

if( isset($_GET['m']) ) {
    if ($_GET['m'] == 'extra_paper_suc_creat') {
        echo '
        <center>
            <div class="col-md-12 col-sm-12 col-xs-12" style="margin:0px 0px 0px 0px;padding:0px 0px 0px 0px;margin-top:30px;" >
                <p style="text-align: center;" >
                    <strong style="font-size: 26px;color:#08c;" >
                        The new patient sheet was successfully created.
                    </strong>
                </p>
            </div>
        </center>';
    }
}

echo '
                    </div>
                    <!-- END Tab panes -->

                </div>

          </form>

      </div>
    
  <!-- END of page content -->';
// END of content.



















}
}
// END of show to Admin user type.
else
{
echo '<P>This page is not accessible for you</P>' ;
}

    echo '
    </div>
</div>
<!-- /page content -->' ;

// Call the footer include.
include 'layout/footer.php' ;
?>
