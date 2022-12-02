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
        Schema::create('patients_e_h_r_documents', function (Blueprint $table) {
            $table->id('EHR_document_id')->autoIncrement()->unsigned();
            //$table->foreignId('EHR_document_patient_related_id')->constrained('patients_general_infos' , 'patient_id') ;
            $table->bigInteger('EHR_document_patient_related_id')->unsigned();
            $table->foreignId('EHR_document_dr_related_id')->references('id')->on('users') ;
            //$table->foreignId('EHR_document_related_appointment_id')->nullable()->comment('this field could be empty sometimes, because in some the doctor will make an EHR document for patient with out any appointment')->references('appointment_id')->on('patients_appointments') ;
            $table->bigInteger('EHR_document_related_appointment_id')->nullable()->comment('this field could be empty sometimes, because in some the doctor will make an EHR document for patient with out any appointment')->unsigned();
            $table->longText('EHR_document_prescribed_common_drug')->collation('utf8_general_ci')->nullable();
            $table->longText('EHR_document_prescribed_common_diet')->collation('utf8_general_ci')->nullable();
            $table->longText('EHR_document_prescribed_next_appointment')->collation('utf8_general_ci')->nullable();
            $table->longText('EHR_document_related_clinic_doctor_name')->collation('utf8_general_ci')->nullable();
            $table->string('EHR_document_chart_1')->collation('utf8_general_ci')->nullable();
            //$table->string('EHR_document_chart_2')->collation('utf8_general_ci')->nullable();
            //$table->string('EHR_document_chart_3')->collation('utf8_general_ci')->nullable();
            //$table->string('EHR_document_chart_4')->collation('utf8_general_ci')->nullable();
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
        Schema::dropIfExists('patients_e_h_r_documents');
    }
}
