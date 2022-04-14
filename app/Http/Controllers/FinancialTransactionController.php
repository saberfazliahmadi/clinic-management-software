<?php

namespace App\Http\Controllers;

use App\Models\financial_transaction;
use App\Http\Requests\Storefinancial_transactionRequest;
use App\Http\Requests\Updatefinancial_transactionRequest;

use Illuminate\Http\Request ;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use function Illuminate\Events\queueable;

class FinancialTransactionController extends Controller
{
    public function find_admin_id_from_users_table()
    {
        // If the user has a parent_id so user_type='user' and we use Auth::user()->parent_id
        if( strlen(Auth::user()->parent_id) > 0 )
        {
            return $admin_id_from_users_table = Auth::user()->parent_id ;
        }
        // If the user DOES NOT have parent_id so user_type='admin' and we use Auth::user()->id
        else
        {
            return $admin_id_from_users_table = Auth::user()->id ;
        }
    }

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
        $find_admin_id_from_users_table = $this->find_admin_id_from_users_table();
        $delete_this_financial_id       = $request->financial_transaction_id ;
        try
        {
            financial_transaction::
            select(['financial_transaction_id'  , 'financial_dr_related_id'])
            ->where( 'financial_transaction_id' , '=' , $delete_this_financial_id )
            ->where( 'financial_dr_related_id'  , '=' , $find_admin_id_from_users_table )
            ->limit('1')
            ->delete() ;

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
        $title_of_page = 'Financial Management' ;
        return view('back.show_financial_management_main_page' , [ 'title_of_page' => $title_of_page ]) ;
    }

    public function show_financial_settings_receiving_money_form()
    {
        $title_of_page = 'Financial Service Types Settings' ;
        return view('back.show_financial_settings_receiving_money_form', [ 'title_of_page' => $title_of_page ]) ;
    }

    public function store_financial_settings_receiving_money_form( Request $request )
    {
        if( request()->post('financial_management') != '' )
        {
            try
            {
                $financial_management  = request()->post('financial_management') ;
                $financial_management  = str_replace( "." , "" , $financial_management ) ;
                $financial_management  = str_replace( "/" , "" , $financial_management ) ;
                $find_admin_id_from_users_table = $this->find_admin_id_from_users_table() ;

                User::
                select( 'id'   , 'name' , 'financial_management' )
                ->where('id'   , '='    , $find_admin_id_from_users_table )
                ->where('name' , '='    , Auth::user()->name )
                ->limit('1')
                ->update(
                [
                    'financial_management' => $financial_management
                ]) ;

                return redirect(route('show_financial_settings_receiving_money_form'))
                ->with(['success_message' => 'The New Financial Settings of Receiving Money Successfully Updated' ]);
            }
            catch (\Exception $exception)
            {
                return redirect(route('show_financial_settings_receiving_money_form'))
                ->with(['success_message' => '<b style="color:blue;" >We have an error to update these financial settings</b>' ]);
            }
        }
        else
        {
            return redirect(route('show_financial_settings_receiving_money_form'))
            ->with(['success_message' => '<b style="color:blue;" >At least type 1 item by this type <br> "Service name: Amount of your desire money of this service"<br> and save it </b>' ]);
        }
    }

    public function show_submit_financial_transaction_form()
    {
        try
        {
            $find_admin_id_from_users_table   = $this->find_admin_id_from_users_table();
            $result_fetch_last_10_transaction = financial_transaction::
            where('financial_dr_related_id'    , '=' , $find_admin_id_from_users_table)
            ->orderBy('financial_transaction_id' , 'DESC')
            ->paginate('10') ;

            $count_of_result_fetch_last_10_transaction = $result_fetch_last_10_transaction->count();

            return view('back.show_submit_financial_transaction_form',
            [
                'title_of_page'                             => 'Submit a Financial Transaction' ,
                'result_fetch_last_10_transaction'          => $result_fetch_last_10_transaction ,
                'count_of_result_fetch_last_10_transaction' => $count_of_result_fetch_last_10_transaction ,
            ]);
        }
        catch (\Exception $exception)
        {
            return redirect(route('show_submit_financial_transaction_form'))
            ->with(['success_message' => '<b style="color:blue;" >We have an error to show_submit_financial_transaction_form</b>' ]);
        }
    }

