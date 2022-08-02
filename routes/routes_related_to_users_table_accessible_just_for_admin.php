<?php
use App\Http\Controllers\UserController ;
// All Routes related to users table which are accessible for admin_level
Route::get('show_main_settings_of_software_form'         , [ UserController::class , 'show_main_settings_of_software_form' ] )->name('show_main_settings_of_software_form') ;
Route::post('update_show_main_settings_of_software_form' , [ UserController::class , 'update_show_main_settings_of_software_form' ] )->name('update_show_main_settings_of_software_form') ;