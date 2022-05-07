<?php

namespace App\Models;

use Database\Factories\PatientsPhotoFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class patients_photo extends Model
{
    use SoftDeletes , HasFactory ;
    protected $primaryKey = 'patients_photos_id' ;
    protected $fillable = [
        'patients_photos_file_name' ,
        'patients_photos_file_description' ,
        'patients_photos_patient_related_id' ,
        'patients_photos_dr_related_id'
    ] ;

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return new PatientsPhotoFactory() ;
    }

    static function result_of_patient_ehr_photo($request_patient_id)
    {
        $result_of_patients_photo = self::
        equal_this_to_admin_id_from_user_table('patients_photos_dr_related_id')
        ->where('patients_photos_patient_related_id' , $request_patient_id )
        ->latest('patients_photos_id')
        ->get() ;

        return $result_of_patients_photo ;
    }

    static function store_patient_photo_from_ehr_page($fileName, $request_keyboard_paraclinic_file_title, $request_patient_id )
    {
        $result_store_patient_photo_from_ehr_page = self::create(
            [
                'patients_photos_file_name'          => $fileName,
                'patients_photos_file_description'   => $request_keyboard_paraclinic_file_title,
                'patients_photos_patient_related_id' => $request_patient_id,
                'patients_photos_dr_related_id'      => find_admin_id_from_users_table()
            ]
        );
    }

}
