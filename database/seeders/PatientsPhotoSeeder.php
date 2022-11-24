<?php

namespace Database\Seeders;

use App\Models\patients_photo;
use Illuminate\Database\Seeder;

class PatientsPhotoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        patients_photo::newFactory()->create() ;
    }
}
