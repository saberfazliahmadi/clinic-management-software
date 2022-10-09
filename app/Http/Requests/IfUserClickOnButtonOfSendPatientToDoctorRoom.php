<?php
namespace App\Http\Requests;

use App\Rules\CheckValidityOfAppointmentIDRule;
use Illuminate\Foundation\Http\FormRequest;

class IfUserClickOnButtonOfSendPatientToDoctorRoom extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
        'appointment_id'               => [ 'required' , 'integer' , app(CheckValidityOfAppointmentIDRule::class) ] ,
        'money_receive'                => 'min:1|array'            ,
        'send_patient_to_doctors_room' => 'required|in:true'
        ];
    }

    public function messages()
    {
        return [
        'appointment_id.required' => 'Send patient to doctor\'s room was not successfully done!<br>Please select one of the patient from list and then click on "Send Patient to doctor\'s room" Button' ,
        ];
    }
}