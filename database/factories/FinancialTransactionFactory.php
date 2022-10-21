<?php

namespace Database\Factories;

use App\Models\financial_transaction;
use App\Models\patients_general_info;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class FinancialTransactionFactory extends Factory
{
    protected $model = financial_transaction::class ;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $User                         = User::all()->random(1)->first();
        $financial_patient_related_id = patients_general_info::all()->where('patient_dr_related_id' ,'=', $User->id)->random(1)->first();
        // The "+" sign means the money received and the "-" sign means the money paid
        $financial_transaction_type = array( '1' => '+' , '2' => '-' );

        return [
            'financial_dr_related_id'                     => $User->id,
            'financial_patient_related_id'                => $financial_patient_related_id,
            'financial_transaction_type'                  => $financial_transaction_type[rand(1,2)],
            'financial_transaction_date'                  => date('Y-m-d'),
            'financial_transaction_time'                  => $this->faker->time('H:i'),
            'financial_transaction_title'                 => $this->faker->text(),
            'financial_transaction_amount'                => $this->faker->numerify('#####'),
            'financial_transaction_child_dr_related_name' => $this->faker->name,
        ];
    }
}
