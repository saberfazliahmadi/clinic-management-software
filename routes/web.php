<?php
use App\Http\Controllers\HomeController ;
use App\Http\Controllers\HeaderController ;
use App\Http\Controllers\FinancialTransactionController;
use App\Http\Controllers\PatientsAppointmentController;
use App\Http\Controllers\PatientsGeneralInfoController;
use App\Http\Controllers\UserController;
use AppEHR\Http\Controller\PatientsEHRDocumentController;
use Illuminate\Support\Facades\Route;
/* These routes are loaded by the RouteServiceProvider within a group which contains the "web" middleware group. */
/* Remember, when define a new route you should follow this structure based on default laravel Doc to follow standards
Verb        URI	                    Action	 RouteName
GET	        /photos	                index	 photos.index
GET	        /photos/create	        create	 photos.create
POST        /photos	                store	 photos.store
GET	        /photos/{photo}         show	 photos.show
GET	        /photos/{photo}/edit	edit	 photos.edit
PUT/PATCH	/photos/{photo}	        update	 photos.update
DELETE	    /photos/{photo}	        destroy	 photos.destroy */

Auth::routes();
Route::view('/' , 'auth.login') ;

// Protected routes which are accessible for Authenticated User/Admin/SuperAdmin
Route::group( [ 'middleware' => [ 'auth' , 'protectedPageAccessibleForUserAndAdminAndSuperAdmin' , 'throttle:100,1' ] ] , function()
{
    // All routes related to header
    Route::get('send_patient_to_doctor_room'        , [ HeaderController::class , 'IfUserClickOnButtonSendPatientToDoctorRoom' ] )->name('send_patient_to_doctor_room')->middleware([ 'ValidatorIfUserClickOnButtonSendPatientToDoctorRoom' , 'CheckValidityOfAppointmentID' ]) ;

    Route::get('/home'                              , [ HomeController::class   , 'index' ] )->name('home');

    // All Routes related to patients_general_infos model
    Route::group( [ 'prefix' => '/patients' ] , function() {
        Route::get(''                               , [ PatientsGeneralInfoController::class, 'index'  ])->name('patients.index'  );
        Route::get('/create'                        , [ PatientsGeneralInfoController::class, 'create' ])->name('patients.create' );
        Route::post(''                              , [ PatientsGeneralInfoController::class, 'store'  ])->name('patients.store'  )->middleware('CheckMobileNumberDuplication');
        Route::get('/show'                          , [ PatientsGeneralInfoController::class, 'show'   ])->name('patients.show'   ) ;
        Route::get('/{encrypted_patient_id}/edit'   , [ PatientsGeneralInfoController::class, 'edit'   ])->name('patients.edit'   )->whereAlphaNumeric('encrypted_patient_id')->middleware('CheckValidityOfPatientID');
        Route::put('/{encrypted_patient_id}'        , [ PatientsGeneralInfoController::class, 'update' ])->name('patients.update' )->whereAlphaNumeric('encrypted_patient_id')->middleware(['CheckValidityOfPatientID' , 'CheckMobileNumberDuplication']);
        Route::get('/{encrypted_patient_id}/destroy', [ PatientsGeneralInfoController::class, 'destroy'])->name('patients.destroy')->whereAlphaNumeric('encrypted_patient_id')->middleware('CheckValidityOfPatientID');
    }) ;

    // All Routes related to patients_appointments model
    Route::group( [ 'prefix' => '/appointments' ] , function() {
        Route::get(''                                      , [ PatientsAppointmentController::class , 'index'  ])->name('appointments.index'   );
        Route::get('/create/{encrypted_patient_id}/{date}' , [ PatientsAppointmentController::class , 'create' ])->name('appointments.create'  )->whereAlphaNumeric('encrypted_patient_id' )->where(['date' => config('global.regex_rule_of_show_date') ])->middleware('CheckValidityOfPatientID');
        Route::post(''                                     , [ PatientsAppointmentController::class , 'store'  ])->name('appointments.store'   )->middleware('TransactionOnDatabaseToRollbackWhenExceptionsHappen') ;
        Route::get('/show'                                 , [ PatientsAppointmentController::class , 'show'   ])->name('appointments.show'    );
        //Route::get('/{appointment_id}/edit'                 , [ PatientsAppointmentController::class  , 'edit'   ])->name('appointments.edit'         )->whereNumber('appointment_id')->middleware('CheckValidityOfAppointmentID');
        //Route::put('/{appointment_id}'                      , [ PatientsAppointmentController::class  , 'update' ])->name('appointments.update'       )->whereNumber('appointment_id')->middleware('CheckValidityOfAppointmentID');
        Route::get('/{appointment_id}/destroy'             , [ PatientsAppointmentController::class , 'destroy'])->name('appointments.destroy' )->whereNumber('appointment_id')->middleware('CheckValidityOfAppointmentID');
    }) ;

    // All Routes related to financial_transactions model
    Route::group( [ 'prefix' => '/financial' ] , function() {
        Route::get(''                                    , [ FinancialTransactionController::class , 'index' ] )->name('financial.index') ;
        Route::get('/create'                             , [ FinancialTransactionController::class , 'create'] )->name('financial.create') ;
        Route::post(''                                   , [ FinancialTransactionController::class , 'store' ] )->name('financial.store') ;
        Route::get('/show'                               , [ FinancialTransactionController::class , 'show'  ] )->name('financial.show') ;
        //Route::get('/{financial_id}/edit'                 , [ FinancialTransactionController::class  , 'edit'  ])->name('financial.edit'   )->whereNumber('financial_id')->middleware('CheckValidityOfFinancialID');
        //Route::put('/{financial_id}'                      , [ FinancialTransactionController::class  , 'update'])->name('financial.update' )->whereNumber('financial_id')->middleware('CheckValidityOfFinancialID');
        Route::get('/{financial_transaction_id}/destroy' , [ FinancialTransactionController::class , 'destroy' ] )->name('financial.destroy')->whereNumber('financial_transaction_id');
        Route::get('/main_page'                          , [ FinancialTransactionController::class , 'showMainFinancialPage' ] )->name('financial.main.page') ;
    }) ;

}) ;

