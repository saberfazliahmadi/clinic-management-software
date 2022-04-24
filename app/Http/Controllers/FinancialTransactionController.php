<?php

namespace App\Http\Controllers;

use App\Http\Requests\run_financial_transaction_reporting_formRequest;
use App\Models\financial_transaction;
use App\Http\Requests\Storefinancial_transactionRequest;
use App\Http\Requests\Updatefinancial_transactionRequest;

use Illuminate\Http\Request ;
use Illuminate\Support\Facades\Auth;
use function Illuminate\Events\queueable;

class FinancialTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Storefinancial_transactionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Storefinancial_transactionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\financial_transaction  $financial_transaction
     * @return \Illuminate\Http\Response
     */
    public function show(financial_transaction $financial_transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\financial_transaction  $financial_transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(financial_transaction $financial_transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updatefinancial_transactionRequest  $request
     * @param  \App\Models\financial_transaction  $financial_transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Updatefinancial_transactionRequest $request, financial_transaction $financial_transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\financial_transaction  $financial_transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(financial_transaction $financial_transaction , Request $request )
    {
        try
        {
            $result_destroy_this_financial_transaction = financial_transaction::destroy_this_financial_transaction($request->financial_transaction_id) ;
            if(!$result_destroy_this_financial_transaction)
            {
                return redirect(route('show_financial_transaction_reporting_form'))
                ->with(['success_message' => '<b style="color:blue;" >We have an error to destroy this Financial Transaction</b>']);
            }
            return redirect()->back()
            ->with(['success_message' => '<span>The Selected Financial Transaction Successfully Deleted</span>']);
        }
        catch (\Exception $exception)
        {
            return redirect(route('show_financial_transaction_reporting_form'))
            ->with(['success_message' => '<b style="color:blue;" >We have an error to destroy this Financial Transaction</b>']);
        }
    }

    public function show_financial_management_main_page()
    {
        return view('back.show_financial_management_main_page' , [ 'title_of_page' => 'Financial Management' ]) ;
    }

    public function show_financial_settings_receiving_money_form()
    {
        return view('back.show_financial_settings_receiving_money_form', [ 'title_of_page' => 'Financial Service Types Settings' ]) ;
    }

    public function store_financial_settings_receiving_money_form( Request $request )
    {
        // Check all financial items to be eligible
        // Each of financial transaction items should have number and character and ':'
        $all_financial_items = explode(',' , request()->post('financial_management')) ;
        foreach($all_financial_items as $financial_items)
        {
            if(!strpos( $financial_items,':') || strlen($financial_items) < 3 || !preg_replace('/[^0-9]/', '', $financial_items) || !preg_replace('/[^a-zA-Z]/', '', $financial_items) )
            {
                return redirect(route('show_financial_settings_receiving_money_form'))
                ->with(['success_message' => '<b style="color:red;">'.$financial_items.' is wrong</b><br><b style="color:blue;" >At least type 3 characters followed by this type <br> Service Name : Service Amount</b><br> and at the end press Save button<br>Remember, each service type should have this character <b style="color:blue;" >:</b>' ]);
            }
        }

        try
        {
            $financial_management  = request()->post('financial_management') ;
            $financial_management  = str_replace( "." , "" , $financial_management ) ;
            $financial_management  = str_replace( "/" , "" , $financial_management ) ;

            $store_financial_settings_receiving_money_form = financial_transaction::store_financial_settings_receiving_money_form($financial_management,Auth::user()->name);

            if(!$store_financial_settings_receiving_money_form)
            {
                return redirect(route('show_financial_settings_receiving_money_form'))
                ->with(['success_message' => '<b style="color:blue;" >We have an error to update these financial settings</b>' ]);
            }
            return redirect(route('show_financial_settings_receiving_money_form'))
            ->with(['success_message' => 'The New Financial Settings of Receiving Money Successfully Updated']);
        }
        catch (\Exception $exception)
        {
            return redirect(route('show_financial_settings_receiving_money_form'))
            ->with(['success_message' => '<b style="color:blue;" >We have an error to update these financial settings</b>' ]);
        }
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
        catch (\Exception $exception)
        {
            return redirect(route('show_submit_financial_transaction_form'))
            ->with(['success_message' => '<b style="color:blue;" >We have an error to show_submit_financial_transaction_form</b>' ]);
        }
    }

    public function store_show_submit_financial_transaction_form( Storefinancial_transactionRequest $request )
    {
        $financial_transaction_type = request()->post('financial_transaction_type') ;
        // Remove any character from payment amount except numbers
        $amount_of_payment  = preg_replace('/[^0-9]/', '', request()->post('amount_of_payment'));
        $financial_transaction_date  = request()->post('financial_transaction_date') ;
        $financial_transaction_time  = request()->post('financial_transaction_time') ;
        $title_of_payment = request()->post('title_of_payment') ;

        $medical_document_number_of_patient = request()->post('medical_document_number') ;
        if( $medical_document_number_of_patient == '' )
        {
            $medical_document_number_of_patient = NULL ;
        }

        $financial_transaction_child_dr_related_name = request()->post('financial_transaction_child_dr_related_name') ;
        if( request()->post('financial_transaction_child_dr_related_name') == NULL )
        {
            // This value SHOULD NOT BE NULL because we use this value in financial transaction reporting page
            // So leave it EMPTY
            $financial_transaction_child_dr_related_name = '' ;
        }

        try
        {
            $result_store_show_submit_financial_transaction_form = financial_transaction::store_show_submit_financial_transaction_form($medical_document_number_of_patient, $financial_transaction_type, $financial_transaction_date, $financial_transaction_time, $title_of_payment, $amount_of_payment, $financial_transaction_child_dr_related_name ) ;

            if(!$result_store_show_submit_financial_transaction_form)
            {
                return redirect(route('show_submit_financial_transaction_form'))
                ->with(['success_message' => '<b style="color:blue;" >We have an error to Save This New Financial Financial Transaction</b>' ]);
            }
            return redirect(route('show_submit_financial_transaction_form'))
            ->with(['success_message' => 'The New Financial Transaction with date: <b>'.$financial_transaction_date.'</b> <br> and title: <b>'.$title_of_payment.'</b> and amount: <b>'.$amount_of_payment.'</b> <br> Successfully Submitted']);
        }
        catch (\Exception $exception)
        {
            return redirect(route('show_submit_financial_transaction_form'))
            ->with(['success_message' => '<b style="color:blue;" >We have an error to Save This New Financial Financial Transaction</b>' ]);
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

            if( $request->financial_transaction_child_dr_related_name !== NULL )
            {
                $sign_trick_1 = "=" ;
                $financial_transaction_child_dr_related_name_text_trick = "$request->financial_transaction_child_dr_related_name" ;
                $name_of_financial_transaction_child_dr_related_name    = $request->financial_transaction_child_dr_related_name.'<br>' ;
            }
            else
            {
                $sign_trick_1 = '!=' ;
                $financial_transaction_child_dr_related_name_text_trick = '_' ;
                $name_of_financial_transaction_child_dr_related_name    = '' ;
            }

            if( $request->financial_transaction_title !== NULL )
            {
                $sign_trick_2 = "=" ;
                $financial_transaction_title_text_trick = "$request->financial_transaction_title" ;
                $name_of_financial_transaction_title    = $request->financial_transaction_title.'<br>' ;
            }
            else
            {
                $sign_trick_2 = "!=" ;
                $financial_transaction_title_text_trick = "_" ;
                $name_of_financial_transaction_title    = '' ;
            }

            $result_fetch_receive_transactions_from_date_to_date = financial_transaction::result_fetch_receive_or_pay_transactions_from_date_to_date($financial_transaction_type = '+' , $sign_trick_1 , $financial_transaction_child_dr_related_name_text_trick , $sign_trick_2 , $financial_transaction_title_text_trick , $financial_report_from_date , $financial_report_to_date ) ;
            $num_of_receive_transactions = $result_fetch_receive_transactions_from_date_to_date->count() ;

            $result_fetch_pay_transactions_from_date_to_date = financial_transaction::result_fetch_receive_or_pay_transactions_from_date_to_date($financial_transaction_type = '-' , $sign_trick_1 , $financial_transaction_child_dr_related_name_text_trick , $sign_trick_2 , $financial_transaction_title_text_trick , $financial_report_from_date , $financial_report_to_date ) ;
            $num_of_pay_transactions = $result_fetch_pay_transactions_from_date_to_date->count() ;

            return view('back.show_financial_transaction_reporting_form',
            [
                'title_of_page'                                       => 'Report Financial Transactions' ,
                'result_fetch_receive_transactions_from_date_to_date' => $result_fetch_receive_transactions_from_date_to_date ,
                'result_fetch_pay_transactions_from_date_to_date'     => $result_fetch_pay_transactions_from_date_to_date ,
                'financial_report_from_date'                          => $financial_report_from_date ,
                'financial_report_to_date'                            => $financial_report_to_date ,
                'num_of_receive_transactions'                         => $num_of_receive_transactions ,
                'num_of_pay_transactions'                             => $num_of_pay_transactions ,
                'name_of_financial_transaction_child_dr_related_name' => $name_of_financial_transaction_child_dr_related_name ,
                'name_of_financial_transaction_title'                 => $name_of_financial_transaction_title ,
            ]) ;
        }
        catch (\Exception $exception)
        {
            return redirect(route('show_financial_transaction_reporting_form'))
            ->with(['success_message' => '<b style="color:blue;" >We have an error to run_financial_transaction_reporting_form</b>' ]);
        }
    }
}
