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
        $patients_photos_patient_related_id = mt_rand('1' , '1000') ;
        $patients_photos_dr_related_id      = mt_rand('1' , '100') ;

        //if (! mkdir($concurrentDirectory = 'public/storage/images/'.$patients_photos_dr_related_id.'/'.$patients_photos_patient_related_id.'/para', 0777, true) && ! is_dir($concurrentDirectory))
        //{
        //    throw new \RuntimeException(sprintf('Directory "%s" was not created', $concurrentDirectory));
        //}
        //$this->faker->image('public/storage/images/' . $patients_photos_dr_related_id . '/' . $patients_photos_patient_related_id . '/para' ,640,480, null, false);

        return [
            'patients_photos_file_name'             => $this->faker->name(),
            'patients_photos_file_description'      => $this->faker->text(),
            'patients_photos_patient_related_id'    => $patients_photos_patient_related_id ,
            'patients_photos_dr_related_id'         => $patients_photos_dr_related_id ,
        ];
    }
}
