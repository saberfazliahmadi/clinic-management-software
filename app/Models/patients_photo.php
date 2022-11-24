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

    public function scopeequalThisToAdminIdFromUserTable($query, $equal_this)
    {
        return $query->where($equal_this, findAdminIdFromUsersTable()) ;
    }

    static function resultOfPatientEhrPhoto($request_patient_id)
    {
        return self::
        equalThisToAdminIdFromUserTable('patients_photos_dr_related_id')
        ->where( 'patients_photos_patient_related_id' , $request_patient_id )
        ->latest('patients_photos_id')
        ->get() ;
    }

    static function store_patient_photo_from_ehr_page($fileName, $request_keyboard_paraclinic_file_title, $request_patient_id )
    {
        return self::create(
            [
                'patients_photos_file_name'          => $fileName,
                'patients_photos_file_description'   => $request_keyboard_paraclinic_file_title,
                'patients_photos_patient_related_id' => $request_patient_id,
                'patients_photos_dr_related_id'      => findAdminIdFromUsersTable()
            ]
        );
    }

}