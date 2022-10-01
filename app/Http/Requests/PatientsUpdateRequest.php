<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class PatientsUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'patient_first_name'            => 'required|min:3' ,
            'patient_last_name'             => 'required|min:3' ,
            'patient_mobile_number'         => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:8' ,
            'patient_nationality_number'    => '' ,
            'patient_last_appointment_date' => 'date_format:Y-m-d' ,
            'patient_birth_day'             => '' ,
            'patient_address'               => '' ,
            'patient_phone_number'          => '' ,
            'patient_email_address'         => '' ,
            'patient_relationship_status'   => '' ,
            'patient_gender'                => '' ,
            'patient_surgery_history'       => '' ,
            'patient_disease_background'    => '' ,
            'patient_medication_history'    => '' ,
            'patient_allergies_history'     => '' ,
            'patient_more_description'      => ''
        ];
    }
}
