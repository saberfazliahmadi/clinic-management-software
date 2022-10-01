<?php

namespace Database\Factories;

use App\Models\patients_general_info;
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
        return [
            'patient_dr_related_id'         => mt_rand(1, 100),
            'patient_first_name'            => $this->faker->firstName(),
            'patient_last_name'             => $this->faker->lastName(),
            'patient_mobile_number'         => $this->faker->unique->phoneNumber ,
            'patient_last_appointment_date' => date('Y-m-d') ,
            'patient_nationality_number'    => $this->faker->unique()->creditCardNumber ,
            'patient_phone_number'          => $this->faker->unique->numerify('###########') ,
            'patient_last_appointment_time' => $this->faker->time ,
            'patient_email_address'         => $this->faker->unique()->safeEmail(),
        ];
    }
}
