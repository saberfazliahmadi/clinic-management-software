<?php

namespace Database\Factories;

use App\Models\patients_photo;
use Illuminate\Database\Eloquent\Factories\Factory;

class PatientsPhotoFactory extends Factory
{
    protected $model = patients_photo::class ;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'patients_photos_file_name'             => $this->faker->name(),
            'patients_photos_file_description'      => $this->faker->text(),
            'patients_photos_patient_related_id'    => mt_rand('1' , '1000') ,
            'patients_photos_dr_related_id'         => mt_rand('1' , '100') ,
        ];
    }
}
