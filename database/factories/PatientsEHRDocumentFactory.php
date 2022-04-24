<?php

namespace Database\Factories;

use App\Models\patients_EHR_document;
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
        return [
            'EHR_document_patient_related_id'       => mt_rand(1, 1000),
            'EHR_document_dr_related_id'            => mt_rand(1, 100),
            'EHR_document_related_appointment_id'   => NULL ,

        ];
    }
}
