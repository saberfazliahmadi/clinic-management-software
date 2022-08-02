<?php

namespace Database\Seeders;

use AppEHR\Models\patients_EHR_document;
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
        patients_EHR_document::newFactory('100')->create() ;
    }
}
