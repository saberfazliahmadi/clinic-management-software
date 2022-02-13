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
}
