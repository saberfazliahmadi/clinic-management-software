<?php
namespace AppEHR\Http\Controller ;

use App\Http\Controllers\Controller ;
use App\Http\Controllers\PatientsPhotoController ;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use AppEHR\Models\patients_EHR_document ;
use App\Models\{ patients_photo , patients_general_info} ;
use App\Responses\Responses ;

/** In this controller according to Single Responsibility and Open-Closed Principles of SOLID
 we validate user inputs by Middlewares **/
class PatientsEHRDocumentController extends Controller
{
    public function show_patients_ehr_document_page( Request $request )
    {
        try
        {
            $decrypted_request_patient_id = encrypt_decrypt('decrypt' , $request->patient_id ) ;

            $result_of_show_patients_general_infos = patients_general_info::fetch_info_of_this_patient_id( $decrypted_request_patient_id ) ;

            $result_of_patients_photo = patients_photo::result_of_patient_ehr_photo( $decrypted_request_patient_id ) ;
            $count_result_of_patients_photo = $result_of_patients_photo->count() ;

            $result_of_patients_ehr_document = patients_EHR_document::result_of_patients_ehr_document( $decrypted_request_patient_id ) ;
            $count_result_of_patients_ehr_document = $result_of_patients_ehr_document->count() ;

            return Responses::view('EHR::show_patients_ehr_document_page' ,
            [
                'title_of_page'                             => 'EHR of Patient' ,
                'EHR_document_patient_related_id'           => $request->patient_id ,
                'EHR_document_dr_related_id'                => find_admin_id_from_users_table() ,
                'EHR_document_related_appointment_id'       => $request->related_appointment_id ,
                'EHR_document_related_clinic_doctor_name'   => $request->child_dr_related_name ,
                'result_of_patients_photo'                  => $result_of_patients_photo ,
                'count_result_of_patients_photo'            => $count_result_of_patients_photo ,
                'result_of_patients_ehr_document'           => $result_of_patients_ehr_document ,
                'count_result_of_patients_ehr_document'     => $count_result_of_patients_ehr_document ,
                'result_of_patients_general_infos'          => $result_of_show_patients_general_infos ,
                'admin_id_from_users_table'                 => find_admin_id_from_users_table()
            ]) ;
        }
        catch (QueryException $exception)
        {
            return Responses::FailedWithException( 'home' , '' , '<span style="color:blue;">Can not display this EHR!</span>' , $exception ) ;
        }
    }

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

    public function store_patients_ehr_document_page( Request $request )
    {
        try
        {
            $decrypted_request_patient_id = encrypt_decrypt('decrypt', $request->patient_id ) ;

            $patient_more_description = $this->prepare_patient_more_description_variable($request->patient_more_description, $request->typed_keyboard_savabegh, $request->common_hypersensitivity_2311) ;

            $result_update_this_patient_general_info = patients_general_info::update_this_patient_general_info_from_ehr_page($decrypted_request_patient_id, $patient_more_description, $request->post('patient_surgery_history'), $request->post('patient_disease_background'), $request->post('patient_medication_history'), $request->post('patient_allergies_history') ) ;
            if ( ! $result_update_this_patient_general_info )
            {
                return Responses::Failed( 'home', '' , '<span style="color:blue;">New information of patient DOES NOT updated! <br> So the New Photo and new EHR information of patient did not save also</span>' ) ;
            }

            $common_drug        = $this->prepare_common_drug_variable($request->all()) ;
            $common_diet        = $this->prepare_common_diet_variable($request->all()) ;
            $common_return_date = $this->prepare_common_return_date_variable($request->all()) ;

            $EHR_document_related_appointment_id_trick     = $this->prepare_EHR_document_related_appointment_id_variable($request->post('EHR_document_related_appointment_id')) ;
            $EHR_document_related_clinic_doctor_name_trick = $this->prepare_EHR_document_related_clinic_doctor_name($request->post('EHR_document_related_clinic_doctor_name'));

            $result_store_new_ehr_doc = patients_EHR_document::store_new_ehr_doc($common_drug, $common_diet, $common_return_date, $decrypted_request_patient_id, $EHR_document_related_appointment_id_trick, $EHR_document_related_clinic_doctor_name_trick) ;
            if ( ! $result_store_new_ehr_doc->exists )
            {
                return Responses::Failed( 'home' , '' , '<span style="color:blue;">New EHR information did not Save! <br> So the New Photo of patient did not save also if you inserted it!</span>' ) ;
            }

            // If an image for uploading exist
            if ( $request->hasFile('image') )
            {
                $store_patient_photo_from_ehr_page = PatientsPhotoController::preparation_file_process_and_upload_image($request,$request->keyboard_paraclinic_file_title ,$decrypted_request_patient_id) ;
                if ( ! $store_patient_photo_from_ehr_page->exists )
                {
                    return Responses::Failed( 'home' , '' , '<span style="color:blue;">New Photo of patient did not save but the other new EHR information have been saved successfully!</span>' ) ;
                }
            }
            return Responses::Success('show_new_saved_ehr' , array( 'EHR_document_id' => encrypt_decrypt('encrypt', $result_store_new_ehr_doc->EHR_document_id ) , 'patient_name' => $request->patient_name ) , '' ) ;
        }
        catch ( QueryException $exception )
        {
            return Responses::FailedWithException('home', '' , '<span style="color:blue;">Can not Save new EHR information!</span>' , $exception ) ;
        }
    }

    public function show_new_saved_ehr( Request $request )
    {
        try
        {
            $result_show_new_saved_ehr = patients_EHR_document::show_new_saved_ehr( encrypt_decrypt('decrypt', $request->EHR_document_id) ) ;
            return Responses::view('EHR::show_new_saved_ehr' ,
            [
                'title_of_page'                            => 'a new EHR information of <b>'.encrypt_decrypt('decrypt',$request->patient_name).'</b> <br> successfully saved at date '.date("Y/m/d") ,
                'show_ehr_report'                          => 'true' ,
                'EHR_document_patient_related_id'          => $result_show_new_saved_ehr->EHR_document_patient_related_id ,
                'EHR_document_prescribed_common_drug'      => $result_show_new_saved_ehr->EHR_document_prescribed_common_drug ,
                'EHR_document_prescribed_common_diet'      => $result_show_new_saved_ehr->EHR_document_prescribed_common_diet ,
                'EHR_document_prescribed_next_appointment' => $result_show_new_saved_ehr->EHR_document_prescribed_next_appointment ,
                'EHR_document_related_clinic_doctor_name'  => $result_show_new_saved_ehr->EHR_document_related_clinic_doctor_name ,
                'EHR_document_dr_related_id'               => find_admin_id_from_users_table() ,
            ] ) ;
        }
        catch (QueryException $exception)
        {
            return Responses::FailedWithException( 'home' , '' , '<span style="color:blue;">Can not show new saved EHR!</span>' , $exception);
        }
    }

}
