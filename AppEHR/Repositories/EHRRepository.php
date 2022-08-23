<?php
namespace AppEHR\Repositories;

use App\Http\Controllers\PatientsPhotoController;
use App\Models\patients_general_info;
use App\Models\patients_photo;
use AppEHR\Interfaces\EHRRepositoryInterface;
use AppEHR\Models\patients_EHR_document;

class EHRRepository implements EHRRepositoryInterface
{
    public function fetch_info_of_this_patient_id($decrypted_request_patient_id)
    {
        return patients_general_info::fetch_info_of_this_patient_id( $decrypted_request_patient_id ) ;
    }

    public function result_of_patient_ehr_photo( $decrypted_request_patient_id )
    {
        return patients_photo::result_of_patient_ehr_photo( $decrypted_request_patient_id ) ;
    }

    public function result_of_patients_ehr_document( $decrypted_request_patient_id )
    {
        return patients_EHR_document::result_of_patients_ehr_document( $decrypted_request_patient_id ) ;
    }

    public function update_this_patient_general_info_from_ehr_page($decrypted_request_patient_id, $patient_more_description, $request_patient_surgery_history, $request_post_patient_disease_background , $request_patient_medication_history , $request_patient_allergies_history )
    {
        return patients_general_info::update_this_patient_general_info_from_ehr_page($decrypted_request_patient_id, $patient_more_description, $request_patient_surgery_history, $request_post_patient_disease_background , $request_patient_medication_history , $request_patient_allergies_history ) ;
    }

    public function store_new_ehr_doc($common_drug, $common_diet, $common_return_date, $decrypted_request_patient_id, $EHR_document_related_appointment_id_trick, $EHR_document_related_clinic_doctor_name_trick)
    {
        return patients_EHR_document::store_new_ehr_doc($common_drug, $common_diet, $common_return_date, $decrypted_request_patient_id, $EHR_document_related_appointment_id_trick, $EHR_document_related_clinic_doctor_name_trick) ;
    }

    public function preparation_file_process_and_upload_image($request,$request_keyboard_para_clinic_file_title ,$decrypted_request_patient_id)
    {
        return PatientsPhotoController::preparation_file_process_and_upload_image($request,$request_keyboard_para_clinic_file_title ,$decrypted_request_patient_id) ;
    }

    public function show_new_saved_ehr( $decrypt_request_EHR_document_id )
    {
        return patients_EHR_document::show_new_saved_ehr( $decrypt_request_EHR_document_id ) ;
    }
}