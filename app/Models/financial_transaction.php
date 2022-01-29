<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class financial_transaction extends Model
{
    protected $fillable =
    [
        'financial_dr_related_id' ,
        'financial_patient_related_id' ,
        'financial_appointment_related_id' ,
        'financial_transaction_type' ,
        'financial_transaction_date' ,
        'financial_transaction_time' ,
        'financial_transaction_title' ,
        'financial_transaction_amount' ,
        'financial_transaction_child_dr_related_name'
    ] ;
    use HasFactory;
}
