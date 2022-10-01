<?php
namespace AppEHR\Services;

use AppEHR\Interfaces\EHRRepositoryInterface;
use AppEHR\Http\PrepareData;

/** In this service layer, to be able to use some other types of databases in future that Laravel does not support them
 We have decided to use Repository Pattern
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

    public function resultOfPatientsEHRPhoto($decrypted_request_patient_id)
    {
        return $this->EHRRepository->resultOfPatientEhrPhoto($decrypted_request_patient_id) ;
    }

    public function resultOfPatientsEHRDocument($decrypted_request_patient_id)
    {
        return $this->EHRRepository->resultOfPatientsEhrDocument($decrypted_request_patient_id) ;
    }

    public function fetchInfoOfThisPatientId($decrypted_request_patient_id)
    {
        return $this->EHRRepository->fetchInfoOfThisPatientId($decrypted_request_patient_id) ;
    }

    public function updateThisPatientGeneralInfoFromEHRPage($decrypted_request_patient_id , $request_patient_more_description , $request_typed_keyboard_savabegh , $request_common_hypersensitivity_2311 , $request_post_patient_surgery_history , $request_post_patient_disease_background , $request_post_patient_medication_history , $request_post_patient_allergies_history )
    {
        return $this->EHRRepository->updateThisPatientGeneralInfoFromEhrPage(
                $decrypted_request_patient_id,
                $this->PrepareData->preparePatientMoreDescriptionVariable($request_patient_more_description, $request_typed_keyboard_savabegh, $request_common_hypersensitivity_2311) ,
                $request_post_patient_surgery_history ,
                $request_post_patient_disease_background ,
                $request_post_patient_medication_history ,
                $request_post_patient_allergies_history
                ) ;
    }

    public function storeNewEHRDoc($request_all , $decrypted_request_patient_id , $request_post_EHR_document_related_appointment_id , $request_post_EHR_document_related_clinic_doctor_name )
    {
        return $this->EHRRepository->storeNewEhrDoc(
            $this->PrepareData->prepareCommonDrugVariable($request_all),
            $this->PrepareData->prepareCommonDietVariable($request_all),
            $this->PrepareData->prepareCommonReturnDateVariable($request_all),
            $decrypted_request_patient_id,
            $this->PrepareData->prepareEHRDocumentRelatedAppointmentIdVariable($request_post_EHR_document_related_appointment_id),
            $this->PrepareData->prepareEHRDocumentRelatedClinicDoctorName($request_post_EHR_document_related_clinic_doctor_name)
        ) ;
    }

    public function storePatientPhotoFromEHRPage($request , $decrypted_request_patient_id)
    {
        return App()->call('App\Http\Controllers\PatientsPhotoController@preparationFileProcessAndUploadImage' , [ "request" => $request , "decrypted_request_patient_id" => $decrypted_request_patient_id ])  ;
    }

    public function resultOfShowNewSavedEHR($request_encrypted_ehr_id)
    {
        return $this->EHRRepository->showNewSavedEhr(encryptDecrypt('decrypt', $request_encrypted_ehr_id ) ) ;
    }
}