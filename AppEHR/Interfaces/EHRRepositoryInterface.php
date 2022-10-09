<?php
namespace AppEHR\Interfaces;
interface EHRRepositoryInterface
{
    public function fetchInfoOfThisPatientId($decrypted_request_patient_id) ;
    public function resultOfPatientEhrPhoto($decrypted_request_patient_id) ;
    public function resultOfPatientsEhrDocument($decrypted_request_patient_id) ;
    public function updateThisPatientGeneralInfoFromEhrPage($decrypted_request_patient_id, $patient_more_description, $request_validated) ;
    public function storeNewEhrDoc($common_drug, $common_diet, $common_return_date, $decrypted_request_patient_id, $EHR_document_related_appointment_id_trick, $EHR_document_related_clinic_doctor_name_trick) ;
    public function showNewSavedEhr($decrypt_request_EHR_document_id ) ;
}