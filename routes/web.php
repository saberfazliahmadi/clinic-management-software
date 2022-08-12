<?php
use App\Http\Controllers\FinancialTransactionController;
use App\Http\Controllers\PatientsAppointmentController;
use App\Http\Controllers\PatientsGeneralInfoController;
use App\Http\Controllers\UserController;
use AppEHR\Http\Controller\PatientsEHRDocumentController;
use Illuminate\Support\Facades\Route;
use Monolog\Handler\RotatingFileHandler;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/test' , static function () {  return view('back.test') ;})->name('test') ;

Auth::routes();
Route::match(array('POST','GET'),'/', static function () {
    return view('auth.login');
});

// Protected routes which are accessible just for Authenticated User and Admin
Route::group( [ 'middleware' => ['protected_page_accessible_for_user_and_admin_and_super_admin' , 'throttle:100,1' ] ] , function()
{
    Route::get('/home', 'HomeController@index')->name('home');

    // All Routes related to patients_general_infos table
    Route::put('update_this_patient/{update_this_patient_id}' , [ PatientsGeneralInfoController::class , 'update' ] )->name('update_this_patient')->where(['update_this_patient_id' => config('global.regex_rule_of_encrypted_id') ])->middleware('ValidatorUpdatepatients_general_infoRequest');
    Route::get('edit_patient_form/{edit_this_patient_id}'     , [ PatientsGeneralInfoController::class , 'edit' ] )->name('edit_patient_form')->where(['edit_this_patient_id' => config('global.regex_rule_of_encrypted_id') ]);
    Route::get('submit_new_patient_form'                      , [ PatientsGeneralInfoController::class , 'create' ] )->name('submit_new_patient_form') ;
    Route::put('store_new_patient_form'                       , [ PatientsGeneralInfoController::class , 'store' ] )->name('store_new_patient_form')->middleware('ValidatorStorepatients_general_infoRequest');
    Route::get('show_patient_search_from'                     , [ PatientsGeneralInfoController::class , 'show_patient_search_from' ] )->name('show_patient_search_from') ;
    Route::match(array('GET' , 'POST') , 'run_patient_search_form' , [ PatientsGeneralInfoController::class , 'run_patient_search_form' ] )->name('run_patient_search_form') ;
    Route::get('delete_this_patient_id/{delete_this_patient_id}', [ PatientsGeneralInfoController::class , 'destroy' ] )->name('delete_this_patient_id')->where(['delete_this_patient_id' => config('global.regex_rule_of_encrypted_id') ]);

    // All Routes related to patients_appointments table
    Route::get('show_patient_time_appointment_table/{choose_time_for_this_date}/{choose_time_for_this_patient_id}' , [ PatientsAppointmentController::class , 'show_patient_time_appointment_table' ] )->name('show_patient_time_appointment_table')->where(['choose_time_for_this_date' => config('global.regex_rule_of_show_date') , 'choose_time_for_this_patient_id' => config('global.regex_rule_of_encrypted_id') ]);
    Route::put('store_patient_time_appointment_table' , [ PatientsAppointmentController::class , 'store_patient_time_appointment_table' ] )->name('store_patient_time_appointment_table')->middleware('TransactionOnDatabaseToRollbackWhenExceptionsHappen') ;
    Route::get('show_form_of_appointments_on_specific_date' , [ PatientsAppointmentController::class , 'show_form_of_appointments_on_specific_date' ] )->name('show_form_of_appointments_on_specific_date') ;
    Route::get('run_show_form_of_appointments_on_specific_date' , [ PatientsAppointmentController::class , 'show' ] )->name('run_show_form_of_appointments_on_specific_date') ;
    Route::get('run_show_form_of_appointments_on_specific_date_by_get_method/{show_all_appointments_this_date}' , [ PatientsAppointmentController::class , 'show' ] )->name('run_show_form_of_appointments_on_specific_date_by_get_method')->where(['show_all_appointments_this_date' => config('global.regex_rule_of_show_date') ]);
    Route::get('delete_this_appointment_by_this_id/{appointment_id}/{show_all_appointments_this_date}' , [ PatientsAppointmentController::class , 'destroy' ] )->name('delete_this_appointment_by_this_id')->where(['appointment_id' => '[0-9]+' , 'show_all_appointments_this_date' => config('global.regex_rule_of_show_date') ]);

    // All Routes related to financial_transactions table
    Route::get('show_financial_management_main_page' , [ FinancialTransactionController::class , 'show_financial_management_main_page' ] )->name('show_financial_management_main_page') ;
    Route::get('show_submit_financial_transaction_form' , [ FinancialTransactionController::class , 'show_submit_financial_transaction_form' ] )->name('show_submit_financial_transaction_form') ;
    Route::post('store_show_submit_financial_transaction_form' , [ FinancialTransactionController::class , 'store_show_submit_financial_transaction_form' ] )->name('store_show_submit_financial_transaction_form') ;
    Route::get('show_financial_transaction_reporting_form' , [ FinancialTransactionController::class , 'show_financial_transaction_reporting_form' ] )->name('show_financial_transaction_reporting_form') ;
    Route::get('run_financial_transaction_reporting_form' , [ FinancialTransactionController::class , 'run_financial_transaction_reporting_form' ] )->name('run_financial_transaction_reporting_form') ;
    Route::get('delete_this_financial_transaction/{financial_transaction_id}' , [ FinancialTransactionController::class , 'destroy' ] )->name('delete_this_financial_transaction')->where(['financial_transaction_id' => config('global.regex_rule_of_decrypted_id') ]);

    // All Routes related to change password on users table
    Route::get('show_change_password_form' , [ UserController::class , 'show_change_password_form' ] )->name('show_change_password_form');
    Route::post('run_change_password_form' , [ UserController::class , 'run_change_password_form' ] )->name('run_change_password_form');
}) ;

