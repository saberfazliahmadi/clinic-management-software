<?php

namespace Database\Factories;

use App\Models\patients_general_info;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PatientsGeneralInfoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = patients_general_info::class ;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $User = User::all()->random(1)->first();
        return [
            'patient_dr_related_id'         => $User->id,
            'patient_first_name'            => $this->faker->firstName(),
            'patient_last_name'             => $this->faker->lastName(),
            'patient_mobile_number'         => $this->faker->unique->numerify('###########') ,
            'patient_last_appointment_date' => date('Y-m-d') ,
            'patient_nationality_number'    => $this->faker->unique()->creditCardNumber ,
            'patient_phone_number'          => $this->faker->unique->numerify('###########') ,
            'patient_last_appointment_time' => $this->faker->time ,
            'patient_email_address'         => $this->faker->unique()->safeEmail(),
            'patient_birth_day'             => $this->faker->date('Y-m-d') ,
            'patient_address'               => $this->faker->address() ,
            'patient_relationship_status'   => array_rand(['single' => 'single' , 'divorced' => 'divorced' , 'married' => 'married' ],1) ,
            'patient_gender'                => array_rand(['male' => 'male' ,'female' => 'female'],1) ,
            'patient_allergies_history'     => $User->common_hypersensitivity ,
            'patient_medication_history'    => $User->common_drug,
            'patient_more_description'      => $User->common_hypersensitivity,
        ];
    }
}
