<?php

namespace App\Http\Controllers;

use App\Models\patients_general_info;
use App\Http\Requests\Storepatients_general_infoRequest;
use App\Http\Requests\Updatepatients_general_infoRequest;

// I added the below lines manually.
use App\Models\patients_appointment;
use Illuminate\Routing\Route;
use Illuminate\Http\Request;

class PatientsGeneralInfoController extends Controller
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
        try
        {
            $number_of_total_clinic_patients = patients_general_info::number_of_total_clinic_patients() ;

            $title_of_page = 'Submit a New Patient';
            return view('back.submit_new_patient_form' ,
            [
                'title_of_page'                   => $title_of_page ,
                'number_of_total_clinic_patients' => $number_of_total_clinic_patients
            ] );
        }
        catch (\Exception $exception)
        {
            return redirect(route('home')->with(['success_message' => 'We have an error to show make a new patient form']) ) ;
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\Storepatients_general_infoRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(Storepatients_general_infoRequest $request)
    {
        // Check for mobile number duplication
        // WE SHOULD NOT HAVE TWO PATIENTS WITH SAME MOBILE NUMBERS IN OUR DATABASE!
        // The mobile numbers should be unique
        $number_of_duplicate_mobile_number = patients_general_info::number_of_duplicate_mobile_number(null , $request->post('patient_mobile_number')) ;

        // START of If the mobile number of patient was unique then store its information
        if ( $number_of_duplicate_mobile_number == '0' )
        {
            $request->validate(
                [
                    'patient_first_name'    => 'required|min:3' ,
                    'patient_last_name'     => 'required|min:3' ,
                    'patient_mobile_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:8' ,
                ]
            ) ;

            try
            {
                $result_store_new_patient_form = patients_general_info::store_new_patient_form($request->all()) ;

                // Specify last id created in database to use it in route passing data
                $choose_time_for_this_patient_id = $result_store_new_patient_form->patient_id ;

                // If this patient has a date appointment then redirect him to route('show_patient_time_appointment_table') to select desired time for this appointment
                if( strlen($request->get('patient_last_appointment_date')) > 0 )
                {
                    return redirect(route('show_patient_time_appointment_table', [ 'choose_time_for_this_date' => $request->get('patient_last_appointment_date') , 'choose_time_for_this_patient_id' => $choose_time_for_this_patient_id ] ))
                    ->with(['success_message' => 'Your New Patient with Name <br><a href="'.route('edit_patient_form', $choose_time_for_this_patient_id ).'" ><b>'.$request->get('patient_first_name').' ' . $request->get('patient_last_name').'</b></a> Successfully Submitted <br>Now choose an appointment time on date '.$request->get('patient_last_appointment_date') ]);
                }
                // If this patient DOES NOT have a date appointment then redirect him to route('submit_new_patient_form')
                else
                {
                    return redirect(route('submit_new_patient_form'))
                    ->with(['success_message' => 'Your New Patient with Name <br><a href="'.route('edit_patient_form', $choose_time_for_this_patient_id ).'" ><b>'.$request->get('patient_first_name').' ' . $request->get('patient_last_name').'</b></a> Successfully Submitted']) ;
                }
            }
            catch (\Exception $exception)
            {
                return redirect(route('submit_new_patient_form'))
                ->with(['success_message' => '<span style="color:blue;">Your New Patient Was NOT Successfully Submitted!</span>']);
            }
        }
        // END of If the mobile number of patient was unique then store its information
        else
        {
            return redirect(route('submit_new_patient_form'))
            ->with(['success_message' => '<b style="color:blue;" >The Mobile Number Should be Unique <br>But, There is another Mobile Number Like ' . $request->get('patient_mobile_number') . ' in Database,</b> <br> So Your New Patient Was NOT Submitted! <br> Try a Unique Mobile Number Again']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\patients_general_info $patients_general_info
     * @return \Illuminate\Http\Response
     */
    public function show( patients_general_info $patients_general_info )
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\patients_general_info $patients_general_info
     * @return \Illuminate\Http\Response
     */
    public function edit(patients_general_info $patients_general_info , $edit_this_patient_id )
    {
        try
        {
            $result_edit_patient_form = patients_general_info::fetch_info_of_this_patient_id($edit_this_patient_id) ;

            if($result_edit_patient_form)
            {
                $number_of_total_clinic_patients = patients_general_info::number_of_total_clinic_patients() ;
                $result_show_all_appointments_of_this_id = patients_appointment::result_show_all_appointments_of_this_id($edit_this_patient_id) ;

                $title_of_page = 'Edit Patient Information' ;
                return view('back.submit_new_patient_form' ,
                [
                    'title_of_page'                           => $title_of_page ,
                    'result_edit_patient_form'                => $result_edit_patient_form ,
                    'result_show_all_appointments_of_this_id' => $result_show_all_appointments_of_this_id ,
                    'number_of_total_clinic_patients'         => $number_of_total_clinic_patients
                ] ) ;
            }
            else
            {
                return redirect(route('home'))
                ->with( ['success_message' => '<span style="color:blue;font-weight:bolder;">The requested patient is not exist</span>']) ;
            }
        }
        catch ( \Exception $exception )
        {
            return redirect(route('home'))
            ->with(['success_message' => '<span style="color:blue;font-weight:bolder;">We have an error to show this patient information</span>']) ;
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\Updatepatients_general_infoRequest $request
     * @param \App\Models\patients_general_info $patients_general_info
     * @return \Illuminate\Http\Response
     */
    public function update(Updatepatients_general_infoRequest $request, patients_general_info $patients_general_info , $update_this_patient_id )
    {
        $request_patient_mobile_number = $request->post('patient_mobile_number') ;
        // Check for mobile number duplication
        // WE SHOULD NOT HAVE TWO PATIENTS WITH SAME MOBILE NUMBERS IN OUR DATABASE!
        // The mobile numbers should be unique
        $number_of_duplicate_mobile_number = patients_general_info::number_of_duplicate_mobile_number($update_this_patient_id , $request_patient_mobile_number) ;

        // START of If the mobile number of patient was unique.
        if ( $number_of_duplicate_mobile_number == '0' )
        {
            $request->validate(
                [
                    'patient_first_name'    => 'required|min:3' ,
                    'patient_last_name'     => 'required|min:3' ,
                    'patient_mobile_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:8'
                ]
            );

            try
            {
                $request_all = $request->all() ;
                $result_update_this_patient_id = patients_general_info::result_update_this_patient_id($update_this_patient_id,$request_all) ;

                if($result_update_this_patient_id)
                {
                    return redirect(route('edit_patient_form', $update_this_patient_id))
                    ->with(['success_message' => '<b>' . $request->post('patient_first_name') . ' ' . $request->post('patient_last_name') . '</b> Information Successfully Updated' ]) ;
                }
                else
                {
                    return redirect(route('edit_patient_form', $update_this_patient_id))
                    ->with(['success_message' => '<span style="color:blue;font-weight:bolder;">' . $request->post('patient_first_name') . ' ' . $request->post('patient_last_name') . ' Information WAS NOT Updated</span>']) ;
                }
            }
            catch (\Exception $exception)
            {
                return redirect(route('edit_patient_form', $update_this_patient_id))
                ->with(['success_message' => '<span style="color:blue;font-weight:bolder;">' . $request->post('patient_first_name') . ' ' . $request->post('patient_last_name') . ' Information WAS NOT Updated</span>']) ;
            }
        } // END of If the Mobile Number was not unique
        else
        {
            return redirect(route('edit_patient_form', $update_this_patient_id))
            ->with([ 'success_message' => 'The Mobile Number Should be Unique <br>But, There is another Mobile Number Like ' . $request->get('patient_mobile_number') . ' in Database, <br><span style="color:blue;font-weight:bolder;" > So Your New Patient Was NOT Submitted! </span><br> Try a Unique Mobile Number' ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\patients_general_info $patients_general_info
     * @return \Illuminate\Http\Response
     */
    public function destroy(patients_general_info $patients_general_info , Request $request)
    {
        try
        {
            $result_delete_this_patient_id = patients_general_info::delete_this_patient_id($request->delete_this_patient_id) ;

            if($result_delete_this_patient_id)
            {
                return redirect(route('submit_new_patient_form'))
                ->with(['success_message' => 'The requested patient Number: '.$request->delete_this_patient_id.' successfully deleted']);
            }
            else
            {
                return redirect(route('submit_new_patient_form'))
                ->with(['success_message' => 'We have an error to delete this patient Number: <b style="color:blue;" >'.$request->delete_this_patient_id.'</b><br> Maybe there is an appointment or a financial transaction related to this patient,<br> So if you want to delete this patient<br> at first, you need to delete all appointments and financial transactions related to him']);
            }
        }
        catch (\Exception $exception)
        {
            return redirect()->back()
            ->with(['success_message' => 'We have an error to delete this patient Number: <b style="color:blue;" >'.$request->delete_this_patient_id.'</b><br> Maybe there is an appointment or a financial transaction related to this patient,<br> So if you want to delete this patient<br> at first, you need to delete all appointments and financial transactions related to him']);
        }
    }

    public function show_patient_search_from()
    {
        $title_of_page = 'Search Patients' ;
        return view('back.show_patient_search_from' , ['title_of_page' => $title_of_page] );
    }

    public function run_patient_search_form( Request $request )
    {
        // If the searched key word has more than 0 character
        if( request()->post('search_text') !== '')
        {
            try
            {
                $result_of_run_search_form = patients_general_info::fetch_result_of_search_from() ;

                // If there are more than 1 result in database
                if( $result_of_run_search_form->count() > 0 )
                {
                    \Session::flash('success_message', '<b>'.$result_of_run_search_form->count().'</b> results found for <b>"'.request()->post('search_text').'"</b></b>' ) ;
                    $title_of_page = 'Search Patients' ;

                    return view('back.show_patient_search_from',
                    [ 'title_of_page'          => $title_of_page ,
                      'result_run_search_form' => $result_of_run_search_form
                    ] )->with(['success_message' => '']) ;
                }
                // If there is not ANY result in database.
                else
                {
                    return redirect(route('show_patient_search_from'))
                    ->with([ 'success_message' => 'There is not any result for <b style="color:blue;" >'.request()->post('search_text').'</b>' ] );
                }
            }
            catch (\Excebackption $exception)
            {
                return redirect(route('show_patient_search_from'))
                ->with(['success_message' => 'We have an error to search for this word <b style="color:blue;" >'.request()->post('search_text').'</b>']);
            }
        }
        // If the search key word is more than 1 character.
        else
        {
            return redirect(route('show_patient_search_from'))
            ->with(['success_message' => '<span style="color:blue;" > The word you entered to search the patient must be more than 1 letters </span> <br>Suggestion: You can search based on the patient\'s mobile number,<br> <span style="font-weight:bolder;" > which should be more than 1 letters</span> <br>Please re-enter the correct type of information and press the Search button again' ]);
        }
    }
}
