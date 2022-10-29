<?php
namespace App\Http\Requests;
use App\Rules\CheckMobileNumberDuplicationForUpdatePatientRule;
use Illuminate\Foundation\Http\FormRequest;

class PatientsUpdateRequest extends FormRequest
{
    public function authorize() : bool
    {
        return true;
    }

    public function rules() : array
    {
        return [
            'patient_first_name'            => 'required|min:3|alpha_num' ,
            'patient_last_name'             => 'required|min:3|alpha_num' ,
            'patient_mobile_number'         => [ 'required' , 'min:8' , 'numeric' , app(CheckMobileNumberDuplicationForUpdatePatientRule::class) ] ,
            'patient_nationality_number'    => 'sometimes|numeric|min:1' ,
            'patient_last_appointment_date' => 'sometimes|date|min:10|date_format:Y-m-d' ,
            'patient_birth_day'             => 'sometimes|date|min:10|date_format:Y-m-d' ,
            'patient_address'               => 'sometimes|string' ,
            'patient_phone_number'          => 'sometimes|numeric|min:1' ,
            'patient_email_address'         => 'sometimes|email|min:1' ,
            'patient_relationship_status'   => 'sometimes|in:divorced,married,single' ,
            'patient_gender'                => 'sometimes|in:male,female' ,
            'patient_surgery_history'       => 'sometimes|string' ,
            'patient_disease_background'    => 'sometimes|string' ,
            'patient_medication_history'    => 'sometimes|string' ,
            'patient_allergies_history'     => 'sometimes|string' ,
            'patient_more_description'      => 'sometimes|string'
        ];
    }
}
