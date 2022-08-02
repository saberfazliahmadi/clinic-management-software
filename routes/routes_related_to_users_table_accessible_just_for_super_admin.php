<?php
use App\Http\Controllers\UserController ;
// All Routes related to users table which are accessible for super admin level
Route::get('show_management_users_of_software_form' , [ UserController::class , 'show_management_users_of_software_form' ] )->name('show_management_users_of_software_form') ;
Route::post('update_user_info_by_super_admin'       , [ UserController::class , 'update_show_main_settings_of_software_form' ] )->name('update_user_info_by_super_admin') ;