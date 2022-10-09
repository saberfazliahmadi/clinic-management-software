<?php
namespace App\Http\Requests;

use App\Rules\CheckValidityOfAppointmentIDRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class PatientsEHRDocumentStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            "_method"                                 => 'in:post',
            "common_hypersensitivity_2311"            => 'array',
            "typed_keyboard_savabegh"                 => 'string',
            "patient_surgery_history"                 => 'string',
            "patient_disease_background"              => 'string',
            "patient_medication_history"              => 'string',
            "patient_allergies_history"               => 'string',
            "keyboard_medications_picker"             => 'string',
            "common_diet"                             => 'array' ,
            "keyboard_common_diet"                    => 'string',
            "common_return_date"                      => 'array',
            "keyboard_common_return_date"             => 'string',
            "image"                                   => 'image|mimes:jpeg,png,jpg,gif,svg|max:10048',
            "keyboard_paraclinic_file_title"          => 'string',
            "keyboard_chart_1"                        => 'string',
            "keyboard_chart_2"                        => 'string',
            "keyboard_chart_3"                        => 'string',
            "keyboard_chart_4"                        => 'string',
            "doc_date_created"                        => 'date|min:10|date_format:Y-m-d' ,
            "encrypted_patient_id"                    => 'required',
            "encrypted_patient_name"                  => 'required',
            "EHR_document_related_appointment_id"     => [ 'integer' , app(CheckValidityOfAppointmentIDRule::class) ] ,
            "EHR_document_related_clinic_doctor_name" => 'string',
            "patient_more_description"                => 'string'
        ];
    }
}
