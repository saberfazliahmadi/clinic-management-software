<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class patients_EHR_document extends Model
{
    protected $fillable =
    [
        'EHR_document_patient_related_id' ,
        'EHR_document_dr_related_id' ,
        'EHR_document_related_appointment_id' ,
        'EHR_document_prescribed_common_drug' ,
        'EHR_document_prescribed_common_diet' ,
        'EHR_document_prescribed_next_appointment' ,
        'EHR_document_related_clinic_doctor_name' ,
        'EHR_document_chart_1' ,
        'EHR_document_chart_2' ,
        'EHR_document_chart_3' ,
        'EHR_document_chart_4'
    ] ;

    use HasFactory;
}
