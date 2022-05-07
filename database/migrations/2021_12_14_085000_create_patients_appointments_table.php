<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients_appointments', function (Blueprint $table) {
        $table->id('appointment_id');
        $table->foreignId('appointment_dr_related_id')->references('id')->on('users')->comment('this id related to main clinic manager who own this software which came from table users.id') ;
        $table->foreignId('appointment_patient_related_id')->references('patient_id')->on('patients_general_infos')->comment('this id related to patient id which came from table patients_general_infos.patient_id') ;
        $table->string('appointment_date','20')->collation('utf8_general_ci') ;
        $table->string('appointment_time','20')->collation('utf8_general_ci')->nullable() ;
        $table->string('appointment_status','20')->collation('utf8_general_ci')->default('1')->comment('to demonstrate first layer status of this appointment that doctor done visiting or not') ;
        $table->string('appointment_status_unique','20')->collation('utf8_general_ci')->default('0')->comment('to demonstrate second layer status of this appointment that doctor done visiting or not') ;
        $table->string('appointment_child_dr_related_name','20')->collation('utf8_general_ci')->nullable()->comment('for a situation that we have several doctors in a clinic') ;
        $table->string('appointment_service_type')->collation('utf8_general_ci')->nullable()->comment('Which type of service is related to this appointment for example Visit 1: 5000, Visit 2: 4500');
        $table->string('appointment_received_financial_status','20')->collation('utf8_general_ci')->default('0')->comment('did patient pay money of his appointment? 0=did not pay , 1=paid') ;
        $table->string('appointment_from_where','20')->collation('utf8_general_ci')->default('w')->comment('from which platform this appointment come? w=website , t=telegram_bot') ;
        $table->string('appointment_canceling_status','20')->collation('utf8_general_ci')->nullable()->comment('in some cases admin can cancel patient appointment') ;
        $table->softDeletes() ;
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
        Schema::dropIfExists('patients_appointments');
    }
}
