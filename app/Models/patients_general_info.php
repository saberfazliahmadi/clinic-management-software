<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Database\Factories\PatientsGeneralInfoFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class patients_general_info extends Model
{
    use HasFactory , SoftDeletes ;
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

    public function scopepatient_id($query,$update_this_patient_id)
    {
        return $query->where('patient_id' , $update_this_patient_id) ;
    }

    static function storeNewPatientForm($request_validated)
    {
        $trick_patient_relationship_status = $request_validated['patient_relationship_status'] ?? '';
        $trick_patient_gender              = $request_validated['patient_gender'] ?? ''             ;

        return self::create( $request_validated +
        [
            'patient_dr_related_id'         => findAdminIdFromUsersTable()        ,
            'patient_relationship_status'   => $trick_patient_relationship_status ,
            'patient_gender'                => $trick_patient_gender
        ]);
    }

    static function resultUpdateThisPatientId($update_this_patient_id, $request_validated)
    {
        $trick_patient_relationship_status = $request_validated['patient_relationship_status'] ?? '' ;
        $trick_patient_gender              = $request_validated['patient_gender'] ?? ''              ;

        return self::
        patient_id($update_this_patient_id)
        ->equalThisToAdminIdFromUserTable('patient_dr_related_id')
        ->limit('1')
        ->update( $request_validated +
        [
            'patient_relationship_status'   => $trick_patient_relationship_status ,
            'patient_gender'                => $trick_patient_gender
         ]);
    }

    public static function checkValidityOfPatientID($this_patient_id)
    {
        return self::
        select('patient_id','patient_dr_related_id')
        ->patient_id($this_patient_id)
        ->equalThisToAdminIdFromUserTable('patient_dr_related_id')
        ->limit('1')
        ->count() ;
    }

    static function fetchInfoOfThisPatientId($decrypted_patient_id)
    {
        return self::
        patient_id($decrypted_patient_id)
        ->equalThisToAdminIdFromUserTable('patient_dr_related_id')
        ->limit('1')
        ->first() ;
    }

    static function numberOfDuplicateMobileNumber($update_this_patient_id , $request_patient_mobile_number )
    {
        /** Check for mobile number duplication.
        We should not have two patients with an Equal Mobile Number in our Database!
        It means, the mobile numbers should be unique.
        Remember that, we have an EXCEPTION condition ( patient_id != $update_this_patient_id ) **/
        return self::
        select( 'patient_mobile_number'  , 'patient_dr_related_id' , 'patient_id' )
        ->equalThisToAdminIdFromUserTable('patient_dr_related_id')
        ->where( 'patient_mobile_number' , $request_patient_mobile_number )
        ->where( 'patient_id'            , '!=' , $update_this_patient_id )
        ->limit('1')
        ->count();
    }

    static function numberOfTotalClinicPatients()
    {
        return self::
        select('patient_id' , 'patient_dr_related_id')
        ->equalThisToAdminIdFromUserTable('patient_dr_related_id')
        ->count() ;
    }

    static function fetchResultOfSearchForm()
    {
        return self::query()
        ->select( 'patient_id' , 'patient_dr_related_id' , 'patient_mobile_number' , 'patient_nationality_number' , 'patient_first_name' , 'patient_last_name' )
        ->where('patient_dr_related_id' , findAdminIdFromUsersTable() )
        ->where(function($query)
        {
            $query->where( 'patient_mobile_number' , request('search_text') )
            ->orwhere(
            [
            'patient_nationality_number' => request('search_text') ,
            'patient_first_name'         => request('search_text') ,
            'patient_last_name'          => request('search_text')
            ]) ;
        })
        ->latest('patient_id')
        ->get() ;
        /** We can use chunk(10) method here,
        For situations that we want to show 10000 result of our search
        Which chunk breaks a big result to small peaces, so we can handle Servers Ram resource **/
    }

    static function deleteThisPatientId($request_delete_this_patient_id)
    {
        return self::
        select('patient_id' , 'patient_dr_related_id')
        ->patient_id($request_delete_this_patient_id)
        ->equalThisToAdminIdFromUserTable('patient_dr_related_id')
        ->limit('1')
        ->delete();
    }

    static function updatePatientGeneralInfoLastAppointmentDataTime($choose_time_for_this_patient_id, $choose_time_for_this_date, $appointment_time)
    {
        return self::
        select( 'patient_id' , 'patient_last_appointment_date' , 'patient_last_appointment_time' , 'patient_dr_related_id' )
        ->patient_id($choose_time_for_this_patient_id)
        ->equalThisToAdminIdFromUserTable('patient_dr_related_id')
        ->limit('1')
        ->update([
                     'patient_last_appointment_date' => $choose_time_for_this_date ,
                     'patient_last_appointment_time' => $appointment_time
                 ]);
    }

    static function updateThisPatientGeneralInfoFromEhrPage($decrypted_request_patient_id, $patient_more_description, $request_validated)
    {
        return self::
        select( 'patient_dr_related_id' , 'patient_id' , 'patient_more_description' , 'patient_surgery_history' , 'patient_disease_background' , 'patient_medication_history' , 'patient_allergies_history' )
        ->equalThisToAdminIdFromUserTable('patient_dr_related_id')
        ->patient_id($decrypted_request_patient_id)
        ->limit('1')
        ->update(
        [
            'patient_more_description'   => $patient_more_description                        ,
            'patient_surgery_history'    => $request_validated['patient_surgery_history']    ,
            'patient_disease_background' => $request_validated['patient_disease_background'] ,
            'patient_medication_history' => $request_validated['patient_medication_history'] ,
            'patient_allergies_history'  => $request_validated['patient_allergies_history']  ,
        ]);
    }
}