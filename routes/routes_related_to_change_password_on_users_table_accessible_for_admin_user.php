<?php
// All Routes related to change password on users table
use App\Http\Controllers\UserController;

Route::get('show_change_password_form' , [ UserController::class , 'show_change_password_form' ] )->name('show_change_password_form');
Route::post('run_change_password_form' , [ UserController::class , 'run_change_password_form' ] )->name('run_change_password_form');
