<?php
use App\Http\Controllers\PatientsGeneralInfoController;
$regex_rule_of_encrypted_id = config('global.regex_rule_of_encrypted_id') ;

// All Routes related to patients_general_infos table
Route::put('update_this_patient/{update_this_patient_id}' , [ PatientsGeneralInfoController::class , 'update' ] )->name('update_this_patient')->where(['update_this_patient_id' => ".$regex_rule_of_encrypted_id." ])->middleware('ValidatorUpdatepatients_general_infoRequest');
Route::get('edit_patient_form/{edit_this_patient_id}'     , [ PatientsGeneralInfoController::class , 'edit' ] )->name('edit_patient_form')->where(['edit_this_patient_id' => ".$regex_rule_of_encrypted_id." ]);
Route::get('submit_new_patient_form'                      , [ PatientsGeneralInfoController::class , 'create' ] )->name('submit_new_patient_form') ;
Route::put('store_new_patient_form'                       , [ PatientsGeneralInfoController::class , 'store' ] )->name('store_new_patient_form')->middleware('ValidatorStorepatients_general_infoRequest');
Route::get('show_patient_search_from'                     , [ PatientsGeneralInfoController::class , 'show_patient_search_from' ] )->name('show_patient_search_from') ;
Route::match(array('GET' , 'POST') , 'run_patient_search_form' , [ PatientsGeneralInfoController::class , 'run_patient_search_form' ] )->name('run_patient_search_form') ;
Route::get('delete_this_patient_id/{delete_this_patient_id}', [ PatientsGeneralInfoController::class , 'destroy' ] )->name('delete_this_patient_id')->where(['delete_this_patient_id' => ".$regex_rule_of_encrypted_id." ]);