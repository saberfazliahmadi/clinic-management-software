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
    <div class="form-group col-md-12 col-sm-12 col-xs-12" > ' ;

        if( Auth::user()->user_type == 'admin' )
        {
            foreach ( $result_of_show_patients_ehr_document_page as $key )
            {
                echo
                $key->EHR_document_patient_related_id.'<br>
                '.$key->EHR_document_dr_related_id.'<br>
                '.$key->EHR_document_related_appointment_id.'<br>
                '.$key->EHR_document_prescribed_common_drug.'<br>
                '.$key->EHR_document_prescribed_common_diet.'<br>
                '.$key->EHR_document_prescribed_next_appointment.'<br>
                '.$key->EHR_document_related_clinic_doctor_name.'<br>
                '.$key->patient_first_name.'<br>' ;
            }
        }
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
