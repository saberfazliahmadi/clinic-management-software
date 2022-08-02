<?php
use App\Http\Controllers\FinancialTransactionController ;
$regex_rule_of_decrypted_id = config('global.regex_rule_of_decrypted_id') ;

// All Routes related to financial_transactions table
Route::get('show_financial_management_main_page' , [ FinancialTransactionController::class , 'show_financial_management_main_page' ] )->name('show_financial_management_main_page') ;
Route::get('show_submit_financial_transaction_form' , [ FinancialTransactionController::class , 'show_submit_financial_transaction_form' ] )->name('show_submit_financial_transaction_form') ;
Route::post('store_show_submit_financial_transaction_form' , [ FinancialTransactionController::class , 'store_show_submit_financial_transaction_form' ] )->name('store_show_submit_financial_transaction_form') ;
Route::get('show_financial_transaction_reporting_form' , [ FinancialTransactionController::class , 'show_financial_transaction_reporting_form' ] )->name('show_financial_transaction_reporting_form') ;
Route::get('run_financial_transaction_reporting_form' , [ FinancialTransactionController::class , 'run_financial_transaction_reporting_form' ] )->name('run_financial_transaction_reporting_form') ;
Route::get('delete_this_financial_transaction/{financial_transaction_id}' , [ FinancialTransactionController::class , 'destroy' ] )->name('delete_this_financial_transaction')->where(['financial_transaction_id' =>  ".$regex_rule_of_decrypted_id." ]);
