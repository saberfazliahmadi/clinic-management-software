<?php

namespace App\Http\Controllers;

use App\Models\patients_general_info;
use App\Http\Requests\Storepatients_general_infoRequest;
use App\Http\Requests\Updatepatients_general_infoRequest;

// I added this model to this page manually.
use App\Models\patients_appointment;
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

class PatientsGeneralInfoController extends Controller
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
        $title_of_page = 'Submit a New Patient';
        return view('back.submit_new_patient_form', ['title_of_page' => $title_of_page]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\Storepatients_general_infoRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(Storepatients_general_infoRequest $request)
    {
        $admin_id_from_users_table = $this->find_admin_id_from_users_table() ;

        // Check for mobile number duplication.
        $number_of_duplicate_mobile_number = patients_general_info::
                                             select('patient_mobile_number')
                                             ->where('patient_mobile_number', '=', $request->patient_mobile_number)
                                             ->where('patient_dr_related_id', '=', $admin_id_from_users_table)
                                             ->count();

        // START of If the mobile number of patient was unique.
        if ( $number_of_duplicate_mobile_number == '0' )
        {
            $validation_of_new_patient_form = $request->validate(
                [
                    'patient_first_name' => 'required|min:3' ,
                    'patient_last_name' => 'required|min:3' ,
                    'patient_mobile_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:8' ,
                ]
            ) ;

            try
            {
                $result_store_new_patient_form = new patients_general_info(
                    [
                        'patient_dr_related_id' => $admin_id_from_users_table ,
                        'patient_first_name' => $request->get('patient_first_name'),
                        'patient_last_name' => $request->get('patient_last_name'),
                        'patient_mobile_number' => $request->get('patient_mobile_number'),
                        'patient_nationality_number' => $request->get('patient_nationality_number'),
                        'patient_last_appointment_date' => $request->get('patient_last_appointment_date'),
                        'patient_birth_day' => $request->get('patient_birth_day'),
                        'patient_address' => $request->get('patient_address'),
                        'patient_phone_number' => $request->get('patient_phone_number'),
                        'patient_email_address' => $request->get('patient_email_address'),
                        'patient_relationship_status' => $request->get('patient_relationship_status'),
                        'patient_gender' => $request->get('patient_gender'),
                        'patient_surgery_history' => $request->get('patient_surgery_history'),
                        'patient_disease_background' => $request->get('patient_disease_background'),
                        'patient_medication_history' => $request->get('patient_medication_history'),
                        'patient_allergies_history' => $request->get('patient_allergies_history'),
                        'patient_more_description' => $request->get('patient_more_description')
                    ]
                );

                $result_store_new_patient_form->save();

                // Specify last id created here to use in route passing data
                $choose_time_for_this_patient_id = $result_store_new_patient_form->id ;

                // If this patient has a date appointment then redirect him to route('patient_time_appointment_table') to select the free time for this appointment
                if( strlen($request->get('patient_last_appointment_date')) > 0 )
                {
                    $patient_last_appointment_date = $request->get('patient_last_appointment_date') ;
                    \Session::flash('success_message', 'Your New Patient with Name <br><a href="'.route('edit_patient_form', $choose_time_for_this_patient_id ).'" ><b>'.$request->get('patient_first_name').' ' . $request->get('patient_last_name').'</b></a> Successfully Submitted <br>Now choose an appointment time on date '.$patient_last_appointment_date );
                    return redirect(route('show_patient_time_appointment_table', [ 'choose_time_for_this_date' => $request->get('patient_last_appointment_date') , 'choose_time_for_this_patient_id' => $choose_time_for_this_patient_id ] )) ;
                }
                // If this patient DOES NOT have a date appointment then redirect him to route('edit_patient_form')
                else
                {
                    \Session::flash('success_message', 'Your New Patient with Name <br><a href="'.route('edit_patient_form', $choose_time_for_this_patient_id ).'" ><b>'.$request->get('patient_first_name').' ' . $request->get('patient_last_name').'</b></a> Successfully Submitted');
                    return redirect(route('submit_new_patient_form'));
                }
            }
            catch (\Exception $exception)
            {
                \Session::flash('success_message', '<span style="color:blue;">Your New Patient Was NOT Successfully Submitted!</span>');
                return redirect(route('submit_new_patient_form'));
            }
        }
        // END of If the Mobile Number was unique.
        else
        {
            \Session::flash('success_message', '<b style="color:blue;" >The Mobile Number Should be Unique <br>But, There is another Mobile Number Like ' . $request->get('patient_mobile_number') . ' in Database,</b> <br> So Your New Patient Was NOT Submitted! <br> Try a Unique Mobile Number Again');
            return redirect(route('submit_new_patient_form'));
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
        $admin_id_from_users_table = $this->find_admin_id_from_users_table() ;
        try
        {
            $result_edit_patient_form = patients_general_info::
            select('*')
            ->where('patient_id' , '=' , $edit_this_patient_id)
            ->where('patient_dr_related_id', '=', $admin_id_from_users_table)
            ->get() ;

            $result_show_all_appointments_of_this_id = patients_appointment::
            select('*')
            ->where('appointment_patient_related_id' , '=' , $edit_this_patient_id)
            ->where('appointment_dr_related_id', '=', $admin_id_from_users_table)
            ->orderBy('appointment_id', 'desc')
            ->get() ;

            if( $result_edit_patient_form->count() > 0 )
            {
                $title_of_page = 'Edit Patient Information' ;
                return view('back.submit_new_patient_form' , [ 'title_of_page' => $title_of_page , 'result_edit_patient_form' => $result_edit_patient_form , 'result_show_all_appointments_of_this_id' => $result_show_all_appointments_of_this_id ] ) ;
            }
            else
            {
                \Session::flash('success_message', '<span style="color:blue;font-weight:bolder;">The requested patient is not exist</span>');
                return redirect(route('home')) ;
            }

        }
        catch ( \Exception $exception )
        {
            \Session::flash('success_message', '<span style="color:blue;font-weight:bolder;">We have an error to show this patient information</span>');
            return redirect(route('home')) ;
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
        $admin_id_from_users_table = $this->find_admin_id_from_users_table() ;

        // Check for mobile number duplication.
        // EXCEPT condition ( patient_id != $update_this_patient_id)
        $number_of_duplicate_mobile_number = patients_general_info::
                                            select('patient_mobile_number' , 'patient_id')
                                            ->where('patient_mobile_number', '=', $request->post('patient_mobile_number') )
                                            ->where('patient_dr_related_id', '=', $admin_id_from_users_table)
                                            ->where('patient_id', '!=', $update_this_patient_id )
                                            ->count();

        // START of If the mobile number of patient was unique.
        if ( $number_of_duplicate_mobile_number == '0' )
        {
            $validation_of_update_this_patient_id = $request->validate(
                [
                    'patient_first_name' => 'required|min:3',
                    'patient_last_name' => 'required|min:3',
                    'patient_mobile_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:8'
                ]
            );

            try
            {
                $result_update_this_patient_id = patients_general_info::
                select('*')
                ->where('patient_id', '=', $update_this_patient_id)
                ->where('patient_dr_related_id', '=', $admin_id_from_users_table)
                ->update([
                    'patient_first_name' => $request->post('patient_first_name'),
                    'patient_last_name' => $request->post('patient_last_name'),
                    'patient_mobile_number' => $request->post('patient_mobile_number'),
                    'patient_nationality_number' => $request->post('patient_nationality_number'),
                    'patient_last_appointment_date' => $request->post('patient_last_appointment_date'),
                    'patient_birth_day' => $request->post('patient_birth_day'),
                    'patient_address' => $request->post('patient_address'),
                    'patient_phone_number' => $request->post('patient_phone_number'),
                    'patient_email_address' => $request->post('patient_email_address'),
                    'patient_relationship_status' => $request->post('patient_relationship_status'),
                    'patient_gender' => $request->post('patient_gender'),
                    'patient_surgery_history' => $request->post('patient_surgery_history'),
                    'patient_disease_background' => $request->post('patient_disease_background'),
                    'patient_medication_history' => $request->post('patient_medication_history'),
                    'patient_allergies_history' => $request->post('patient_allergies_history'),
                    'patient_more_description' => $request->post('patient_more_description')
                ]);

                \Session::flash('success_message', '<b>' . $request->post('patient_first_name') . ' ' . $request->post('patient_last_name') . '</b> Information Successfully Updated');
                return redirect(route('edit_patient_form', $update_this_patient_id)) ;

            }
            catch (\Exception $exception)
            {
                \Session::flash('success_message', '<span style="color:blue;font-weight:bolder;">' . $request->post('patient_first_name') . ' ' . $request->post('patient_last_name') . ' Information WAS NOT Updated</span>');
                return redirect(route('edit_patient_form', $update_this_patient_id));
            }
        } // END of If the Mobile Number was not unique.
        else
        {
            \Session::flash('success_message', 'The Mobile Number Should be Unique <br>But, There is another Mobile Number Like ' . $request->get('patient_mobile_number') . ' in Database, <br><span style="color:blue;font-weight:bolder;" > So Your New Patient Was NOT Submitted! </span><br> Try a Unique Mobile Number');
            return redirect(route('edit_patient_form', $update_this_patient_id));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\patients_general_info $patients_general_info
     * @return \Illuminate\Http\Response
     */
    public function destroy(patients_general_info $patients_general_info)
    {
        //
    }

    public function show_patient_search_from()
    {
        $title_of_page = 'Search Patients' ;
        return view('back.show_patient_search_from', ['title_of_page' => $title_of_page]);
    }

    public function run_patient_search_form( Request $request )
    {
        // If the search key word is more than 1 character.
        if( strlen(request()->post('search_text')) >= 1 )
        {
            $admin_id_from_users_table = $this->find_admin_id_from_users_table() ;
            try
            {
                $result_run_search_form = patients_general_info::
                    select('*')
                    ->where( 'patient_dr_related_id' , '=' , $admin_id_from_users_table )
                    ->Where(function($query) {
                            $query->where( 'patient_mobile_number' , '=' , request()->post('search_text') )
                            ->orwhere( 'patient_nationality_number' , '=' , request()->post('search_text') )
                            ->orwhere( 'patient_first_name' , '=' , request()->post('search_text') )
                            ->orwhere( 'patient_last_name' , '=' , request()->post('search_text') )
                            ->orwhere( 'patient_id' , '=' , request()->post('search_text') );
                    })
                    ->orderBy('patient_id', 'desc')
                    ->get() ;

                // calculate how many result exist in database.
                $number_of_results_from_search = $result_run_search_form->count() ;

                // if there are more than 1 result in database.
                if( $number_of_results_from_search > 0 )
                {
                    \Session::flash('success_message', '<b>'.$number_of_results_from_search.'</b> results found for <b>'.request()->post('search_text').'</b></b>' ) ;
                    $title_of_page = 'Search Patients' ;
                    return view('back.show_patient_search_from', [ 'title_of_page' => $title_of_page , 'result_run_search_form' => $result_run_search_form ] ) ;
                }
                // if there is not ANY result in database.
                else
                {
                    \Session::flash('success_message', 'There is not any result for <b style="color:blue;" >'.request()->post('search_text').'</b>' ) ;
                    return redirect(route('show_patient_search_from')) ;
                }
            }
            catch (\Exception $exception)
            {
                \Session::flash('success_message', 'We have an error to search for this word <b style="color:blue;" >'.request()->post('search_text').'</b>' ) ;
                return redirect(route('show_patient_search_from')) ;
            }
        }
        // If the search key word is more than 1 character.
        else
        {
            \Session::flash('success_message', '<span style="color:blue;" > The word <b style="color:blue;" >'.request()->post('search_text').'</b> you entered to search the patient must be more than 1 letters </span> <br>Suggestion: You can search based on the patient\'s mobile number,<br> <span style="font-weight:bolder;" > which should be more than 1 letters</span> <br>Please re-enter the correct type of information and press the Search button again' ) ;
            return redirect(route('show_patient_search_from')) ;
        }
    }
}
