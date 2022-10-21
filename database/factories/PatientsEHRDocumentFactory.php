<?php

namespace Database\Factories;

use App\Models\patients_general_info;
use App\Models\User;
use AppEHR\Models\patients_EHR_document;
use Illuminate\Database\Eloquent\Factories\Factory;

class PatientsEHRDocumentFactory extends Factory
{
    protected $model = patients_EHR_document::class ;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $User                                = User::all()->random(1)->first();
        $patients_general_info               = patients_general_info::all()->random(1)->first();
        $array_user_common_return_date       = explode("," , $User->common_return_date );
        $array_user_clinic_doctors_name      = explode("," , $User->clinic_doctors_name );
        //$EHR_document_prescribed_common_drug = explode("," , $User->common_drug );
        //$EHR_document_prescribed_common_diet = explode("," , $User->common_diet );

        return [
            'EHR_document_patient_related_id'           => $patients_general_info->patient_id ,
            'EHR_document_dr_related_id'                => $patients_general_info->patient_dr_related_id ,
            'EHR_document_related_appointment_id'       => NULL ,
            //'EHR_document_prescribed_common_drug'       => $EHR_document_prescribed_common_drug[rand(0,count($EHR_document_prescribed_common_drug)-1)] ,
            //'EHR_document_prescribed_common_diet'       => $EHR_document_prescribed_common_diet[rand(0,count($EHR_document_prescribed_common_diet)-1)] ,
            'EHR_document_prescribed_next_appointment'  => $array_user_common_return_date[rand(0,count($array_user_common_return_date)-1)] ,
            'EHR_document_related_clinic_doctor_name'   => $array_user_clinic_doctors_name[rand(0,count($array_user_clinic_doctors_name)-1)] ,
        ];
    }
}