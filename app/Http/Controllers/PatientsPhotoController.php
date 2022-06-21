<?php

namespace App\Http\Controllers;

use App\Models\patients_photo;
use App\Http\Controllers\Controller;
use App\Http\Requests\Storepatients_photoRequest;
use App\Http\Requests\Updatepatients_photoRequest;

class PatientsPhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Storepatients_photoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Storepatients_photoRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\patients_photo  $patients_photo
     * @return \Illuminate\Http\Response
     */
    public function show(patients_photo $patients_photo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\patients_photo  $patients_photo
     * @return \Illuminate\Http\Response
     */
    public function edit(patients_photo $patients_photo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updatepatients_photoRequest  $request
     * @param  \App\Models\patients_photo  $patients_photo
     * @return \Illuminate\Http\Response
     */
    public function update(Updatepatients_photoRequest $request, patients_photo $patients_photo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\patients_photo  $patients_photo
     * @return \Illuminate\Http\Response
     */
    public function destroy(patients_photo $patients_photo)
    {
        //
    }

    static function preparation_file_process_and_upload_image($request,$request_keyboard_paraclinic_file_title ,$decrypted_request_patient_id)
    {
        $file            = $request->file('image') ;
        $extension       = $request->file('image')->extension() ;
        $fileName        = rand(11111, 99999).time().rand().'.'.$extension ;
        $destinationPath = public_path().'/storage/images/'.find_admin_id_from_users_table().'/'.$decrypted_request_patient_id.'/para';
        $file->move($destinationPath, $fileName) ;
        //$path = $request->file('image')->sotre('public/images/'.Auth::user()->name.'/'.$request->patient_id.'/para' , $name );

        $keyboard_paraclinic_file_title_trick = NULL ;
        if( $request_keyboard_paraclinic_file_title !== '')
        {
            $keyboard_paraclinic_file_title_trick = $request_keyboard_paraclinic_file_title ;
        }

        $store_patient_photo_from_ehr_page = patients_photo::store_patient_photo_from_ehr_page($fileName, $keyboard_paraclinic_file_title_trick , $decrypted_request_patient_id);

        return $store_patient_photo_from_ehr_page ;
    }
}
