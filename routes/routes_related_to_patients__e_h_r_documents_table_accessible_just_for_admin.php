<?php
use AppEHR\Http\Controller\PatientsEHRDocumentController ;
$regex_rule_of_encrypted_id = config('global.regex_rule_of_encrypted_id') ;
$regex_rule_of_decrypted_id = config('global.regex_rule_of_decrypted_id') ;

// All Routes related to patients__e_h_r_documents table
Route::get('show_patients_ehr_document_page/{patient_id}/{related_appointment_id?}/{child_dr_related_name?}' , [ PatientsEHRDocumentController::class , 'show_patients_ehr_document_page' ] )->name('show_patients_ehr_document_page')->where([ 'patient_id' => ".$regex_rule_of_encrypted_id." , 'related_appointment_id' => ".$regex_rule_of_decrypted_id." , 'child_dr_related_name' => ".$regex_rule_of_encrypted_id." ]);
Route::post('store_patients_ehr_document_page/{patient_id}' , [ PatientsEHRDocumentController::class , 'store_patients_ehr_document_page' ] )->name('store_patients_ehr_document_page')->where(['patient_id' => ".$regex_rule_of_encrypted_id."])->middleware([ 'ValidatorStorepatients_EHR_documentRequest' , 'TransactionOnDatabaseToRollbackWhenExceptionsHappen'] ) ;
Route::get('show_new_saved_ehr/{EHR_document_id}/{patient_name}' , [ PatientsEHRDocumentController::class , 'show_new_saved_ehr' ] )->name('show_new_saved_ehr')->where(['EHR_document_id' => ".$regex_rule_of_encrypted_id."]) ;
