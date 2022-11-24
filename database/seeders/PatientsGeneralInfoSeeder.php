<?php

namespace Database\Seeders;

use App\Models\patients_general_info;
use Illuminate\Database\Seeder;

class PatientsGeneralInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        patients_general_info::newFactory()->create() ;
    }
}
