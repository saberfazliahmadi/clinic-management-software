<?php
namespace App\Http\Controllers;

use App\Http\Requests\FinancialTransactionsShowRequest;
use App\Http\Requests\FinancialTransactionsStoreRequest;
use App\Models\financial_transaction;
use App\Responses\Responses;
use Illuminate\Http\Request;

class FinancialTransactionController extends Controller
{
    public function index()
    {
        return view('back.financial_index' , [ 'title_of_page' => 'Report Financial Transactions' ]) ;
    }

    public function create()
    {
        try
        {
            $result_fetch_last_10_transaction = financial_transaction::resultFetchLast10Transactions() ;
            return view('back.financial_create',
            [
                'title_of_page'                             => 'Submit a Financial Transaction'  ,
                'result_fetch_last_10_transaction'          => $result_fetch_last_10_transaction ,
                'count_of_result_fetch_last_10_transaction' => $result_fetch_last_10_transaction->count() ,
            ]);
        }
        catch (\Exception $exception)
        {
            return Responses::failedWithException( 'back_to_previous_page' , '' ,'<b style="color:blue;" >We have an error to show submit financial transaction form</b>' , $exception ) ;
        }
    }

    public function store(FinancialTransactionsStoreRequest $request)
    {
        $request_validated                           = $request->validated() ;
        $amount_of_payment                           = $this->removeExtraWordsAmountOfPayment($request_validated['amount_of_payment']) ;
        $medical_document_number_of_patient          = $this->prepareMedicalDocumentNumberOfPatient($request_validated['medical_document_number']) ;
        $financial_transaction_child_dr_related_name = $this->prepareFinancialTransactionChildDrRelatedName($request_validated['financial_transaction_child_dr_related_name']) ;
        $response_message                            = '<b style="color:blue;" >We Have an Error To Save This New Financial Financial Transaction</b>' ;
        try
        {
            $result_store_show_submit_financial_transaction_form = financial_transaction::storeShowSubmitFinancialTransactionForm($medical_document_number_of_patient, $request_validated['financial_transaction_type'], $request_validated['financial_transaction_date'], $request_validated['financial_transaction_time'], $request_validated['title_of_payment'] , $amount_of_payment, $financial_transaction_child_dr_related_name ) ;
            if($result_store_show_submit_financial_transaction_form->exists)
            {
                $response_message = 'The New Financial Transaction with <br>Date: <b>'.$request_validated['financial_transaction_date'].'</b> <br>Title: <b>'.$request_validated['title_of_payment'].'</b><br>Amount: <b>'.$amount_of_payment.'</b><br>Successfully Submitted' ;
            }
            return Responses::success( 'back_to_previous_page' , '' , $response_message ) ;
        }
        catch (\Exception $exception)
        {
            return Responses::failedWithException( 'financial.create' , '' , $response_message , $exception) ;
        }
    }

    public function show(FinancialTransactionsShowRequest $request )
    {
        try
        {
            $request_validated                                   = $request->validated() ;
            [$sign_trick_1, $financial_transaction_child_dr_related_name_text_trick, $name_of_financial_transaction_child_dr_related_name, $sign_trick_2, $financial_transaction_title_text_trick, $name_of_financial_transaction_title] = $this->prepareFinancialVaraible($request_validated['financial_transaction_child_dr_related_name'], $request_validated['financial_transaction_title']);
            $result_fetch_receive_transactions_from_date_to_date = financial_transaction::resultFetchReceiveOrPayTransactionsFromDateToDate($financial_transaction_type = '+' , $sign_trick_1 , $financial_transaction_child_dr_related_name_text_trick , $sign_trick_2 , $financial_transaction_title_text_trick , $request_validated['financial_report_from_date'] , $request_validated['financial_report_to_date'] ) ;
            $result_fetch_pay_transactions_from_date_to_date     = financial_transaction::resultFetchReceiveOrPayTransactionsFromDateToDate($financial_transaction_type = '-' , $sign_trick_1 , $financial_transaction_child_dr_related_name_text_trick , $sign_trick_2 , $financial_transaction_title_text_trick , $request_validated['financial_report_from_date'] , $request_validated['financial_report_to_date'] ) ;

            return view('back.financial_index',
            [
                'title_of_page'                                       => 'Report Financial Transactions' ,
                'result_fetch_receive_transactions_from_date_to_date' => $result_fetch_receive_transactions_from_date_to_date ,
                'result_fetch_pay_transactions_from_date_to_date'     => $result_fetch_pay_transactions_from_date_to_date ,
                'financial_report_from_date'                          => $request_validated['financial_report_from_date'] ,
                'financial_report_to_date'                            => $request_validated['financial_report_to_date'] ,
                'num_of_receive_transactions'                         => $result_fetch_receive_transactions_from_date_to_date->count() ,
                'num_of_pay_transactions'                             => $result_fetch_pay_transactions_from_date_to_date->count() ,
                'name_of_financial_transaction_child_dr_related_name' => $name_of_financial_transaction_child_dr_related_name ,
                'name_of_financial_transaction_title'                 => $name_of_financial_transaction_title ,
            ]) ;
        }
        catch (\Exception $exception)
        {
            return Responses::failedWithException( 'financial.show' , '' , '<b style="color:blue;" >We have an error to run financial transaction reporting form</b>' , $exception) ;
        }
    }

