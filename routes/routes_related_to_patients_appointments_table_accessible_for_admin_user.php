<?php
use App\Http\Controllers\PatientsAppointmentController ;
$regex_rule_of_encrypted_id = config('global.regex_rule_of_encrypted_id') ;
$regex_rule_of_show_date    = config('global.regex_rule_of_show_date') ;

// All Routes related to patients_appointments table
Route::get('show_patient_time_appointment_table/{choose_time_for_this_date}/{choose_time_for_this_patient_id}' , [ PatientsAppointmentController::class , 'show_patient_time_appointment_table' ] )->name('show_patient_time_appointment_table')->where(['choose_time_for_this_date' => ".$regex_rule_of_show_date." , 'choose_time_for_this_patient_id' => ".$regex_rule_of_encrypted_id." ]);
Route::put('store_patient_time_appointment_table' , [ PatientsAppointmentController::class , 'store_patient_time_appointment_table' ] )->name('store_patient_time_appointment_table')->middleware('TransactionOnDatabaseToRollbackWhenExceptionsHappen') ;
Route::get('show_form_of_appointments_on_specific_date' , [ PatientsAppointmentController::class , 'show_form_of_appointments_on_specific_date' ] )->name('show_form_of_appointments_on_specific_date') ;
Route::get('run_show_form_of_appointments_on_specific_date' , [ PatientsAppointmentController::class , 'show' ] )->name('run_show_form_of_appointments_on_specific_date') ;
Route::get('run_show_form_of_appointments_on_specific_date_by_get_method/{show_all_appointments_this_date}' , [ PatientsAppointmentController::class , 'show' ] )->name('run_show_form_of_appointments_on_specific_date_by_get_method')->where(['show_all_appointments_this_date' => ".$regex_rule_of_show_date." ]);
Route::get('delete_this_appointment_by_this_id/{appointment_id}/{show_all_appointments_this_date}' , [ PatientsAppointmentController::class , 'destroy' ] )->name('delete_this_appointment_by_this_id')->where(['appointment_id' => '[0-9]+' , 'show_all_appointments_this_date' => ".$regex_rule_of_show_date." ]);
