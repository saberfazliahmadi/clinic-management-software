<?php

namespace App\Http\Controllers;

use App\Models\patients_EHR_document;
use App\Http\Requests\Storepatients_EHR_documentRequest;
use App\Http\Requests\Updatepatients_EHR_documentRequest;

// I added the below lines manually
use App\Models\patients_photo;
use App\Models\patients_general_info;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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
        try
        {
            $decrypted_request_patient_id = encrypt_decrypt('decrypt', $request->patient_id ) ;
            $encrypted_request_patient_id = $request->patient_id ;
            $result_of_patients_photo = patients_photo::result_of_patient_ehr_photo( $decrypted_request_patient_id ) ;
            $count_result_of_patients_photo = $result_of_patients_photo->count() ;

            $result_of_patients_ehr_document = patients_EHR_document::result_of_patients_ehr_document( $decrypted_request_patient_id ) ;
            $count_result_of_patients_ehr_document = $result_of_patients_ehr_document->count() ;

            $result_of_show_patients_general_infos = patients_general_info::fetch_info_of_this_patient_id( $decrypted_request_patient_id ) ;

            if(!$result_of_show_patients_general_infos)
            {
                return redirect(route('home'))
                ->with( [ 'success_message' => '<span style="color:blue;">This Patient Does Not Exist!</span>' ] );
            }
            return view('back.show_patients_ehr_document_page' ,
            [
                'title_of_page'                             => 'EHR of Patient' ,
                'EHR_document_patient_related_id'           => $encrypted_request_patient_id ,
                'EHR_document_dr_related_id'                => find_admin_id_from_users_table() ,
                'EHR_document_related_appointment_id'       => $request->related_appointment_id ,
                'EHR_document_related_clinic_doctor_name'   => $request->child_dr_related_name ,
                'result_of_patients_photo'                  => $result_of_patients_photo ,
                'count_result_of_patients_photo'            => $count_result_of_patients_photo ,
                'result_of_patients_ehr_document'           => $result_of_patients_ehr_document ,
                'count_result_of_patients_ehr_document'     => $count_result_of_patients_ehr_document ,
                'result_of_patients_general_infos'          => $result_of_show_patients_general_infos ,
                'admin_id_from_users_table'                 => find_admin_id_from_users_table()
            ]) ;
        }
        catch (\Exception $exception)
        {
            return redirect(route('home'))
            ->with( [ 'success_message' => '<span style="color:blue;">Can not display this EHR!</span>' ] );
        }
    }

    public function store_patients_ehr_document_page( Request $request )
    {
        $decrypted_request_patient_id = encrypt_decrypt('decrypt', $request->patient_id ) ;
        try
        {
            $patient_more_description  = '' ;
            $patient_more_description .= $request->patient_more_description ;

            if(is_array($request->common_hypersensitivity_2311))
            {
                foreach ($request->common_hypersensitivity_2311 as $item)
                {
                    $patient_more_description .= ','.$item;
                }
            }

            if( $request->typed_keyboard_savabegh !== "" )
            {
                $patient_more_description .= ','.$request->typed_keyboard_savabegh;
            }

            patients_general_info::update_this_patient_general_info_from_ehr_page($decrypted_request_patient_id, $patient_more_description, $request->post('patient_surgery_history'), $request->post('patient_disease_background'), $request->post('patient_medication_history'), $request->post('patient_allergies_history') ) ;

            $common_drug_2 = NULL ;
            if( Auth::user()->common_drug !== "" )
            {
                $common_drug        = Auth::user()->common_drug ;
                // Explode and make an array of this variable
                $common_drug_1      = explode(",",$common_drug) ;
                // Estimate how many drug this variable has
                $common_drug_number = count($common_drug_1) ;
                // Estimate how many drug this variable has to use of for loop
                $end                = $common_drug_number ;

                // Make a for loop to check all drugs validation
                for( $start='0' ; $start < $end ; $start++ )
                {
                    // Drug should be exist on ADMIN drug list and $request->common_drug_1[$start]
                    if( strlen($common_drug_1[$start]) > 0 && strlen($request->post($common_drug_1[$start])) > 0 )
                    {
                        $common_drug_2 .= $common_drug_1[$start].' = '.$request->post($common_drug_1[$start]) ;
                        if( $start < $end - 1 )
                        {
                            $common_drug_2 .= ',' ;
                        }
                    }
                }

                // Get keyboard_medications_picker
                if( $request->keyboard_medications_picker !== "" )
                {
                    $common_drug_2 .= $request->post('keyboard_medications_picker').','     ;
                }
            }

            $common_diet_2 = NULL ;
            if( Auth::user()->common_diet !== "" )
            {
                if(is_array($request->common_diet))
                {
                    foreach ($request->common_diet as $item)
                    {
                        $common_diet_2 .= $item.',' ;
                    }
                }

                if( $request->keyboard_common_diet !== "" )
                {
                    $common_diet_2 .= $request->post('keyboard_common_diet').',' ;
                }
            }

            $common_return_date_2 = NULL ;
            if( Auth::user()->common_return_date !== "" )
            {
                if(is_array($request->common_return_date))
                {
                    foreach ($request->common_return_date as $item)
                    {
                        $common_return_date_2 .= $item.',' ;
                    }
                }

                if( $request->keyboard_common_return_date !== "" )
                {
                    $common_return_date_2 .= $request->post('keyboard_common_return_date').',' ;
                }
            }

            $EHR_document_related_appointment_id_trick = NULL ;
            if( strlen($request->post('EHR_document_related_appointment_id')) > 0 )
            {
                $EHR_document_related_appointment_id_trick = $request->post('EHR_document_related_appointment_id') ;
            }

            $EHR_document_related_clinic_doctor_name_trick = NULL ;
            if( strlen($request->post('EHR_document_related_clinic_doctor_name')) > 0 )
            {
                $EHR_document_related_clinic_doctor_name_trick = $request->post('EHR_document_related_clinic_doctor_name') ;
            }

            $result_store_new_ehr_doc = patients_EHR_document::store_new_ehr_doc($common_drug_2, $common_diet_2, $common_return_date_2, $decrypted_request_patient_id , $EHR_document_related_appointment_id_trick, $EHR_document_related_clinic_doctor_name_trick ) ;

            if ($request->hasFile('image'))
            {
                $request->validate([
                    'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:10048',
                ]);

                $file            = $request->file('image');
                $extension       = $request->file('image')->extension();
                $fileName        = rand(11111, 99999) . time() . rand() . '.'.$extension ;
                $destinationPath = public_path() . '/storage/images/' . find_admin_id_from_users_table() . '/' . $decrypted_request_patient_id . '/para';
                $file->move($destinationPath, $fileName);
                //$path = $request->file('image')->sotre('public/images/'.Auth::user()->name.'/'.$request->patient_id.'/para' , $name );

                patients_photo::store_patient_photo_from_ehr_page($fileName, $request->keyboard_paraclinic_file_title, $decrypted_request_patient_id ) ;
            }
            if(!$result_store_new_ehr_doc)
            {
                return redirect(route('home'))
                ->with( [ 'success_message' => '<span style="color:blue;">Can not Save new EHR!</span>' ] );
            }
            return redirect(route('show_new_saved_ehr', $result_store_new_ehr_doc->EHR_document_id)) ;
        }
        catch (\Exception $exception)
        {
            return redirect(route('home'))
            ->with( [ 'success_message' => '<span style="color:blue;">Can not Save new EHR!</span>' ] );
        }
    }

    public function show_new_saved_ehr( Request $request )
    {
        try
        {
            $result_show_new_saved_ehr = patients_EHR_document::show_new_saved_ehr($request->EHR_document_id) ;

            if(!$result_show_new_saved_ehr)
            {
                return redirect(route('home'))
                ->with( [ 'success_message' => '<span style="color:blue;">Can not show new saved EHR!</span>' ] );
            }
            return view('back.show_new_saved_ehr' ,
            [
                'title_of_page'                            => 'a new EHR information of patient <br>with patient number: '.$result_show_new_saved_ehr->EHR_document_patient_related_id.'<br> successfully saved at date '.date("Y/m/d") ,
                'show_ehr_report'                          => 'true' ,
                'EHR_document_patient_related_id'          => $result_show_new_saved_ehr->EHR_document_patient_related_id ,
                'EHR_document_prescribed_common_drug'      => $result_show_new_saved_ehr->EHR_document_prescribed_common_drug ,
                'EHR_document_prescribed_common_diet'      => $result_show_new_saved_ehr->EHR_document_prescribed_common_diet ,
                'EHR_document_prescribed_next_appointment' => $result_show_new_saved_ehr->EHR_document_prescribed_next_appointment ,
                'EHR_document_related_clinic_doctor_name'  => $result_show_new_saved_ehr->EHR_document_related_clinic_doctor_name ,
                'EHR_document_dr_related_id'               => find_admin_id_from_users_table() ,
            ] ) ;
        }
        catch (\Exception $exception)
        {
            return redirect(route('home'))
            ->with( [ 'success_message' => '<span style="color:blue;">Can not show new saved EHR!</span>' ] );
        }
    }
}
