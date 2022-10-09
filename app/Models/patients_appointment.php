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

    static function appointmentsOnSpecificDate($show_all_appointments_on_this_date)
    {
        return self::
        join('patients_general_infos' , 'patients_general_infos.patient_id' , '=' , 'patients_appointments.appointment_patient_related_id')
        ->equalThisToAdminIdFromUserTable('patients_appointments.appointment_dr_related_id')
        ->where('patients_appointments.appointment_date' , $show_all_appointments_on_this_date )
        ->oldest('patients_appointments.appointment_time')
        ->get() ;
    }

    static function resultShowAllAppointmentsOfThisId($decrypted_patient_id)
    {
        return self::
        where('appointment_patient_related_id' , $decrypted_patient_id)
        ->equalThisToAdminIdFromUserTable('appointment_dr_related_id')
        ->latest('appointment_id')
        ->get() ;
    }

    static function deleteThisAppointmentId($request_appointment_id)
    {
        return self::
        select( 'appointment_id'  , 'appointment_dr_related_id' )
        ->where( 'appointment_id' , $request_appointment_id )
        ->equalThisToAdminIdFromUserTable('appointment_dr_related_id')
        ->limit('1')
        ->delete() ;
    }

    static function resultAppointmentsOfPatientsOnThisTimeAndDate($choose_time_for_this_date, $appointment_time_trick)
    {
        return self::
        join('patients_general_infos' , 'patients_general_infos.patient_id' , '=' , 'patients_appointments.appointment_patient_related_id')
        ->select('patients_appointments.*' , 'patients_general_infos.patient_id' , 'patients_general_infos.patient_first_name' , 'patients_general_infos.patient_last_name' , 'patients_general_infos.patient_mobile_number' )
        ->equalThisToAdminIdFromUserTable('patients_appointments.appointment_dr_related_id')
        ->where([
                    'patients_appointments.appointment_date' => $choose_time_for_this_date ,
                    'patients_appointments.appointment_time' => $appointment_time_trick
                 ])
        ->get();
    }

    static function storeNewPatientAppointmentTime($choose_time_for_this_patient_id, $choose_time_for_this_date, $appointment_time, $appointment_child_dr_related_name, $appointment_service_type)
    {
        return self::create(
        [
            'appointment_dr_related_id'         => findAdminIdFromUsersTable() ,
            'appointment_patient_related_id'    => $choose_time_for_this_patient_id ,
            'appointment_date'                  => $choose_time_for_this_date ,
            'appointment_time'                  => $appointment_time ,
            'appointment_child_dr_related_name' => $appointment_child_dr_related_name ,
            'appointment_service_type'          => $appointment_service_type ,
        ]);
    }

    static function updateThisAppointmentFromWatingStatusToDoneStatus($request_appointment_id , $admin_id_from_users_table , $money_receive_header_console )
    {
        self::
        where([
                'appointment_id'            => $request_appointment_id ,
                'appointment_dr_related_id' => $admin_id_from_users_table
               ])
        ->update([
                 'appointment_status'                    => '0' ,
                 'appointment_status_unique'             => '1' ,
                 'appointment_received_financial_status' => $money_receive_header_console
                 ]);
    }

    public static function fetchAppointmentData($request_appointment_id , $admin_id_from_users_table )
    {
        return self::
        select('appointment_id' , 'appointment_dr_related_id' , 'appointment_patient_related_id' , 'appointment_child_dr_related_name' , 'appointment_service_type' )
        ->where( [
                  'appointment_id'            => $request_appointment_id ,
                  'appointment_dr_related_id' => $admin_id_from_users_table
                 ])
        ->limit('1')
        ->get() ;
    }

    public static function CheckValidityOfAppointmentID( $trick_of_appointment_id )
    {
        return self::
        select( 'appointment_id' , 'appointment_dr_related_id' )
        ->where( [
                 'appointment_id'            => $trick_of_appointment_id ,
                 'appointment_dr_related_id' => findAdminIdFromUsersTable()
                 ])
        ->limit('1')
        ->count() ;
    }

    public static function allAppointmentsOnThisDate($admin_id_from_users_table , $show_all_appointments_on_this_date )
    {
        return self::
        join('patients_general_infos' , 'patients_general_infos.patient_id' , '=' , 'patients_appointments.appointment_patient_related_id')
        ->where( [
                   'patients_appointments.appointment_dr_related_id' => $admin_id_from_users_table ,
                   'patients_appointments.appointment_date'          => $show_all_appointments_on_this_date
                 ] )
        ->oldest('patients_appointments.appointment_time')
        ->get() ;
    }

    public static function countAppointmentsOnThisDateWhichAreOnWaitingStatus($admin_id_from_users_table , $show_all_appointments_on_this_date )
    {
        return self::
        select( 'appointment_dr_related_id' , 'appointment_date' , 'appointment_status_unique' , 'appointment_status' , 'appointment_time' )
        ->where( [
                    'patients_appointments.appointment_dr_related_id' => $admin_id_from_users_table ,
                    'patients_appointments.appointment_date'          => $show_all_appointments_on_this_date ,
                    'patients_appointments.appointment_status_unique' => '0' ,
                    'patients_appointments.appointment_status'        => '1'
                 ])
        ->count() ;
    }

}
