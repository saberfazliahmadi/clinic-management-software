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
Route::view('/' , 'auth.login');

Route::group( [ 'middleware' => [ 'auth' , 'PreventBannedUsers' , 'throttle:100,1' ] ],function()
{
    // Protected routes which are accessible for Authenticated User/Admin/SuperAdmin
    Route::group( [ 'middleware' => [ 'CheckPageAccessibilityBasedOnLevelOfUser:User' , 'ProvideHeaderData' ] ],function()
    {
        // All routes related to header
        Route::get('send_patient_to_doctor_room'        , [ HeaderController::class , 'ifUserClickOnButtonSendPatientToDoctorRoom' ] )->name('send_patient_to_doctor_room') ;

        Route::get('/home'                              , [ HomeController::class   , 'index' ] )->name('home');

        // All Routes related to patients_general_infos model
        Route::group( [ 'prefix' => '/patients' ],function()
        {
            Route::get(''                               , [ PatientsGeneralInfoController::class, 'index'  ])->name('patients.index'  );
            Route::get('/create'                        , [ PatientsGeneralInfoController::class, 'create' ])->name('patients.create' );
            Route::post(''                              , [ PatientsGeneralInfoController::class, 'store'  ])->name('patients.store'  );
            Route::get('/show'                          , [ PatientsGeneralInfoController::class, 'show'   ])->name('patients.show'   );
            Route::get('/{encrypted_patient_id}/edit'   , [ PatientsGeneralInfoController::class, 'edit'   ])->name('patients.edit'   )->whereAlphaNumeric('encrypted_patient_id')->middleware('CheckValidityOfPatientID');
            Route::put('/{encrypted_patient_id}'        , [ PatientsGeneralInfoController::class, 'update' ])->name('patients.update' )->whereAlphaNumeric('encrypted_patient_id')->middleware('CheckValidityOfPatientID');
            Route::get('/{encrypted_patient_id}/destroy', [ PatientsGeneralInfoController::class, 'destroy'])->name('patients.destroy')->whereAlphaNumeric('encrypted_patient_id')->middleware('CheckValidityOfPatientID');
        });

        // All Routes related to patients_appointments model
        Route::group([ 'prefix' => '/appointments' ],function()
        {
            Route::get(''                                      , [ PatientsAppointmentController::class , 'index'  ])->name('appointments.index'   );
            Route::get('/create/{encrypted_patient_id}/{date}' , [ PatientsAppointmentController::class , 'create' ])->name('appointments.create'  )->whereAlphaNumeric('encrypted_patient_id' )->where(['date' => config('global.regex_rule_of_show_date') ])->middleware('CheckValidityOfPatientID');
            Route::post(''                                     , [ PatientsAppointmentController::class , 'store'  ])->name('appointments.store'   )->middleware('TransactionOnDatabaseToRollbackWhenExceptionsHappen') ;
            Route::get('/show'                                 , [ PatientsAppointmentController::class , 'show'   ])->name('appointments.show'    );
            //Route::get('/{appointment_id}/edit'                 , [ PatientsAppointmentController::class  , 'edit'   ])->name('appointments.edit'         )->whereNumber('appointment_id');
            //Route::put('/{appointment_id}'                      , [ PatientsAppointmentController::class  , 'update' ])->name('appointments.update'       )->whereNumber('appointment_id');
            Route::get('/{appointment_id}/destroy'             , [ PatientsAppointmentController::class , 'destroy'])->name('appointments.destroy' )->whereNumber('appointment_id')->middleware('CheckValidityOfAppointmentID');
        });

        // All Routes related to financial_transactions model
        Route::group( [ 'prefix' => '/financial' ],function()
        {
            Route::get(''                                     , [ FinancialTransactionController::class , 'index' ] )->name('financial.index') ;
            Route::get('/create'                              , [ FinancialTransactionController::class , 'create'] )->name('financial.create') ;
            Route::post(''                                    , [ FinancialTransactionController::class , 'store' ] )->name('financial.store') ;
            Route::get('/show'                                , [ FinancialTransactionController::class , 'show'  ] )->name('financial.show') ;
            //Route::get('/{financial_id}/edit'                  , [ FinancialTransactionController::class  , 'edit'  ])->name('financial.edit'   )->whereNumber('financial_id')->middleware('CheckValidityOfFinancialID');
            //Route::put('/{financial_id}'                       , [ FinancialTransactionController::class  , 'update'])->name('financial.update' )->whereNumber('financial_id')->middleware('CheckValidityOfFinancialID');
            Route::get('/{financial_id}/destroy'              , [ FinancialTransactionController::class , 'destroy'])->name('financial.destroy')->whereNumber('financial_id');
            Route::get('/main_page'                           , [ FinancialTransactionController::class , 'showMainFinancialPage' ] )->name('financial.main.page') ;
        });
    });

    // Protected routes which are accessible for Authenticated Admin/SuperAdmin
    // All Routes related to patients__e_h_r_documents model
    Route::group( [ 'prefix' => '/ehr' , 'middleware' => [ 'CheckPageAccessibilityBasedOnLevelOfUser:Admin' , 'ProvideHeaderData' ] ] , function()
    {
        //Route::get(''                                                                           , [ PatientsEHRDocumentController::class , 'index'  ] )->name('ehr.index'       ) ;
        Route::get('/create/{encrypted_patient_id}/{appointment_id?}/{child_dr_related_name?}' , [ PatientsEHRDocumentController::class , 'create' ] )->name('ehr.create')->whereAlphaNumeric('encrypted_patient_id')->whereNumber('appointment_id')->where(['child_dr_related_name' => config('global.regex_rule_of_encrypted_id') ])->middleware([ 'CheckValidityOfPatientID' , 'CheckValidityOfAppointmentID' ]);
        Route::post('/{encrypted_patient_id}/store'                                            , [ PatientsEHRDocumentController::class , 'store'  ] )->name('ehr.store' )->whereAlphaNumeric('encrypted_patient_id')->middleware([ 'CheckValidityOfPatientID' , 'TransactionOnDatabaseToRollbackWhenExceptionsHappen'] ) ;
        Route::get('/{encrypted_ehr_id}/{encrypted_patient_name}/{is_photo_uploaded?}'         , [ PatientsEHRDocumentController::class , 'show'   ] )->name( 'ehr.show' )->whereAlphaNumeric(['encrypted_ehr_id' , 'is_photo_uploaded'])->where( [ 'encrypted_patient_name' => config('global.regex_rule_of_encrypted_id') ] )->middleware('CheckValidityOfEHRID') ;
        //Route::get('/{encrypted_ehr_id}/edit'                                                    , [ PatientsEHRDocumentController::class , 'edit'   ] )->name('ehr.edit'       )->whereAlphaNumeric('encrypted_ehr_id')->middleware('CheckValidityOfEHRID');
        //Route::put('/{encrypted_ehr_id}'                                                         , [ PatientsEHRDocumentController::class , 'update' ] )->name('ehr.update'     )->whereAlphaNumeric('encrypted_ehr_id')->middleware('CheckValidityOfEHRID');
        //Route::get('/{encrypted_ehr_id}/destroy'                                                 , [ PatientsEHRDocumentController::class , 'destroy'] )->name('ehr.destroy'    )->whereAlphaNumeric('encrypted_ehr_id')->middleware('CheckValidityOfEHRID');
    }) ;

    // These routes have different types of accessibility based on user's level field (User, Admin, SuperAdmin),
    // Which will be checked on group middleware
    // All Routes related to users model
    Route::group([ 'prefix' => '/users' ],function()
    {
        Route::group(['middleware' => [ 'CheckPageAccessibilityBasedOnLevelOfUser:SuperAdmin' , 'ProvideHeaderData' ]],function()
        {
            //Route::get(''                   , [ UserController::class , 'index'         ] )->name('users.index'             ) ;
            Route::get('/edit_group'      , [ UserController::class , 'editGroup'      ] )->name('users.edit.group'  ) ;
            Route::put('/update_group'    , [ UserController::class , 'updateGroup'    ] )->name('users.update.group') ;
            //Route::get('/{user_id}/destroy' , [ UserController::class , 'destroy'       ] )->name('users.destroy'           )->whereAlphaNumeric('user_id')->middleware('CheckValidityOfUserID');
            Route::get('/activities_logs' , [ UserController::class , 'showLogs'       ] )->name('users.show.logs'   ) ;
        });

        Route::group(['middleware' => [ 'CheckPageAccessibilityBasedOnLevelOfUser:Admin' , 'ProvideHeaderData' ]],function()
        {
            Route::get('/edit'            , [ UserController::class , 'edit'           ] )->name('users.edit'        ) ;
            Route::put('/update'          , [ UserController::class , 'update'         ] )->name('users.update'      ) ;
        });

        Route::group(['middleware' => [ 'CheckPageAccessibilityBasedOnLevelOfUser:User' , 'ProvideHeaderData' ]],function()
        {
            Route::get('/edit_password'   , [ UserController::class , 'editPassword'   ] )->name('users.edit.password'  );
            Route::put('/update_password' , [ UserController::class , 'updatePassword' ] )->name('users.update.password');
        });
    });

});