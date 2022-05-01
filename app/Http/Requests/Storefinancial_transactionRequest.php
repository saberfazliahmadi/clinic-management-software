<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Storefinancial_transactionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'amount_of_payment'          => 'required|min:1|integer'           ,
            'financial_transaction_date' => 'required|min:1|max:10|date_format:Y-m-d' ,
            'financial_transaction_type' => 'required|min:1|in:+,-'            ,
            'title_of_payment'           => 'required|min:1'                   ,
            'medical_document_number'    => 'integer'                          ,
            'financial_transaction_child_dr_related_name' => 'max:100'         ,
            'financial_transaction_time' => 'max:6'                            ,

        ];
    }
}
