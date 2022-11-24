<?php
use AppEHR\Http\Controller\PatientsEHRDocumentController;
use Illuminate\Support\Facades\Route;

// Protected routes which are accessible for Authenticated Admin/SuperAdmin
// All Routes related to patients_e_h_r_documents model
Route::middleware([ 'web' , 'auth' , 'PreventBannedUsers' , 'CheckPageAccessibilityBasedOnLevelOfUser:Admin' , 'throttle:100,1' , 'ProvideHeaderData' ])->prefix('/ehr')->group(function()
{
    //Route::get(''                                                                           , [ PatientsEHRDocumentController::class , 'index'  ] )->name('ehr.index'       ) ;
    Route::get('/create/{encrypted_patient_id}/{appointment_id?}/{child_dr_related_name?}' , [ PatientsEHRDocumentController::class , 'create' ] )->name('ehr.create')->whereAlphaNumeric('encrypted_patient_id')->whereNumber('appointment_id')->where(['child_dr_related_name' => config('global.regex_rule_of_encrypted_id') ])->middleware([ 'CheckValidityOfPatientID' , 'CheckValidityOfAppointmentID' ]);
    Route::post('/{encrypted_patient_id}/store'                                            , [ PatientsEHRDocumentController::class , 'store'  ] )->name('ehr.store' )->whereAlphaNumeric('encrypted_patient_id')->middleware([ 'CheckValidityOfPatientID' , 'TransactionOnDatabaseToRollbackWhenExceptionsHappen'] ) ;
    Route::get('/{encrypted_ehr_id}/{encrypted_patient_name}/{is_photo_uploaded?}'         , [ PatientsEHRDocumentController::class , 'show'   ] )->name( 'ehr.show' )->whereAlphaNumeric(['encrypted_ehr_id' , 'is_photo_uploaded'])->where( [ 'encrypted_patient_name' => config('global.regex_rule_of_encrypted_id') ] )->middleware('CheckValidityOfEHRID') ;
    //Route::get('/{encrypted_ehr_id}/edit'                                                    , [ PatientsEHRDocumentController::class , 'edit'   ] )->name('ehr.edit'       )->whereAlphaNumeric('encrypted_ehr_id')->middleware('CheckValidityOfEHRID');
    //Route::put('/{encrypted_ehr_id}'                                                         , [ PatientsEHRDocumentController::class , 'update' ] )->name('ehr.update'     )->whereAlphaNumeric('encrypted_ehr_id')->middleware('CheckValidityOfEHRID');
    //Route::get('/{encrypted_ehr_id}/destroy'                                                 , [ PatientsEHRDocumentController::class , 'destroy'] )->name('ehr.destroy'    )->whereAlphaNumeric('encrypted_ehr_id')->middleware('CheckValidityOfEHRID');
});