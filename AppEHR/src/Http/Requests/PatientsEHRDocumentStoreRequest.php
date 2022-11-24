<?php
namespace AppEHR\Http\Requests;

use App\Rules\CheckValidityOfAppointmentIDRule;
use Illuminate\Foundation\Http\FormRequest;

class PatientsEHRDocumentStoreRequest extends FormRequest
{
    public function authorize() : bool
    {
        return true;
    }

    public function rules() : array
    {
        return [
            "_method"                                 => 'sometimes|in:post',
            "common_hypersensitivity_2311"            => 'sometimes|array',
            "typed_keyboard_savabegh"                 => 'sometimes|string',
            "patient_surgery_history"                 => 'sometimes|string',
            "patient_disease_background"              => 'sometimes|string',
            "patient_medication_history"              => 'sometimes|string',
            "patient_allergies_history"               => 'sometimes|string',
            "keyboard_medications_picker"             => 'sometimes|string',
            "common_diet"                             => 'sometimes|array' ,
            "keyboard_common_diet"                    => 'sometimes|string',
            "common_return_date"                      => 'sometimes|array',
            "keyboard_common_return_date"             => 'sometimes|string',
            "image"                                   => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:10048',
            "keyboard_paraclinic_file_title"          => 'sometimes|string',
            "keyboard_chart_1"                        => 'sometimes|string',
            "keyboard_chart_2"                        => 'sometimes|string',
            "keyboard_chart_3"                        => 'sometimes|string',
            "keyboard_chart_4"                        => 'sometimes|string',
            "doc_date_created"                        => 'sometimes|date|min:10|date_format:Y-m-d' ,
            "encrypted_patient_id"                    => 'required',
            "encrypted_patient_name"                  => 'required',
            "EHR_document_related_appointment_id"     => [ 'sometimes' , 'integer' , app(CheckValidityOfAppointmentIDRule::class) ] ,
            "EHR_document_related_clinic_doctor_name" => 'sometimes|string',
            "patient_more_description"                => 'sometimes|string'
        ];
    }
}
