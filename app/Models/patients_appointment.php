<?php

namespace App\Models;

use Database\Factories\PatientsAppointmentFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class patients_appointment extends Model
{
    use SoftDeletes, HasFactory ;
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

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return new PatientsAppointmentFactory() ;
    }

    static function result_show_form_of_appointments_on_specific_date($show_all_appointments_on_this_date)
    {
        // Create mysql query to extract all of appointments that record in database on this specific date (JOIN TYPE)
        $result_show_form_of_appointments_on_specific_date = self::
        join('patients_general_infos' , 'patients_general_infos.patient_id' , '=' , 'patients_appointments.appointment_patient_related_id')
        ->equal_this_to_admin_id_from_user_table('patients_appointments.appointment_dr_related_id')
        ->where('patients_appointments.appointment_date' , $show_all_appointments_on_this_date )
        ->oldest('patients_appointments.appointment_time')
        ->get() ;

        return $result_show_form_of_appointments_on_specific_date ;
    }

    static function result_show_all_appointments_of_this_id($edit_this_patient_id)
    {
        $result_show_all_appointments_of_this_id = self::
        where('appointment_patient_related_id' , $edit_this_patient_id)
        ->equal_this_to_admin_id_from_user_table('appointment_dr_related_id')
        ->latest('appointment_id')
        ->get() ;

        return $result_show_all_appointments_of_this_id ;
    }

    static function delete_this_appointment_id($request_appointment_id)
    {
        $result_of_delete_this_appointment_id = self::
        select( 'appointment_id'  , 'appointment_dr_related_id' )
        ->where( 'appointment_id' , $request_appointment_id )
        ->equal_this_to_admin_id_from_user_table('appointment_dr_related_id')
        ->limit('1')
        ->delete() ;

        return $result_of_delete_this_appointment_id ;
    }

    static function result_appointments_of_patients_on_this_time_and_date($choose_time_for_this_date, $appointment_time_trick)
    {
        $result_appointments_of_patients_on_this_time_and_date = self::
        join('patients_general_infos' , 'patients_general_infos.patient_id' , '=' , 'patients_appointments.appointment_patient_related_id')
        ->select('patients_appointments.*' , 'patients_general_infos.patient_id' , 'patients_general_infos.patient_first_name' , 'patients_general_infos.patient_last_name' )
        ->equal_this_to_admin_id_from_user_table('patients_appointments.appointment_dr_related_id')
        ->where( [
            'patients_appointments.appointment_date' => $choose_time_for_this_date ,
            'patients_appointments.appointment_time' => $appointment_time_trick ] )
        ->get();

        return $result_appointments_of_patients_on_this_time_and_date ;
    }

    static function store_new_patient_appointment_time($choose_time_for_this_patient_id,$choose_time_for_this_date,$appointment_time,$appointment_child_dr_related_name,$appointment_service_type)
    {
        $result_store_new_patient_appointment_time = self::create(
            [
                'appointment_dr_related_id'         => find_admin_id_from_users_table() ,
                'appointment_patient_related_id'    => $choose_time_for_this_patient_id ,
                'appointment_date'                  => $choose_time_for_this_date ,
                'appointment_time'                  => $appointment_time ,
                'appointment_child_dr_related_name' => $appointment_child_dr_related_name ,
                'appointment_service_type'          => $appointment_service_type ,
            ]
        );
        return $result_store_new_patient_appointment_time ;
    }
}
