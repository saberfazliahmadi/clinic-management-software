<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class run_financial_transaction_reporting_formRequest extends FormRequest
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
            'financial_report_from_date' => 'required|min:1|max:10|date_format:Y-m-d' ,
            'financial_report_to_date'   => 'required|min:1|max:10|date_format:Y-m-d' ,
        ];
    }
}