// Protected routes which are accessible for Authenticated Admin/SuperAdmin
// All Routes related to patients__e_h_r_documents model
Route::group( [ 'prefix' => '/ehr' , 'middleware' => [ 'auth' , 'protectedPageAccessibleForAdminAndSuperAdmin' , 'throttle:100,1' ] ] , function()
{
    //Route::get(''                                                , [ PatientsEHRDocumentController::class  , 'index' ] )->name('ehr.index') ;
    Route::get('/create/{encrypted_patient_id}/{appointment_id?}/{child_dr_related_name?}' , [ PatientsEHRDocumentController::class , 'create' ] )->name('ehr.create')->whereAlphaNumeric('encrypted_patient_id')->whereNumber('appointment_id')->where(['child_dr_related_name' => config('global.regex_rule_of_encrypted_id') ])->middleware([ 'CheckValidityOfPatientID' , 'CheckValidityOfAppointmentID' ]);
    Route::post('/{encrypted_patient_id}/store'                                            , [ PatientsEHRDocumentController::class , 'store'  ] )->name('ehr.store' )->whereAlphaNumeric('encrypted_patient_id')->middleware([ 'CheckValidityOfPatientID' , 'ValidatorStorepatients_EHR_documentRequest' , 'TransactionOnDatabaseToRollbackWhenExceptionsHappen'] ) ;
    Route::get('/{encrypted_ehr_id}/{encrypted_patient_name}'                              , [ PatientsEHRDocumentController::class , 'show'   ] )->name( 'ehr.show' )->whereAlphaNumeric('encrypted_ehr_id')->where(['encrypted_patient_name' => config('global.regex_rule_of_encrypted_id') ] )->middleware('CheckValidityOfEHRID') ;
    //Route::get('/{encrypted_ehr_id}/edit'                                                    , [ PatientsEHRDocumentController::class , 'edit'   ] )->name('ehr.edit'       )->whereAlphaNumeric('encrypted_ehr_id')->middleware('CheckValidityOfEHRID');
    //Route::put('/{encrypted_ehr_id}'                                                         , [ PatientsEHRDocumentController::class , 'update' ] )->name('ehr.update'     )->whereAlphaNumeric('encrypted_ehr_id')->middleware('CheckValidityOfEHRID');
    //Route::get('/{encrypted_ehr_id}/destroy'                                                 , [ PatientsEHRDocumentController::class , 'destroy'] )->name('ehr.destroy'    )->whereAlphaNumeric('encrypted_ehr_id')->middleware('CheckValidityOfEHRID');
}) ;

// These routes have different types of accessibility based on user's level field (User, Admin, SuperAdmin),
// Which will be checked on middleware for each route specifically below
// All Routes related to users model
Route::group( [ 'prefix' => '/user' , 'middleware' => [ 'auth' , 'throttle:100,1' ] ] , function()
{
    //Route::get(''                                 , [ UserController::class , 'index' ] )->name('user.index') ;
    Route::get('/edit_group_of_users'           , [ UserController::class , 'showManagementUsersOfSoftwareForm']    )->name('show_management_users_of_software_form'      )->middleware( 'protectedPageAccessibleForSuperAdmin' ) ;
    Route::put('/update_group_of_users'         , [ UserController::class , 'updateShowMainSettingsOfSoftwareForm'] )->name('update_user_info_by_super_admin'             )->middleware( [ 'protectedPageAccessibleForSuperAdmin' , 'ValidatorMainSettingsSoftwareFormRequest'] ) ;
    Route::get('/edit'                          , [ UserController::class , 'showMainSettingsOfSoftwareForm']       )->name('show_main_settings_of_software_form'         )->middleware( 'protectedPageAccessibleForAdminAndSuperAdmin') ;
    Route::put('/update'                        , [ UserController::class , 'updateShowMainSettingsOfSoftwareForm'] )->name('update_show_main_settings_of_software_form'  )->middleware( [ 'protectedPageAccessibleForAdminAndSuperAdmin' , 'ValidatorMainSettingsSoftwareFormRequest' ]) ;
    Route::get('/edit_password'                 , [ UserController::class , 'showChangePasswordForm']               )->name('show_change_password_form'                   )->middleware( 'protectedPageAccessibleForUserAndAdminAndSuperAdmin' );
    Route::post('/update_password'              , [ UserController::class , 'runChangePasswordForm']                )->name('run_change_password_form'                    )->middleware( [ 'protectedPageAccessibleForUserAndAdminAndSuperAdmin' , 'ValidatorChangePasswordFromRequest' ] ) ;
    Route::get('/users_activities_logs'         , [ UserController::class , 'showUsersActivitiesLogs']              )->name('show_users_activities_logs'                  )->middleware( 'protectedPageAccessibleForSuperAdmin' ) ;
    //Route::get('/{use_id}/destroy'               , [ UserController::class , 'destroy']                              )->name('user.destroy'    )->whereAlphaNumeric('use_id')->middleware('CheckValidityOfUserID');
}) ;