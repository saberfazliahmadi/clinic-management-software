<?php
namespace App\Http\Controllers;

use App\Http\Requests\run_financial_transaction_reporting_formRequest;
use App\Models\financial_transaction;
use App\Http\Requests\Storefinancial_transactionRequest;
use App\Responses\Responses;
use Illuminate\Http\Request ;
use Illuminate\Database\QueryException;

/** In this controller according to Single Responsibility and Open-Closed Principles of SOLID
we validate user inputs by Middleware **/
class FinancialTransactionController extends Controller
{
    public function destroy( Request $request )
    {
        $response_message  = '<b style="color:blue;" >We have an error to destroy this Financial Transaction</b>' ;
        try
        {
            $result_destroy_this_financial_transaction = financial_transaction::destroy_this_financial_transaction($request->financial_transaction_id) ;

            if($result_destroy_this_financial_transaction)
            {
                $response_message = '<span>The Selected Financial Transaction Successfully Deleted</span>' ;
            }
            return Responses::Success( 'back_to_previous_page' , '' , $response_message ) ;
        }
        catch (QueryException $exception)
        {
            return Responses::FailedWithException( 'back_to_previous_page' , '' , $response_message , $exception ) ;
        }
    }

    public function show_financial_management_main_page()
    {
        return view('back.show_financial_management_main_page' , [ 'title_of_page' => 'Financial Management' ]) ;
    }

    public function show_submit_financial_transaction_form()
    {
        try
        {
            $result_fetch_last_10_transaction = financial_transaction::result_fetch_last_10_transaction() ;
            return view('back.show_submit_financial_transaction_form',
            [
                'title_of_page'                             => 'Submit a Financial Transaction'  ,
                'result_fetch_last_10_transaction'          => $result_fetch_last_10_transaction ,
                'count_of_result_fetch_last_10_transaction' => $result_fetch_last_10_transaction->count() ,
            ]);
        }
        catch (QueryException $exception)
        {
            return Responses::FailedWithException( 'back_to_previous_page' , '' ,'<b style="color:blue;" >We have an error to show_submit_financial_transaction_form</b>' , $exception ) ;
        }
    }

    public function RemoveExtraWordsAmountOfPayment($request_amount_of_payment)
    {
        return preg_replace('/[^0-9]/', '' , $request_amount_of_payment );
    }

    public function PrepareMedicalDocumentNumberOfPatient($request_post_medical_document_number)
    {
        $medical_document_number_of_patient = $request_post_medical_document_number ;
        if( $medical_document_number_of_patient === '' )
        {
            $medical_document_number_of_patient = NULL ;
        }
        return $medical_document_number_of_patient ;
    }

    public function PrepareFinancialTransactionChildDrRelatedName($request_post_financial_transaction_child_dr_related_name)
    {
        $financial_transaction_child_dr_related_name = $request_post_financial_transaction_child_dr_related_name ;
        if( $financial_transaction_child_dr_related_name === NULL )
        {
            /** This variable should not be NULL
            Because we use this variable in financial transaction reporting page
            and if it be null we will face so errors there, so leave it EMPTY **/
            $financial_transaction_child_dr_related_name = '' ;
        }
        return $financial_transaction_child_dr_related_name ;
    }

    public function store_show_submit_financial_transaction_form( Storefinancial_transactionRequest $request )
    {
        $amount_of_payment                           = $this->RemoveExtraWordsAmountOfPayment(request()->post('amount_of_payment')) ;
        $medical_document_number_of_patient          = $this->PrepareMedicalDocumentNumberOfPatient(request()->post('medical_document_number')) ;
        $financial_transaction_child_dr_related_name = $this->PrepareFinancialTransactionChildDrRelatedName(request()->post('financial_transaction_child_dr_related_name')) ;

        $response_message = '<b style="color:blue;" >We have an error to Save This New Financial Financial Transaction</b>' ;
        try
        {
            $result_store_show_submit_financial_transaction_form = financial_transaction::store_show_submit_financial_transaction_form($medical_document_number_of_patient, request()->post('financial_transaction_type'), request()->post('financial_transaction_date'), request()->post('financial_transaction_time'), request()->post('title_of_payment') , $amount_of_payment, $financial_transaction_child_dr_related_name ) ;
            if($result_store_show_submit_financial_transaction_form->exists)
            {
                $response_message = 'The New Financial Transaction with date: <b>'.request()->post('financial_transaction_date').'</b> <br> and title: <b>'.request()->post('title_of_payment').'</b> and amount: <b>'.$amount_of_payment.'</b> <br> Successfully Submitted' ;
            }
            return Responses::Success( 'back_to_previous_page' , '' , $response_message ) ;
        }
        catch (QueryException $exception)
        {
            return Responses::FailedWithException( 'show_submit_financial_transaction_form' , '' , $response_message , $exception) ;
        }
    }

