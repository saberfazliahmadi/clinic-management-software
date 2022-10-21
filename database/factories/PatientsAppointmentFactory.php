<?php

namespace Database\Factories;

use App\Models\patients_appointment;
use App\Models\patients_general_info;
use Illuminate\Database\Eloquent\Factories\Factory;

class PatientsAppointmentFactory extends Factory
{
    protected $model= patients_appointment::class ;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $patients_general_info = patients_general_info::all()->random(1)->first();
        return [
            'appointment_dr_related_id'             => $patients_general_info->patient_dr_related_id ,
            'appointment_patient_related_id'        => $patients_general_info->patient_id ,
            'appointment_date'                      => date('Y-m-d') ,
            'appointment_time'                      => $this->faker->time('H:i') ,
            'appointment_status'                    => '1'  ,
            'appointment_status_unique'             => '0'  ,
            'appointment_received_financial_status' => '0'  ,
            'appointment_from_where'                => 'w'  ,
        ];
    }
}
