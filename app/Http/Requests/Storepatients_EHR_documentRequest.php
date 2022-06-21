<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Storepatients_EHR_documentRequest extends FormRequest
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
            "_method"                      => 'in:post',
            "common_hypersensitivity_2311" => 'array' ,
            "typed_keyboard_savabegh"      => "",
            "patient_surgery_history"      => "",
            "patient_disease_background"   => "",
            "patient_medication_history"   => "",
            "patient_allergies_history"    => "",
            "keyboard_medications_picker"  => "",
            "common_diet"                  => "array" ,
            "keyboard_common_diet"         => "",
            "keyboard_common_return_date"  => "array" ,
            "keyboard_paraclinic_file_title" => "",
            "keyboard_chart_1"             => "",
            "keyboard_chart_2"             => "",
            "keyboard_chart_3"             => "",
            "keyboard_chart_4"             => "",
            "doc_date_created"             => "",
            "patient_id"                   => 'required' ,
            "patient_name"                 => "",
            "EHR_document_related_appointment_id" => "",
            "EHR_document_related_clinic_doctor_name" => "" ,
            "image" => "image|mimes:jpeg,png,jpg,gif,svg|max:10048" ,
        ];
    }
}
