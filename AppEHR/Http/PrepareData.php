<?php
namespace AppEHR\Http;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Null_;

class PrepareData
{
    public function prepare_patient_more_description_variable($request_patient_more_description,$request_typed_keyboard_savabegh,$request_common_hypersensitivity_2311)
    {
        $patient_more_description  = '' ;
        $patient_more_description .= $request_patient_more_description ;

        if(is_array($request_common_hypersensitivity_2311))
        {
            foreach ($request_common_hypersensitivity_2311 as $item)
            {
                $patient_more_description .= ', '.$item;
            }
        }

        if( $request_typed_keyboard_savabegh !== "" )
        {
            $patient_more_description .= ', '.$request_typed_keyboard_savabegh;
        }

        return $patient_more_description ;
    }

    public function prepare_common_drug_variable($request_all)
    {
        $common_drug = NULL ;
        if( Auth::user()->common_drug !== '' )
        {
            // Explode and make an array of Auth::user()->common_drug
            $defined_common_drugs = explode("," , Auth::user()->common_drug ) ;
            // Estimate how many drugs this variable has to use on for loop
            $end                  = count($defined_common_drugs) ;
            // Make a for loop to check all selected drugs by doctors which should be defined on settings of software page
            for( $start='0' ; $start < $end ; $start++ )
            {
                // An accepted drug should be existed on defined drugs of ADMIN AND selected by user $request->$defined_common_drugs[$start]
                if( strlen($defined_common_drugs[$start]) > 0 && strlen(isset($request_all[$defined_common_drugs[$start]])) > 0 )
                {
                    $common_drug .= $defined_common_drugs[$start].' = '.$request_all[$defined_common_drugs[$start]] ;
                    if( $start < $end - 1 )
                    {
                        $common_drug .= ',' ;
                    }
                }
            }

            // Get keyboard_medications_picker if exist
            if( strlen($request_all['keyboard_medications_picker']) > 0 )
            {
                $common_drug .= $request_all['keyboard_medications_picker'].',' ;
            }
        }
        return $common_drug ;
    }

    public function prepare_common_diet_variable($request_all)
    {
        $common_diet = NULL ;
        if( Auth::user()->common_diet !== "" )
        {
            if(isset($request_all['common_diet']) && is_array($request_all['common_diet']))
            {
                foreach ($request_all['common_diet'] as $item)
                {
                    $common_diet .= $item.',' ;
                }
            }

            // Get keyboard_common_diet if exist
            if( strlen($request_all['keyboard_common_diet']) > 0 )
            {
                $common_diet .= $request_all['keyboard_common_diet'].',' ;
            }
        }
        return $common_diet ;
    }

    public function prepare_common_return_date_variable($request_all)
    {
        $common_return_date = NULL ;
        if( Auth::user()->common_return_date !== "" )
        {
            if(isset($request_all['common_return_date']) && is_array($request_all['common_return_date']))
            {
                foreach ($request_all['common_return_date'] as $item)
                {
                    $common_return_date .= $item.',' ;
                }
            }

            // Get keyboard_common_return_date if exist
            if( strlen($request_all['keyboard_common_return_date']) > 0 )
            {
                $common_return_date .= $request_all['keyboard_common_return_date'].',' ;
            }
        }
        return $common_return_date ;
    }

    public function prepare_EHR_document_related_appointment_id_variable($request_post_EHR_document_related_appointment_id)
    {
        $EHR_document_related_appointment_id_trick = NULL ;
        if( strlen($request_post_EHR_document_related_appointment_id) > 0 )
        {
            $EHR_document_related_appointment_id_trick = $request_post_EHR_document_related_appointment_id ;
        }
        return $EHR_document_related_appointment_id_trick ;
    }

    public function prepare_EHR_document_related_clinic_doctor_name($request_post_EHR_document_related_clinic_doctor_name)
    {
        $EHR_document_related_clinic_doctor_name_trick = NULL ;
        if( strlen($request_post_EHR_document_related_clinic_doctor_name) > 0 )
        {
            $EHR_document_related_clinic_doctor_name_trick = $request_post_EHR_document_related_clinic_doctor_name ;
        }
        return $EHR_document_related_clinic_doctor_name_trick ;
    }
}