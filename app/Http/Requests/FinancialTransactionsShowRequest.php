<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FinancialTransactionsShowRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
        'financial_report_from_date'                  => 'required|min:6|max:10|date_format:Y-m-d' ,
        'financial_report_to_date'                    => 'required|min:6|max:10|date_format:Y-m-d' ,
        'financial_transaction_title'                 => 'max:100'                                 ,
        'financial_transaction_child_dr_related_name' => 'max:100'
        ];
    }
}
