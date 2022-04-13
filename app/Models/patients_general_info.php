<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Database\Factories\PatientsGeneralInfoFactory;
use Illuminate\Support\Facades\Auth;

class patients_general_info extends Model
{
    use HasFactory ;

    protected $primaryKey = 'patient_id' ;

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

    public function patients_appointment()
    {
        return $this->hasMany(patients_appointment::class , 'appointment_patient_related_id' , 'patient_id') ;
    }

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

    public function find_admin_id_from_users_table()
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

    public function fetch_result_of_search_from()
    {
        $admin_id_from_users_table = $this->find_admin_id_from_users_table() ;

        $result_of_run_search_form =
        patients_general_info::query()
        ->select('*')
        ->where( 'patient_dr_related_id' , '=' , $admin_id_from_users_table )
        ->Where(function($query) {
        $query->where( 'patient_mobile_number'  , '=' , request()->post('search_text') )
        ->orwhere( 'patient_nationality_number' , '=' , request()->post('search_text') )
        ->orwhere( 'patient_first_name'         , '=' , request()->post('search_text') )
        ->orwhere( 'patient_last_name'          , '=' , request()->post('search_text') )
        ->orwhere( 'patient_id'                 , '=' , request()->post('search_text') ) ;
        })
        ->orderBy('patient_id', 'desc')
        ->get() ;

        return $result_of_run_search_form ;
    }
}