    public function store_show_submit_financial_transaction_form( Request $request )
    {
        $request->validate(
            [
                'financial_transaction_type' => 'required|min:1'         ,
                'title_of_payment'           => 'required|min:1'         ,
                'amount_of_payment'          => 'required|min:1|integer' ,
                'financial_transaction_date' => 'required|min:1'         ,
            ]
        ) ;

        $find_admin_id_from_users_table     = $this->find_admin_id_from_users_table() ;
        $financial_transaction_type         = request()->post('financial_transaction_type') ;
        // Remove any character from payment amount except numbers
        $amount_of_payment                  = preg_replace('/[^0-9]/', '', request()->post('amount_of_payment'));
        $financial_transaction_date         = request()->post('financial_transaction_date') ;
        $financial_transaction_time         = request()->post('financial_transaction_time') ;
        $medical_document_number_of_patient = request()->post('medical_document_number') ;
        $title_of_payment                   = request()->post('title_of_payment') ;

        if( request()->post('medical_document_number') == '' )
        {
            $medical_document_number_of_patient = NULL ;
        }


        if( request()->post('financial_transaction_child_dr_related_name') !== NULL )
        {
            $financial_transaction_child_dr_related_name = request()->post('financial_transaction_child_dr_related_name') ;
        }
        else
        {
            // This value SHOULD NOT BE NULL because we use this value in financial transaction reporting page
            // So leave it EMPTY
            $financial_transaction_child_dr_related_name = '' ;
        }

        try
        {
            $result_store_show_submit_financial_transaction_form = new financial_transaction(
                [
                    'financial_dr_related_id'      => $find_admin_id_from_users_table ,
                    'financial_patient_related_id' => $medical_document_number_of_patient ,
                    'financial_transaction_type'   => $financial_transaction_type ,
                    'financial_transaction_date'   => $financial_transaction_date ,
                    'financial_transaction_time'   => $financial_transaction_time ,
                    'financial_transaction_title'  => $title_of_payment ,
                    'financial_transaction_amount' => $amount_of_payment ,
                    'financial_transaction_child_dr_related_name' => $financial_transaction_child_dr_related_name
                ]
            ) ;

            $result_store_show_submit_financial_transaction_form->save() ;

            return redirect(route('show_submit_financial_transaction_form'))
            ->with(['success_message' => 'The New Financial Transaction with date: <b>'.$financial_transaction_date.'</b> <br> and title: <b>'.$title_of_payment.'</b> and amount: <b>'.$amount_of_payment.'</b> <br> Successfully Submitted' ]);
        }
        catch (\Exception $exception)
        {
            return redirect(route('show_submit_financial_transaction_form'))
            ->with(['success_message' => '<b style="color:blue;" >We have an error to Save This New Financial Financial Transaction</b>' ]);
        }
    }

    public function show_financial_transaction_reporting_form()
    {
        $title_of_page = 'Report Financial Transactions' ;
        return view('back.show_financial_transaction_reporting_form' , [ 'title_of_page' => $title_of_page ]) ;
    }

    public function run_financial_transaction_reporting_form( Request $request )
    {
        $request->validate(
            [
                'financial_report_from_date' => 'required|min:1' ,
                'financial_report_to_date'   => 'required|min:1' ,
            ]
        ) ;

        try
        {
            $financial_report_from_date     = $request->financial_report_from_date    ;
            $financial_report_to_date       = $request->financial_report_to_date      ;
            $find_admin_id_from_users_table = $this->find_admin_id_from_users_table() ;

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

            $result_fetch_receive_transactions_from_date_to_date = financial_transaction::
            where('financial_dr_related_id' , '=' , $find_admin_id_from_users_table )
            ->where('financial_transaction_type' , '=' , '+' )
            ->where('financial_transaction_child_dr_related_name' , $sign_trick_1 , $financial_transaction_child_dr_related_name_text_trick )
            ->where('financial_transaction_title' , $sign_trick_2 , $financial_transaction_title_text_trick )
            ->whereBetween('financial_transaction_date', [$financial_report_from_date, $financial_report_to_date])
            ->orderBy('financial_transaction_id','DESC')
            ->get() ;

            $num_of_receive_transactions = $result_fetch_receive_transactions_from_date_to_date->count() ;

            $result_fetch_pay_transactions_from_date_to_date = financial_transaction::
            where('financial_dr_related_id' , '=' , $find_admin_id_from_users_table )
            ->where('financial_transaction_type' , '=' , '-' )
            ->where('financial_transaction_child_dr_related_name' , $sign_trick_1 , $financial_transaction_child_dr_related_name_text_trick )
            ->where('financial_transaction_title' , $sign_trick_2 , $financial_transaction_title_text_trick )
            ->whereBetween('financial_transaction_date', [$financial_report_from_date, $financial_report_to_date])
            ->orderBy('financial_transaction_id','DESC')
            ->get() ;

            $num_of_pay_transactions = $result_fetch_pay_transactions_from_date_to_date->count() ;

            $title_of_page = 'Report Financial Transactions' ;
            return view('back.show_financial_transaction_reporting_form',
            [
                'title_of_page' => $title_of_page ,
                'result_fetch_receive_transactions_from_date_to_date' => $result_fetch_receive_transactions_from_date_to_date ,
                'result_fetch_pay_transactions_from_date_to_date' => $result_fetch_pay_transactions_from_date_to_date ,
                'financial_report_from_date' => $financial_report_from_date ,
                'financial_report_to_date' => $financial_report_to_date ,
                'num_of_receive_transactions' => $num_of_receive_transactions ,
                'num_of_pay_transactions' => $num_of_pay_transactions ,
                'name_of_financial_transaction_child_dr_related_name' => $name_of_financial_transaction_child_dr_related_name ,
                'name_of_financial_transaction_title' => $name_of_financial_transaction_title ,
            ]) ;
        }
        catch (\Exception $exception)
        {
            return redirect(route('show_financial_transaction_reporting_form'))
            ->with(['success_message' => '<b style="color:blue;" >We have an error to run_financial_transaction_reporting_form</b>' ]);
        }
    }
}
