<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsPhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients_photos', function (Blueprint $table) {
        $table->id('patients_photos_id');
        $table->string('patients_photos_file_name')->collation('utf8_general_ci');
        $table->string('patients_photos_file_description')->collation('utf8_general_ci')->nullable();
        $table->integer('patients_photos_patient_related_id')->collation('utf8_general_ci');
        $table->integer('patients_photos_dr_related_id')->collation('utf8_general_ci');
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
        Schema::dropIfExists('patients_photos');
    }
}
