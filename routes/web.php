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
Auth::routes();

Route::get('/', function () {
    return view('auth.login');
});

// protected page accessible for user and admin
Route::group( [ 'middleware' => ['protected_page_accessible_for_user_and_admin'] ] , function()
{
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    // All Routes related to patients_general_infos table.
    Route::put('update_this_patient/{update_this_patient_id}' , 'PatientsGeneralInfoController@update' )->name('update_this_patient') ;
    Route::get('edit_patient_form/{edit_this_patient_id}' ,'PatientsGeneralInfoController@edit' )->name('edit_patient_form') ;
    Route::get('submit_new_patient_form','PatientsGeneralInfoController@create')->name('submit_new_patient_form') ;
    Route::put('store_new_patient_form','PatientsGeneralInfoController@store')->name('store_new_patient_form');
    Route::get('show_patient_search_from','PatientsGeneralInfoController@show_patient_search_from' )->name('show_patient_search_from') ;
    Route::post('run_patient_search_form' , 'PatientsGeneralInfoController@run_patient_search_form')->name('run_patient_search_form') ;

    // All Routes related to patients_appointments table
    Route::get('show_patient_time_appointment_table/{choose_time_for_this_date}/{choose_time_for_this_patient_id}' , 'PatientsAppointmentController@show_patient_time_appointment_table' )->name('show_patient_time_appointment_table');
    Route::put('store_patient_time_appointment_table' , 'PatientsAppointmentController@store_patient_time_appointment_table')->name('store_patient_time_appointment_table') ;
    Route::get('show_form_of_appointments_on_specific_date' , 'PatientsAppointmentController@show_form_of_appointments_on_specific_date')->name('show_form_of_appointments_on_specific_date') ;
    Route::post('run_show_form_of_appointments_on_specific_date' ,'PatientsAppointmentController@show' )->name('run_show_form_of_appointments_on_specific_date') ;
    Route::get('run_show_form_of_appointments_on_specific_date_by_get_method/{show_all_appointments_this_date}' ,'PatientsAppointmentController@show' )->name('run_show_form_of_appointments_on_specific_date_by_get_method') ;
    Route::get('delete_this_appointment_by_this_id/{appointment_id}/{show_all_appointments_this_date}' , 'PatientsAppointmentController@destroy')->name('delete_this_appointment_by_this_id') ;

    // All Routes related to financial_transactions table
    Route::get('show_financial_management_main_page' , 'FinancialTransactionController@show_financial_management_main_page')->name('show_financial_management_main_page') ;
    Route::get('show_submit_financial_transaction_form' , 'FinancialTransactionController@show_submit_financial_transaction_form')->name('show_submit_financial_transaction_form') ;
    Route::post('store_show_submit_financial_transaction_form' , 'FinancialTransactionController@store_show_submit_financial_transaction_form')->name('store_show_submit_financial_transaction_form') ;
    Route::get('show_financial_transaction_reporting_form' , 'FinancialTransactionController@show_financial_transaction_reporting_form')->name('show_financial_transaction_reporting_form') ;
    Route::get('run_financial_transaction_reporting_form' , 'FinancialTransactionController@run_financial_transaction_reporting_form')->name('run_financial_transaction_reporting_form') ;
    Route::get('delete_this_financial_transaction/{financial_transaction_id}' , 'FinancialTransactionController@destroy')->name('delete_this_financial_transaction');

    Route::get('show_change_password_form' , 'UserController@show_change_password_form')->name('show_change_password_form');
    Route::post('run_change_password_form' , 'UserController@run_change_password_form')->name('run_change_password_form');

}) ;

// protected page accessible for admin
Route::group( [ 'middleware' => ['protected_page_accessible_for_admin'] ] , function()
{
    // All Routes related to financial_transactions table
    Route::get('show_financial_settings_receiving_money_form','FinancialTransactionController@show_financial_settings_receiving_money_form')->name('show_financial_settings_receiving_money_form') ;
    Route::post('store_financial_settings_receiving_money_form' , 'FinancialTransactionController@store_financial_settings_receiving_money_form')->name('store_financial_settings_receiving_money_form') ;

    // All Routes related to users table
    Route::get('show_main_settings_of_software_form' , 'UserController@show_main_settings_of_software_form')->name('show_main_settings_of_software_form') ;
    Route::post('update_show_main_settings_of_software_form' , 'UserController@update_show_main_settings_of_software_form')->name('update_show_main_settings_of_software_form') ;
}) ;