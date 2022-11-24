<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use phpDocumentor\Reflection\Types\Null_;

class CreatePatientsGeneralInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients_general_infos', function (Blueprint $table) {
            $table->id('patient_id')->autoIncrement()->unsigned();
            $table->foreignId('patient_dr_related_id')->references('id')->on('users');
            $table->string('patient_first_name','50')->collation('utf8_general_ci');
            $table->string('patient_last_name','50')->collation('utf8_general_ci');
            $table->string('patient_last_appointment_date','20')->collation('utf8_general_ci')->nullable();
            $table->string('patient_last_appointment_time','20')->collation('utf8_general_ci')->nullable();
            $table->string('patient_birth_day','20')->collation('utf8_general_ci')->nullable();
            $table->string('patient_nationality_number','50')->collation('utf8_general_ci')->nullable();
            $table->string('patient_address','300')->collation('utf8_general_ci')->nullable();
            $table->string('patient_phone_number','30')->collation('utf8_general_ci')->nullable();
            $table->string('patient_mobile_number','30')->collation('utf8_general_ci');
            $table->string('patient_email_address','71')->collation('utf8_general_ci')->nullable();
            $table->string('patient_relationship_status','50')->collation('utf8_general_ci')->nullable();
            $table->string('patient_gender','50')->collation('utf8_general_ci')->nullable();
            $table->string('patient_submit_type','100')->collation('utf8_general_ci')->nullable();
            $table->string('patient_surgery_history','2000')->collation('utf8_general_ci')->nullable();
            $table->string('patient_disease_background','2000')->collation('utf8_general_ci')->nullable();
            $table->string('patient_medication_history','2000')->collation('utf8_general_ci')->nullable();
            $table->string('patient_allergies_history','2000')->collation('utf8_general_ci')->nullable();
            $table->text('patient_more_description')->collation('utf8_general_ci')->nullable();
            $table->integer('patient_from_external_platform_id')->nullable()->unsigned();
            $table->integer('patient_from_external_platform_step')->nullable()->unsigned();
            $table->softDeletes();
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
        Schema::dropIfExists('patients_general_infos');
    }
}
