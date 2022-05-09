<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class store_patients_ehr_document_pageRequest extends FormRequest
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
            'common_hypersensitivity_2311'   => 'string' ,
            'typed_keyboard_savabegh'        => 'string' ,
            'patient_more_description'       => 'string' ,
            'patient_surgery_history'        => 'string' ,
            'patient_disease_background'     => 'string' ,
            'patient_medication_history'     => 'string' ,
            'patient_allergies_history'      => 'string' ,
            'keyboard_medications_picker'    => 'string' ,
            'keyboard_common_diet'           => 'string' ,
            'keyboard_common_return_date'    => 'string' ,
            'keyboard_paraclinic_file_title' => 'string' ,
            'keyboard_chart_1'               => 'string' ,
            'keyboard_chart_2'               => 'string' ,
            'keyboard_chart_3'               => 'string' ,
            'keyboard_chart_4'               => 'string' ,
            'doc_date_created'               => 'max:10|date_format:Y-m-d' ,
            'patient_id'                     => 'required' ,
            'EHR_document_related_appointment_id' => 'integer' ,
            'EHR_document_related_clinic_doctor_name' => 'string' ,
        ];
    }
}
