<?php

namespace Database\Seeders;

use App\Models\financial_transaction;
use Illuminate\Database\Seeder;

class FinancialTransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        financial_transaction::newFactory()->create() ;
    }
}
