<?php
namespace AppEHR\Services;

use AppEHR\Interfaces\EHRRepositoryInterface;
use AppEHR\Http\PrepareData;

/** In this service layer, to be able to use some other types of databases that Laravel does not support
 We use Repository Pattern
 Also, usage of the Repository Pattern makes our service layer cleaner **/
class PatientsEHRDocumentsService
{
    private $EHRRepository ;
    private $PrepareData ;
    public function __construct( EHRRepositoryInterface $EHRRepository , PrepareData $PrepareData )
    {
        $this->EHRRepository = $EHRRepository ;
        $this->PrepareData   = $PrepareData ;
    }

    public function ResultOfPatientsEHRPhoto( $decrypted_request_patient_id )
    {
        return $this->EHRRepository->result_of_patient_ehr_photo( $decrypted_request_patient_id ) ;
    }

    public function ResultOfPatientsEHRDocument( $decrypted_request_patient_id )
    {
        return $this->EHRRepository->result_of_patients_ehr_document( $decrypted_request_patient_id ) ;
    }

    public function FetchInfoOfThisPatientId( $decrypted_request_patient_id )
    {
        return $this->EHRRepository->fetch_info_of_this_patient_id( $decrypted_request_patient_id ) ;
    }

    public function UpdateThisPatientGeneralInfoFromEHRPage( $decrypted_request_patient_id , $request_patient_more_description , $request_typed_keyboard_savabegh , $request_common_hypersensitivity_2311 , $request_post_patient_surgery_history , $request_post_patient_disease_background , $request_post_patient_medication_history , $request_post_patient_allergies_history )
    {
        return $this->EHRRepository->update_this_patient_general_info_from_ehr_page(
                $decrypted_request_patient_id,
                $this->PrepareData->prepare_patient_more_description_variable($request_patient_more_description, $request_typed_keyboard_savabegh, $request_common_hypersensitivity_2311) ,
                $request_post_patient_surgery_history ,
                $request_post_patient_disease_background ,
                $request_post_patient_medication_history ,
                $request_post_patient_allergies_history
                ) ;
    }

    public function StoreNewEHRDoc( $request_all , $decrypted_request_patient_id , $request_post_EHR_document_related_appointment_id , $request_post_EHR_document_related_clinic_doctor_name )
    {
        return $this->EHRRepository->store_new_ehr_doc(
            $this->PrepareData->prepare_common_drug_variable($request_all),
            $this->PrepareData->prepare_common_diet_variable($request_all),
            $this->PrepareData->prepare_common_return_date_variable($request_all),
            $decrypted_request_patient_id,
            $this->PrepareData->prepare_EHR_document_related_appointment_id_variable($request_post_EHR_document_related_appointment_id),
            $this->PrepareData->prepare_EHR_document_related_clinic_doctor_name($request_post_EHR_document_related_clinic_doctor_name)
        ) ;
    }

    public function StorePatientPhotoFromEHRPage( $request , $request_keyboard_paraclinic_file_title , $decrypted_request_patient_id )
    {
        return App()->call('App\Http\Controllers\PatientsPhotoController@preparation_file_process_and_upload_image' , [ "request" => $request , "request_keyboard_paraclinic_file_title" => $request_keyboard_paraclinic_file_title , "decrypted_request_patient_id" => $decrypted_request_patient_id ])  ;
    }

    public function ResultOfShowNewSavedEHR( $request_EHR_document_id )
    {
        return $this->EHRRepository->show_new_saved_ehr( encrypt_decrypt('decrypt', $request_EHR_document_id ) ) ;
    }

}