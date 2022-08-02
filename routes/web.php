<?php

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

Route::get('/test' , static function ()
{
    return view('back.test') ;
})->name('test') ;
Route::put('store_new_patient_form_test','PatientsGeneralInfoController@store')->name('store_new_patient_form_test')->middleware('ValidatorStorepatients_general_infoRequest');



Auth::routes();
Route::match(array('POST','GET'),'/', static function () {
    return view('auth.login');
});

// Protected routes which are accessible just for Authenticated User and Admin
Route::group( [ 'middleware' => ['protected_page_accessible_for_user_and_admin_and_super_admin' , 'throttle:100,1' ] ] , function()
{
    Route::get('/home', 'HomeController@index')->name('home');
    //// All Routes related to patients_general_infos table
    require_once __DIR__.'/routes_related_to_patients_general_infos_table_accessible_for_admin_user.php' ;
    // All Routes related to patients_appointments table
    require_once __DIR__.'/routes_related_to_patients_appointments_table_accessible_for_admin_user.php' ;
    // All Routes related to financial_transactions table
    require_once __DIR__.'/routes_related_to_financial_transactions_table_accessible_for_admin_user.php' ;
    // All Routes related to change password on users table
    require_once __DIR__.'/routes_related_to_change_password_on_users_table_accessible_for_admin_user.php' ;
}) ;

// Protected routes which are accessible just for Authenticated Admin
Route::group( [ 'middleware' => ['protected_page_accessible_for_admin_and_super_admin' , 'throttle:100,1' ] ] , function()
{
    // All Routes related to users table
    require_once __DIR__.'/routes_related_to_users_table_accessible_just_for_admin.php' ;
    // All Routes related to patients__e_h_r_documents table
    require_once __DIR__.'/routes_related_to_patients__e_h_r_documents_table_accessible_just_for_admin.php' ;
}) ;

// Protected routes which are accessible just for Authenticated Super Admin
Route::group( [ 'middleware' => ['protected_page_accessible_for_super_admin' , 'throttle:100,1' ] ] , function()
{
    // All Routes related to users table
    require_once __DIR__.'/routes_related_to_users_table_accessible_just_for_super_admin.php' ;
}) ;