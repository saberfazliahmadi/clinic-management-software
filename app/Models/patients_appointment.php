<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class patients_appointment extends Model
{
    protected $fillable =
    [
        'appointment_dr_related_id' ,
        'appointment_patient_related_id' ,
        'appointment_date' ,
        'appointment_time' ,
        'appointment_status' ,
        'appointment_status_unique' ,
        'appointment_child_dr_related_name' ,
        'appointment_service_type' ,
        'appointment_received_financial_status' ,
        'appointment_from_where' ,
        'appointment_canceling_status'
    ] ;
    use HasFactory;
}
