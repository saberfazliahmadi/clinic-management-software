<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Updatepatients_general_infoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true ;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'patient_first_name'    => 'required|min:3' ,
            'patient_last_name'     => 'required|min:3' ,
            'patient_mobile_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:8' ,
            'patient_last_appointment_date' => 'date_format:Y-m-d' ,
        ];
    }
}
