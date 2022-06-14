<?php

namespace App\Models;

use Database\Factories\PatientsEHRDocumentFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class patients_EHR_document extends Model
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

    public function getEHRDocumentPrescribedCommonDrugAttribute($value)
    {
        if($value !== NULL)
        {
            return encrypt_decrypt('decrypt', $value ) ;
        }
    }

    public function setEHRDocumentPrescribedCommonDrugAttribute($value)
    {
        if($value !== NULL)
        {
            $this->attributes['EHR_document_prescribed_common_drug'] = encrypt_decrypt('encrypt', $value ) ;
        }
    }

    public function getEHRDocumentPrescribedCommonDietAttribute($value)
    {
        if($value !== NULL)
        {
            return encrypt_decrypt('decrypt', $value ) ;
        }
    }

    public function setEHRDocumentPrescribedCommonDietAttribute($value)
    {
        if($value !== NULL)
        {
            $this->attributes['EHR_document_prescribed_common_diet'] = encrypt_decrypt('encrypt', $value ) ;
        }
    }

    static function result_of_patients_ehr_document($request_patient_id)
    {
        $result_of_patients_ehr_document = self::
        equal_this_to_admin_id_from_user_table('EHR_document_dr_related_id')
        ->where('EHR_document_patient_related_id' , $request_patient_id )
        ->latest('EHR_document_id')
        ->get() ;
        return $result_of_patients_ehr_document ;
    }

    static function store_new_ehr_doc($common_drug_2, $common_diet_2, $common_return_date_2, $request_post_patient_id , $EHR_document_related_appointment_id_trick, $EHR_document_related_clinic_doctor_name_trick )
    {
        $result_store_new_ehr_doc = self::create(
            [
                'EHR_document_prescribed_common_drug'      => $common_drug_2 ,
                'EHR_document_prescribed_common_diet'      => $common_diet_2 ,
                'EHR_document_prescribed_next_appointment' => $common_return_date_2 ,
                'EHR_document_patient_related_id'          => $request_post_patient_id ,
                'EHR_document_dr_related_id'               => find_admin_id_from_users_table() ,
                'EHR_document_related_appointment_id'      => $EHR_document_related_appointment_id_trick ,
                'EHR_document_related_clinic_doctor_name'  => $EHR_document_related_clinic_doctor_name_trick
            ]
        ) ;
        return $result_store_new_ehr_doc ;
    }

    static function show_new_saved_ehr($request_EHR_document_id)
    {
        $result_show_new_saved_ehr = self::
        equal_this_to_admin_id_from_user_table('EHR_document_dr_related_id')
        ->where('EHR_document_id' , $request_EHR_document_id )
        ->limit('1')
        ->first() ;
        return $result_show_new_saved_ehr ;
    }
}
