<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AppointmentsStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
        'choose_time_for_this_patient_id'   => 'required|min:1' ,
        'choose_time_for_this_date'         => 'required|min:6|max:10|date_format:Y-m-d' ,
        'appointment_time'                  => 'required|min:4|max:6|date_format:H:i' ,
        'appointment_child_dr_related_name' => 'string' ,
        'appointment_service_type'          => 'string' ,
        ];
    }
}
