<?php
namespace AppEHR\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ValidatorStorepatients_EHR_documentRequest
{
    public function handle(Request $request, Closure $next)
    {
        $rules = [
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
            "common_return_date"           => "array",
            "keyboard_common_return_date"  => "" ,
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

        $request->validate($rules);
        return $next($request);
    }
}
