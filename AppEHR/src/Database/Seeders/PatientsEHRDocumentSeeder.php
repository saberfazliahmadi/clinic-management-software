<?php

namespace AppEHR\Database\Seeders;

use AppEHR\Models\PatientsEHRDocument;
use Illuminate\Database\Seeder;

class PatientsEHRDocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PatientsEHRDocument::newFactory()->create() ;
    }
}
