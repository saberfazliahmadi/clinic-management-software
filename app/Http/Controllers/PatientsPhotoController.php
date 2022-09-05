<?php
namespace App\Http\Controllers;

use App\Models\patients_photo;
use App\Http\Controllers\Controller;
use App\Http\Requests\Storepatients_photoRequest;
use App\Http\Requests\Updatepatients_photoRequest;
use Illuminate\Database\QueryException;

/** In this controller according to Single Responsibility and Open-Closed Principles of SOLID
we validate user inputs by Middleware **/
class PatientsPhotoController extends Controller
{
    public function PrepareKeyboardParaClinic($request_keyboard_paraclinic_file_title)
    {
        $keyboard_para_clinic_file_title_trick = NULL ;
        if( $request_keyboard_paraclinic_file_title !== '')
        {
            $keyboard_para_clinic_file_title_trick = $request_keyboard_paraclinic_file_title ;
        }
        return $keyboard_para_clinic_file_title_trick ;
    }

    public function preparation_file_process_and_upload_image($request,$request_keyboard_paraclinic_file_title ,$decrypted_request_patient_id)
    {
        $file            = $request->file('image') ;
        $extension       = $request->file('image')->extension() ;
        $fileName        = rand(11111, 99999).time().rand().'.'.$extension ;
        $destinationPath = public_path().'/storage/images/'.find_admin_id_from_users_table().'/'.$decrypted_request_patient_id.'/para';
        $file->move($destinationPath, $fileName) ;
        //$path = $request->file('image')->sotre('public/images/'.Auth::user()->name.'/'.$request->patient_id.'/para' , $name );
        $keyboard_para_clinic_file_title_trick = $this->PrepareKeyboardParaClinic($request_keyboard_paraclinic_file_title) ;

        return patients_photo::store_patient_photo_from_ehr_page($fileName, $keyboard_para_clinic_file_title_trick , $decrypted_request_patient_id);
    }
}