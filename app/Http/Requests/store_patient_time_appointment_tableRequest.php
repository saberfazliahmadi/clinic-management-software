<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class store_patient_time_appointment_tableRequest extends FormRequest
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
            'choose_time_for_this_patient_id'   => 'required|min:1' ,
            'choose_time_for_this_date'         => 'required|min:1|max:10|date_format:Y-m-d' ,
            'appointment_time'                  => 'required|min:1' ,
            'appointment_child_dr_related_name' => 'max:100' ,
            'appointment_service_type'          => 'max:100' ,
        ];
    }
}
