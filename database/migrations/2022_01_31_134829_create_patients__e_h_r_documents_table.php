<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsEHRDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients__e_h_r_documents', function (Blueprint $table) {
            $table->id('EHR_document_id');
            $table->integer('EHR_document_patient_related_id') ;
            $table->integer('EHR_document_dr_related_id') ;
            $table->integer('EHR_document_related_appointment_id')->collation('utf8_general_ci')->nullable();
            $table->string('EHR_document_prescribed_common_drug')->collation('utf8_general_ci')->nullable();
            $table->string('EHR_document_prescribed_common_diet')->collation('utf8_general_ci')->nullable();
            $table->string('EHR_document_prescribed_next_appointment')->collation('utf8_general_ci')->nullable();
            $table->string('EHR_document_related_clinic_doctor_name')->collation('utf8_general_ci')->nullable();
            $table->string('EHR_document_chart_1')->collation('utf8_general_ci')->nullable();
            $table->string('EHR_document_chart_2')->collation('utf8_general_ci')->nullable();
            $table->string('EHR_document_chart_3')->collation('utf8_general_ci')->nullable();
            $table->string('EHR_document_chart_4')->collation('utf8_general_ci')->nullable();
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
        Schema::dropIfExists('patients__e_h_r_documents');
    }
}
