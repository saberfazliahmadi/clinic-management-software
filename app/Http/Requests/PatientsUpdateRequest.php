<?php
namespace App\Http\Requests;
use App\Rules\CheckMobileNumberDuplicationForUpdatePatientRule;
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
            'patient_first_name'            => 'alpha_num|required|min:3' ,
            'patient_last_name'             => 'alpha_num|required|min:3' ,
            'patient_mobile_number'         => [ 'required' , 'min:8' , 'numeric' , app(CheckMobileNumberDuplicationForUpdatePatientRule::class) ] ,
            'patient_nationality_number'    => 'numeric|min:1' ,
            'patient_last_appointment_date' => 'date|min:10|date_format:Y-m-d' ,
            'patient_birth_day'             => 'date|min:10|date_format:Y-m-d' ,
            'patient_address'               => 'string' ,
            'patient_phone_number'          => 'numeric|min:1' ,
            'patient_email_address'         => 'email|min:1' ,
            'patient_relationship_status'   => 'in:divorced,married,single' ,
            'patient_gender'                => 'in:male,female' ,
            'patient_surgery_history'       => 'string' ,
            'patient_disease_background'    => 'string' ,
            'patient_medication_history'    => 'string' ,
            'patient_allergies_history'     => 'string' ,
            'patient_more_description'      => 'string'
        ];
    }
}
