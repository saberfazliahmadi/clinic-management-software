<?php

namespace Database\Seeders;

use App\Models\patients_appointment;
use Illuminate\Database\Seeder;

class PatientsAppointmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\patients_appointment::factory(10)->create();

        patients_appointment::newFactory()->create() ;
    }
}
