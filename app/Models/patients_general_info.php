<?php

namespace App\Models;

use Database\Factories\PatientsGeneralInfoFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class patients_general_info extends Model
{
    use HasFactory ;

    protected $fillable =
    [
        'patient_dr_related_id' ,
        'patient_first_name' ,
        'patient_last_name' ,
        'patient_last_appointment_date' ,
        'patient_last_appointment_time' ,
        'patient_birth_day' ,
        'patient_nationality_number' ,
        'patient_address' ,
        'patient_phone_number' ,
        'patient_mobile_number' ,
        'patient_email_address' ,
        'patient_relationship_status' ,
        'patient_gender' ,
        'patient_submit_type' ,
        'patient_surgery_history' ,
        'patient_disease_background' ,
        'patient_medication_history' ,
        'patient_allergies_history' ,
        'patient_more_description' ,
        'patient_from_external_platform_id' ,
        'patient_from_external_platform_step' ,
    ] ;

    //public function patients_appointment()
    //{
    //    return $this->hasMany(patients_appointment::class , 'appointment_patient_related_id' , 'patient_id') ;
    //}

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        for($x = 0; $x <= 100; $x++)
        {
            return new PatientsGeneralInfoFactory() ;
        }
    }
}
