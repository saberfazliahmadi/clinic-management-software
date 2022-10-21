<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        \App\Models\User::factory(100)->create();

        for($x = 1; $x <= 1000; $x++)
        {
            $this->call([
                PatientsGeneralInfoSeeder::class,
            ]);
        }

        for($x = 1; $x <= 1000; $x++)
        {
            $this->call([
                PatientsAppointmentSeeder::class,
            ]);
        }

        for($x = 1; $x <= 1000; $x++)
        {
            $this->call([
                PatientsPhotoSeeder::class,
            ]);
        }

        for($x = 1; $x <= 1000; $x++)
        {
            $this->call([
                PatientsEHRDocumentSeeder::class ,
            ]);
        }

        for($x = 1; $x <= 1000; $x++)
        {
            $this->call([
                FinancialTransactionSeeder::class ,
            ]);
        }

    }
}