// Protected routes which are accessible just for Authenticated Admin
Route::group( [ 'middleware' => ['protected_page_accessible_for_admin_and_super_admin' , 'throttle:100,1' ] ] , function()
{
    // All Routes related to users table
    Route::get('show_main_settings_of_software_form'         , [ UserController::class , 'show_main_settings_of_software_form' ] )->name('show_main_settings_of_software_form') ;
    Route::post('update_show_main_settings_of_software_form' , [ UserController::class , 'update_show_main_settings_of_software_form' ] )->name('update_show_main_settings_of_software_form') ;

    // All Routes related to patients__e_h_r_documents table
    Route::get('show_patients_ehr_document_page/{patient_id}/{related_appointment_id?}/{child_dr_related_name?}' , [ PatientsEHRDocumentController::class , 'show_patients_ehr_document_page' ] )->name('show_patients_ehr_document_page')->where([ 'patient_id' => config('global.regex_rule_of_encrypted_id') , 'related_appointment_id' => config('global.regex_rule_of_decrypted_id') , 'child_dr_related_name' => config('global.regex_rule_of_encrypted_id') ])->middleware('CheckValidityOfPatientID');
    Route::post('store_patients_ehr_document_page/{patient_id}' , [ PatientsEHRDocumentController::class , 'store_patients_ehr_document_page' ] )->name('store_patients_ehr_document_page')->where(['patient_id' => config('global.regex_rule_of_encrypted_id') ])->middleware([ 'CheckValidityOfPatientID' , 'ValidatorStorepatients_EHR_documentRequest' , 'TransactionOnDatabaseToRollbackWhenExceptionsHappen'] ) ;
    Route::get('show_new_saved_ehr/{EHR_document_id}/{patient_name}' , [ PatientsEHRDocumentController::class , 'show_new_saved_ehr' ] )->name('show_new_saved_ehr')->where(['EHR_document_id' => config('global.regex_rule_of_encrypted_id') ])->middleware('CheckValidityOfEHRID') ;
}) ;

// Protected routes which are accessible just for Authenticated Super Admin
Route::group( [ 'middleware' => ['protected_page_accessible_for_super_admin' , 'throttle:100,1' ] ] , function()
{
    // All Routes related to users table
    Route::get('show_management_users_of_software_form' , [ UserController::class , 'show_management_users_of_software_form' ] )->name('show_management_users_of_software_form') ;
    Route::post('update_user_info_by_super_admin'       , [ UserController::class , 'update_show_main_settings_of_software_form' ] )->name('update_user_info_by_super_admin') ;
    Route::get('show_users_activities_logs'             , [ UserController::class , 'show_users_activities_logs'] )->name('show_users_activities_logs') ;
}) ;