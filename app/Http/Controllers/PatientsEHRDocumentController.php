<?php

namespace App\Http\Controllers;

use App\Models\patients_EHR_document;
use App\Http\Requests\Storepatients_EHR_documentRequest;
use App\Http\Requests\Updatepatients_EHR_documentRequest;

// I added the below lines manually
use Illuminate\Support\Facades\Auth;
use App\Models\patients_photo;
use App\Models\patients_general_info;

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
    public function find_admin_id_from_users_table()
    {
        // If the user has a parent_id so user_type='user' and we use Auth::user()->parent_id
        if( strlen(Auth::user()->parent_id) > 0 )
        {
            return $admin_id_from_users_table = Auth::user()->parent_id ;
        }
        // If the user DOES NOT have parent_id so user_type='admin' and we use Auth::user()->id
        else
        {
            return $admin_id_from_users_table = Auth::user()->id ;
        }
    }

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
        try
        {
            $admin_id_from_users_table = $this->find_admin_id_from_users_table() ;

            $result_of_patients_photo = patients_photo::
            where('patients_photos_dr_related_id'        , '=' , $admin_id_from_users_table )
            ->where('patients_photos_patient_related_id' , '=' , $request->patient_id )
            ->orderBy('patients_photos_id', 'DESC')
            ->get() ;
            $count_result_of_patients_photo = $result_of_patients_photo->count() ;

            $result_of_patients_ehr_document = patients_EHR_document::
            where('EHR_document_dr_related_id'        , '=' , $admin_id_from_users_table )
            ->where('EHR_document_patient_related_id' , '=' , $request->patient_id )
            ->orderBy('EHR_document_id', 'DESC')
            ->get() ;
            $count_result_of_patients_ehr_document = $result_of_patients_ehr_document->count() ;

            $result_of_show_patients_general_infos = patients_general_info::
            ->where('patient_dr_related_id' , '=' , $admin_id_from_users_table )
            ->where('patient_id' , '=' , $request->patient_id )
            ->get() ;
            $count_number_of_patients_general_infos = $result_of_show_patients_general_infos->count() ;

            if( $count_number_of_patients_general_infos > 0 )
            {
                return view('back.show_patients_ehr_document_page' ,
                [
                    'title_of_page'                             => 'EHR of '.$request->patient_id ,
                    'EHR_document_patient_related_id'           => $request->patient_id ,
                    'EHR_document_dr_related_id'                => $admin_id_from_users_table ,
                    'EHR_document_related_appointment_id'       => 'free_appointment_id' ,
                    'EHR_document_related_clinic_doctor_name'   => 'free_related_clinic_doctor_name' ,
                    'result_of_patients_photo'                  => $result_of_patients_photo ,
                    'count_result_of_patients_photo'            => $count_result_of_patients_photo ,
                    'result_of_patients_ehr_document'           => $result_of_patients_ehr_document ,
                    'count_result_of_patients_ehr_document'     => $count_result_of_patients_ehr_document ,
                    'result_of_show_patients_general_infos'     => $result_of_show_patients_general_infos ,
                    'count_number_of_patients_general_infos'    => $count_number_of_patients_general_infos
                ]) ;
            }
            else
            {
                \Session::flash('success_message', '<span style="color:blue;">This Patient Does Not Exist!</span>');
                return redirect(route('home'));
            }

        }
        catch (\Exception $exception)
        {
            \Session::flash('success_message', '<span style="color:blue;">Can not display this EHR!</span>');
            return redirect(route('home'));
        }
    }

    public function store_patients_ehr_document_page( Request $request )
    {
        $admin_id_from_users_table = $this->find_admin_id_from_users_table() ;

        if($request->hasFile('image'))
        {
            $validatedData = $request->validate([
                'image' => 'image|mimes:jpg|max:2048',
            ]);

            $file            = $request->file('image') ;
            $fileName        = rand(11111, 99999).time().rand().'.jpg' ;
            $destinationPath = public_path().'/images/'.Auth::user()->name.'/'.$request->patient_id.'/para' ;
            $file->move($destinationPath, $fileName);
            //$path = $request->file('image')->sotre('public/images/'.Auth::user()->name.'/'.$request->patient_id.'/para' , $name );

            $result_store_patient_photo = new patients_photo(
            [
                'patients_photos_file_name' => $fileName,
                'patients_photos_file_description' => $request->keyboard_paraclinic_file_title,
                'patients_photos_patient_related_id' => $request->patient_id,
                'patients_photos_dr_related_id' => $admin_id_from_users_table
            ]
            );
            $result_store_patient_photo->save();
        }

        \Session::flash('success_message', 'EHR information of Patient Successfully Saved');
        return redirect(route('home'));
        //return redirect('upload-image')->with('status', 'Image Has been uploaded');
    }
}