    public function show_financial_transaction_reporting_form()
    {
        return view('back.show_financial_transaction_reporting_form' , [ 'title_of_page' => 'Report Financial Transactions' ]) ;
    }

    public function run_financial_transaction_reporting_form( run_financial_transaction_reporting_formRequest $request )
    {
        try
        {
            $financial_report_from_date     = $request->financial_report_from_date    ;
            $financial_report_to_date       = $request->financial_report_to_date      ;

            $sign_trick_1 = '!=' ;
            $financial_transaction_child_dr_related_name_text_trick = '_' ;
            $name_of_financial_transaction_child_dr_related_name    = ''  ;
            if( $request->financial_transaction_child_dr_related_name !== NULL )
            {
                $sign_trick_1 = "=" ;
                $financial_transaction_child_dr_related_name_text_trick = "$request->financial_transaction_child_dr_related_name" ;
                $name_of_financial_transaction_child_dr_related_name    = $request->financial_transaction_child_dr_related_name.'<br>' ;
            }

            $sign_trick_2 = "!=" ;
            $financial_transaction_title_text_trick = "_" ;
            $name_of_financial_transaction_title    = ''  ;
            if( $request->financial_transaction_title !== NULL )
            {
                $sign_trick_2 = "=" ;
                $financial_transaction_title_text_trick = "$request->financial_transaction_title" ;
                $name_of_financial_transaction_title    = $request->financial_transaction_title.'<br>' ;
            }

            $result_fetch_receive_transactions_from_date_to_date = financial_transaction::result_fetch_receive_or_pay_transactions_from_date_to_date($financial_transaction_type = '+' , $sign_trick_1 , $financial_transaction_child_dr_related_name_text_trick , $sign_trick_2 , $financial_transaction_title_text_trick , $financial_report_from_date , $financial_report_to_date ) ;
            $result_fetch_pay_transactions_from_date_to_date     = financial_transaction::result_fetch_receive_or_pay_transactions_from_date_to_date($financial_transaction_type = '-' , $sign_trick_1 , $financial_transaction_child_dr_related_name_text_trick , $sign_trick_2 , $financial_transaction_title_text_trick , $financial_report_from_date , $financial_report_to_date ) ;

            return view('back.show_financial_transaction_reporting_form',
            [
                'title_of_page'                                       => 'Report Financial Transactions' ,
                'result_fetch_receive_transactions_from_date_to_date' => $result_fetch_receive_transactions_from_date_to_date ,
                'result_fetch_pay_transactions_from_date_to_date'     => $result_fetch_pay_transactions_from_date_to_date ,
                'financial_report_from_date'                          => $financial_report_from_date ,
                'financial_report_to_date'                            => $financial_report_to_date ,
                'num_of_receive_transactions'                         => $result_fetch_receive_transactions_from_date_to_date->count() ,
                'num_of_pay_transactions'                             => $result_fetch_pay_transactions_from_date_to_date->count() ,
                'name_of_financial_transaction_child_dr_related_name' => $name_of_financial_transaction_child_dr_related_name ,
                'name_of_financial_transaction_title'                 => $name_of_financial_transaction_title ,
            ]) ;
        }
        catch (QueryException $exception)
        {
            return Responses::FailedWithException( 'show_financial_transaction_reporting_form' , '' , '<b style="color:blue;" >We have an error to run_financial_transaction_reporting_form</b>' , $exception) ;
        }
    }
}