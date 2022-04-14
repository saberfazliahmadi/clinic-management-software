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

    static function store_new_patient_form($request_all)
    {
        if( isset($request_all['patient_relationship_status']) )
        {
            $trick_patient_relationship_status = $request_all['patient_relationship_status'] ;
        }
        else
        {
            $trick_patient_relationship_status = '' ;
        }

        if( isset($request_all['patient_gender']) )
        {
            $trick_patient_gender = $request_all['patient_gender'] ;
        }
        else
        {
            $trick_patient_gender = '' ;
        }

        $result_store_new_patient_form= new self(
        [
            'patient_dr_related_id'         => self::find_admin_id_from_users_table() ,
            'patient_first_name'            => $request_all['patient_first_name'] ,
            'patient_last_name'             => $request_all['patient_last_name'] ,
            'patient_mobile_number'         => $request_all['patient_mobile_number'] ,
            'patient_nationality_number'    => $request_all['patient_nationality_number'] ,
            'patient_last_appointment_date' => $request_all['patient_last_appointment_date'] ,
            'patient_birth_day'             => $request_all['patient_birth_day'] ,
            'patient_address'               => $request_all['patient_address'] ,
            'patient_phone_number'          => $request_all['patient_phone_number'] ,
            'patient_email_address'         => $request_all['patient_email_address'] ,
            'patient_relationship_status'   => $trick_patient_relationship_status ,
            'patient_gender'                => $trick_patient_gender ,
            'patient_surgery_history'       => $request_all['patient_surgery_history'] ,
            'patient_disease_background'    => $request_all['patient_disease_background'] ,
            'patient_medication_history'    => $request_all['patient_medication_history'] ,
            'patient_allergies_history'     => $request_all['patient_allergies_history'] ,
            'patient_more_description'      => $request_all['patient_more_description']
        ]
        );
        return $result_store_new_patient_form ;
    }

    static function result_update_this_patient_id($update_this_patient_id,$request_all)
    {
        if( isset($request_all['patient_relationship_status']) )
        {
            $trick_patient_relationship_status = $request_all['patient_relationship_status'] ;
        }
        else
        {
            $trick_patient_relationship_status = '' ;
        }

        if( isset($request_all['patient_gender']) )
        {
            $trick_patient_gender = $request_all['patient_gender'] ;
        }
        else
        {
            $trick_patient_gender = '' ;
        }

        $result_update_this_patient_id = self::
        where('patient_id'             , '=', $update_this_patient_id)
        ->where('patient_dr_related_id', '=', self::find_admin_id_from_users_table())
        ->limit('1')
        ->update([
         'patient_first_name'            => $request_all['patient_first_name'] ,
         'patient_last_name'             => $request_all['patient_last_name'] ,
         'patient_mobile_number'         => $request_all['patient_mobile_number'] ,
         'patient_nationality_number'    => $request_all['patient_nationality_number'] ,
         'patient_last_appointment_date' => $request_all['patient_last_appointment_date'] ,
         'patient_birth_day'             => $request_all['patient_birth_day'] ,
         'patient_address'               => $request_all['patient_address'] ,
         'patient_phone_number'          => $request_all['patient_phone_number'] ,
         'patient_email_address'         => $request_all['patient_email_address'] ,
         'patient_relationship_status'   => $trick_patient_relationship_status ,
         'patient_gender'                => $trick_patient_gender ,
         'patient_surgery_history'       => $request_all['patient_surgery_history'] ,
         'patient_disease_background'    => $request_all['patient_disease_background'] ,
         'patient_medication_history'    => $request_all['patient_medication_history'] ,
         'patient_allergies_history'     => $request_all['patient_allergies_history'] ,
         'patient_more_description'      => $request_all['patient_more_description']
         ]);

        return $result_update_this_patient_id ;
    }

    static function result_edit_patient_form($edit_this_patient_id)
    {
        $result_edit_patient_form = self::
        where( 'patient_id'              , '=' , $edit_this_patient_id )
        ->where( 'patient_dr_related_id' , '=' , self::find_admin_id_from_users_table() )
        ->limit('1')
        ->first() ;

        return $result_edit_patient_form ;
    }

    static function number_of_duplicate_mobile_number( $update_this_patient_id , $request_patient_mobile_number )
    {
        // Check for mobile number duplication
        // WE SHOULD NOT HAVE TWO PATIENTS WITH SAME MOBILE NUMBERS IN OUR DATABASE!
        // The mobile numbers should be unique
        // EXCEPTION condition ( patient_id != $update_this_patient_id )
        $number_of_duplicate_mobile_number = self::
        select('patient_mobile_number'  , 'patient_dr_related_id' , 'patient_id' )
        ->where('patient_mobile_number' , '='  , $request_patient_mobile_number )
        ->where('patient_dr_related_id' , '='  , self::find_admin_id_from_users_table() )
        ->where('patient_id'            , '!=' , $update_this_patient_id )
        ->limit('1')
        ->count();

        return $number_of_duplicate_mobile_number ;
    }

    static function number_of_total_clinic_patients()
    {
        $number_of_total_clinic_patients = self::
        select('patient_id' , 'patient_dr_related_id')
        ->where('patient_dr_related_id' , '=' , self::find_admin_id_from_users_table() )
        ->count() ;
        return $number_of_total_clinic_patients ;
    }

    static function fetch_result_of_search_from()
    {
        $admin_id_from_users_table = self::find_admin_id_from_users_table() ;

        $result_of_run_search_form =
        self::query()
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

    static function delete_this_patient_id($request_delete_this_patient_id)
    {
        $result_delete_this_patient_id = self::
        select('patient_id' , 'patient_dr_related_id')
        ->where( 'patient_id'            , '=' , $request_delete_this_patient_id )
        ->where( 'patient_dr_related_id' , '=' , self::find_admin_id_from_users_table() )
        ->limit('1')
        ->delete();

        return $result_delete_this_patient_id ;
    }
}
