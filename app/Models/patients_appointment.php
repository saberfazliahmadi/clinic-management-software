<?php

namespace App\Models;

use Database\Factories\PatientsAppointmentFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class patients_appointment extends Model
{
    protected $primaryKey = 'appointment_id' ;

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

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return new PatientsAppointmentFactory() ;
    }

    static function find_admin_id_from_users_table()
    {
        // If the user has a parent_id so user_type='user' and we use Auth::user()->parent_id
        if( strlen(Auth::user()->parent_id) > 0 )
        {
            return $admin_id_from_users_table = Auth::user()->parent_id ;
        }
        // If the user DOES NOT have parent_id so user_type='admin' and we use Auth::user()->id
        else
        {
            return $admin_id_from_users_table = Auth::user()->id ;
        }
    }

    static function result_show_all_appointments_of_this_id($edit_this_patient_id)
    {
        $result_show_all_appointments_of_this_id = self::
        where('appointment_patient_related_id'   , '=' , $edit_this_patient_id)
        ->where('appointment_dr_related_id'      , '=' , self::find_admin_id_from_users_table() )
        ->orderBy('appointment_id', 'desc')
        ->get() ;

        return $result_show_all_appointments_of_this_id ;
    }
}