    public function destroy( Request $request )
    {
        try
        {
            if( !(financial_transaction::destroyThisFinancialTransaction($request->financial_id)) )
            {
                return Responses::success( 'home' , '' , '<b style="color:blue;" >The selected financial transaction that you want to destroy Does Not Exist!</b>' ) ;
            }
            return Responses::success( 'back_to_previous_page' , '' , '<span>The selected financial transaction is Successfully Deleted</span>' ) ;
        }
        catch (\Exception $exception)
        {
            return Responses::failedWithException( 'home' , '' , '<b style="color:blue;" >We have an error to destroy this Financial Transaction</b>' , $exception ) ;
        }
    }

    public function showMainFinancialPage()
    {
        return view('back.financial_main' , [ 'title_of_page' => 'Financial Management Main Page' ] ) ;
    }

    public function prepareFinancialVaraible($request_financial_transaction_child_dr_related_name,$request_financial_transaction_title)
    {
        $sign_trick_1                                           = '!=' ;
        $financial_transaction_child_dr_related_name_text_trick = '_' ;
        $name_of_financial_transaction_child_dr_related_name    = ''  ;
        if( $request_financial_transaction_child_dr_related_name !== NULL && $request_financial_transaction_child_dr_related_name !== "" )
        {
            $sign_trick_1                                           = "=" ;
            $financial_transaction_child_dr_related_name_text_trick = "$request_financial_transaction_child_dr_related_name" ;
            $name_of_financial_transaction_child_dr_related_name    = $request_financial_transaction_child_dr_related_name.'<br>' ;
        }

        $sign_trick_2                           = "!=" ;
        $financial_transaction_title_text_trick = "_" ;
        $name_of_financial_transaction_title    = ''  ;
        if( $request_financial_transaction_title !== NULL && $request_financial_transaction_title !== "" )
        {
            $sign_trick_2                           = "=" ;
            $financial_transaction_title_text_trick = "$request_financial_transaction_title" ;
            $name_of_financial_transaction_title    = $request_financial_transaction_title.'<br>' ;
        }

        return [
        $sign_trick_1 ,
        $financial_transaction_child_dr_related_name_text_trick ,
        $name_of_financial_transaction_child_dr_related_name ,
        $sign_trick_2 ,
        $financial_transaction_title_text_trick ,
        $name_of_financial_transaction_title ] ;
    }

    public function removeExtraWordsAmountOfPayment($request_amount_of_payment)
    {
        return preg_replace('/[^0-9]/', '' , $request_amount_of_payment );
    }

    public function prepareMedicalDocumentNumberOfPatient($request_post_medical_document_number)
    {
        $medical_document_number_of_patient = $request_post_medical_document_number ;
        if( $medical_document_number_of_patient === '' )
        {
            $medical_document_number_of_patient = NULL ;
        }
        return $medical_document_number_of_patient ;
    }

    public function prepareFinancialTransactionChildDrRelatedName($request_post_financial_transaction_child_dr_related_name)
    {
        $financial_transaction_child_dr_related_name = $request_post_financial_transaction_child_dr_related_name ;
        if( $financial_transaction_child_dr_related_name === NULL )
        {
            /** This variable should not be NULL
            Because we use this variable in financial transaction reporting page
            and if it is null we will face with errors, so leave it EMPTY **/
            $financial_transaction_child_dr_related_name = '' ;
        }
        return $financial_transaction_child_dr_related_name ;
    }
}