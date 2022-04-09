<?php

namespace App\Models;

use Database\Factories\PatientsPhotoFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class patients_photo extends Model
{

    protected $fillable = [
        'patients_photos_file_name' ,
        'patients_photos_file_description' ,
        'patients_photos_patient_related_id' ,
        'patients_photos_dr_related_id'
    ] ;

    use HasFactory;

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return new PatientsPhotoFactory() ;
    }

}
