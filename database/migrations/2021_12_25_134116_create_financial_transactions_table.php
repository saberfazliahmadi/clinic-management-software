<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinancialTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('financial_transactions', function (Blueprint $table) {
            $table->id('financial_transaction_id');
            $table->foreignId('financial_dr_related_id')->references('id')->on('users');
            $table->foreignId('financial_patient_related_id')->nullable()->comment('this field could be empty sometimes, because in some transaction cases doctor paid money for general Clinic costs')->references('patient_id')->on('patients_general_infos') ;
            $table->foreignId('financial_appointment_related_id')->nullable()->comment('this field could be empty sometimes, because in some transaction cases doctor paid money for general Clinic costs')->references('appointment_id')->on('patients_appointments') ;
            $table->string('financial_transaction_type','15')->collation('utf8_general_ci')->comment('It could be "+" for when clinic receive money and "-" when clinic paid money');
            $table->string('financial_transaction_date' ,'20')->collation('utf8_general_ci');
            $table->string('financial_transaction_time' ,'20')->collation('utf8_general_ci')->nullable();
            $table->string('financial_transaction_title')->collation('utf8_general_ci')->nullable();
            $table->integer('financial_transaction_amount')->collation('utf8_general_ci')->default('0');
            $table->string('financial_transaction_child_dr_related_name' ,'255')->collation('utf8_general_ci')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('financial_transactions');
    }
}
