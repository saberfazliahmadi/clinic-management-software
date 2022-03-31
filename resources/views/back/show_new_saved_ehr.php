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
                This information will be sent to the Smartphone of the patient by BOT automatically
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
    \Session::flash('success_message', '<b style="color:blue;" >We have an error to update New Settings of Software</b>');
    return redirect(route('show_main_settings_of_software_form'));
}

// Call the footer include
include 'layout/footer.php' ;
?>


