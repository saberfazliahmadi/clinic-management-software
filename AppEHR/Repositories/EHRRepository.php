<?php
namespace AppEHR\Repositories;

use App\Models\patients_general_info;
use App\Models\patients_photo;
use AppEHR\Models\patients_EHR_document;
use AppEHR\Interfaces\EHRRepositoryInterface;

class EHRRepository implements EHRRepositoryInterface
{
    public function fetchInfoOfThisPatientId($decrypted_request_patient_id)
    {
        return patients_general_info::fetchInfoOfThisPatientId($decrypted_request_patient_id ) ;
    }

    public function resultOfPatientEhrPhoto($decrypted_request_patient_id )
    {
        return patients_photo::resultOfPatientEhrPhoto($decrypted_request_patient_id ) ;
    }

    public function resultOfPatientsEhrDocument($decrypted_request_patient_id )
    {
        return patients_EHR_document::resultOfPatientsEhrDocument($decrypted_request_patient_id ) ;
    }

    public function updateThisPatientGeneralInfoFromEhrPage($decrypted_request_patient_id, $patient_more_description, $request_patient_surgery_history, $request_post_patient_disease_background , $request_patient_medication_history , $request_patient_allergies_history )
    {
        return patients_general_info::updateThisPatientGeneralInfoFromEhrPage($decrypted_request_patient_id, $patient_more_description, $request_patient_surgery_history, $request_post_patient_disease_background , $request_patient_medication_history , $request_patient_allergies_history ) ;
    }

    public function storeNewEhrDoc($common_drug, $common_diet, $common_return_date, $decrypted_request_patient_id, $EHR_document_related_appointment_id_trick, $EHR_document_related_clinic_doctor_name_trick)
    {
        return patients_EHR_document::storeNewEhrDoc($common_drug, $common_diet, $common_return_date, $decrypted_request_patient_id, $EHR_document_related_appointment_id_trick, $EHR_document_related_clinic_doctor_name_trick) ;
    }

    public function showNewSavedEhr($decrypt_request_EHR_document_id )
    {
        return patients_EHR_document::showNewSavedEhr($decrypt_request_EHR_document_id ) ;
    }
}