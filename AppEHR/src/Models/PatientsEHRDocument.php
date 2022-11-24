<?php
namespace AppEHR\Models;

use AppEHR\Database\Factories\PatientsEHRDocumentFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PatientsEHRDocument extends Model
{
    use SoftDeletes , HasFactory ;

    protected $primaryKey = 'EHR_document_id' ;

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

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return new PatientsEHRDocumentFactory() ;
    }

    public function scopeequalThisToAdminIdFromUserTable($query, $equal_this)
    {
        return $query->where($equal_this, findAdminIdFromUsersTable()) ;
    }

    public function getEHRDocumentPrescribedCommonDrugAttribute($value)
    {
        if($value !== NULL)
        {
            return encryptDecrypt('decrypt', $value ) ;
        }
    }

    public function setEHRDocumentPrescribedCommonDrugAttribute($value)
    {
        if($value !== NULL)
        {
            $this->attributes['EHR_document_prescribed_common_drug'] = encryptDecrypt('encrypt', $value ) ;
        }
    }

    public function getEHRDocumentPrescribedCommonDietAttribute($value)
    {
        if($value !== NULL)
        {
            return encryptDecrypt('decrypt', $value ) ;
        }
    }

    public function setEHRDocumentPrescribedCommonDietAttribute($value)
    {
        if($value !== NULL)
        {
            $this->attributes['EHR_document_prescribed_common_diet'] = encryptDecrypt('encrypt', $value ) ;
        }
    }

    static function resultOfPatientsEhrDocument($request_patient_id)
    {
        return self::
        equalThisToAdminIdFromUserTable('EHR_document_dr_related_id')
        ->where('EHR_document_patient_related_id' , $request_patient_id )
        ->latest('EHR_document_id')
        ->get() ;
    }

    static function storeNewEhrDoc($common_drug_2, $common_diet_2, $common_return_date_2, $request_post_patient_id , $EHR_document_related_appointment_id_trick, $EHR_document_related_clinic_doctor_name_trick )
    {
        return self::create(
            [
                'EHR_document_prescribed_common_drug'      => $common_drug_2 ,
                'EHR_document_prescribed_common_diet'      => $common_diet_2 ,
                'EHR_document_prescribed_next_appointment' => $common_return_date_2 ,
                'EHR_document_patient_related_id'          => $request_post_patient_id ,
                'EHR_document_dr_related_id'               => findAdminIdFromUsersTable() ,
                'EHR_document_related_appointment_id'      => $EHR_document_related_appointment_id_trick ,
                'EHR_document_related_clinic_doctor_name'  => $EHR_document_related_clinic_doctor_name_trick
            ]
        ) ;
    }

    static function showNewSavedEhr($request_EHR_document_id)
    {
        return self::
        equalThisToAdminIdFromUserTable('EHR_document_dr_related_id')
        ->where('EHR_document_id' , $request_EHR_document_id )
        ->limit('1')
        ->first() ;
    }

    public static function checkValidityOfEHRID($decrypted_requested_EHR_id)
    {
        return self::
        select('EHR_document_dr_related_id' , 'EHR_document_id')
        ->equalThisToAdminIdFromUserTable('EHR_document_dr_related_id')
        ->where('EHR_document_id' , $decrypted_requested_EHR_id )
        ->limit('1')
        ->first() ;
    }
}