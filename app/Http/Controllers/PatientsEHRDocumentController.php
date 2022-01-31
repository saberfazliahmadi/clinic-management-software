<?php

namespace App\Http\Controllers;

use App\Models\patients_EHR_document;
use App\Http\Requests\Storepatients_EHR_documentRequest;
use App\Http\Requests\Updatepatients_EHR_documentRequest;

// I added the below lines manually
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
// START OF MANUALLY RECEIVING DATA FROM A FORM BY GET OR POST METHOD AND USE IT IN YOUR CUSTOMIZE FUNCTIONS.
// https://stackoverflow.com/questions/32718870/how-to-get-all-input-of-post-in-laravel
// step(1) add this use to top of your controller page after the name space.
// use Illuminate\Http\Request ;
// step(2) write your function with this structure
//    public function function_name( Request $request )
//    {
//        //
//    }
// step(3) use below codes in it.
//// Show only POST data
//$request->post(); // DI
//request()->post(); // global method
//Request::post(); // facade
//
//// Show only GET data
//$request->query(); // DI
//request()->query(); // global method
//Request::query(); // facade
//
//// Show all data (i.e. both GET and POST data)
//$request->all(); // DI
//request()->all(); // global method
//Request::all(); // facade
// END OF MANUALLY RECEIVING DATA FROM A FORM BY GET OR POST METHOD AND USE IT IN YOUR CUSTOMIZE FUNCTIONS.

class PatientsEHRDocumentController extends Controller
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
     * @param  \App\Http\Requests\Storepatients_EHR_documentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Storepatients_EHR_documentRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\patients_EHR_document  $patients_EHR_document
     * @return \Illuminate\Http\Response
     */
    public function show(patients_EHR_document $patients_EHR_document)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\patients_EHR_document  $patients_EHR_document
     * @return \Illuminate\Http\Response
     */
    public function edit(patients_EHR_document $patients_EHR_document)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updatepatients_EHR_documentRequest  $request
     * @param  \App\Models\patients_EHR_document  $patients_EHR_document
     * @return \Illuminate\Http\Response
     */
    public function update(Updatepatients_EHR_documentRequest $request, patients_EHR_document $patients_EHR_document)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\patients_EHR_document  $patients_EHR_document
     * @return \Illuminate\Http\Response
     */
    public function destroy(patients_EHR_document $patients_EHR_document)
    {
        //
    }

    public function show_patients_ehr_document_page( Request $request )
    {
        $result_of_show_patients_ehr_document_page = patients_EHR_document::
        select('*')
        ->where('EHR_document_patient_related_id' , '=' , 'free' )
        ->get() ;

        return view('back.show_patients_ehr_document_page' ,
        [
            'title_of_page'                             => 'EHR' ,
            'EHR_document_patient_related_id'           => 'free_patient_related_id' ,
            'EHR_document_dr_related_id'                => Auth::user()->id ,
            'EHR_document_related_appointment_id'       => 'free_appointment_id' ,
            'EHR_document_related_clinic_doctor_name'   => 'free_related_clinic_doctor_name' ,
            'result_of_show_patients_ehr_document_page' => $result_of_show_patients_ehr_document_page
        ]) ;
    }
}
