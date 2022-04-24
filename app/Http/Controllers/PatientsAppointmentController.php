<?php

namespace App\Http\Controllers;

use App\Http\Requests\delete_this_appointment_idRequest;
use App\Http\Requests\show_form_of_appointments_on_specific_dateRequest;
use App\Http\Requests\store_patient_time_appointment_tableRequest;
use App\Http\Requests\Storepatients_appointmentRequest;
use App\Http\Requests\Updatepatients_appointmentRequest;
use App\Models\patients_appointment;
use App\Models\patients_general_info;
use Illuminate\Support\Facades\Auth;

class PatientsAppointmentController extends Controller
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
     * @param  \App\Http\Requests\Storepatients_appointmentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Storepatients_appointmentRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\patients_appointment  $patients_appointment
     * @return \Illuminate\Http\Response
     */
    public function show(patients_appointment $patients_appointment , show_form_of_appointments_on_specific_dateRequest $request )
    {
        $show_all_appointments_on_this_date = '' ;
        // Specify date of appointments by GET or POST method
        if( strlen($request->post('show_all_appointments_on_this_date')) > 0 )
        {
            $show_all_appointments_on_this_date = $request->post('show_all_appointments_on_this_date') ;
        }
        elseif( strlen($request->show_all_appointments_this_date) > 0 )
        {
            $show_all_appointments_on_this_date = $request->show_all_appointments_this_date ;
        }

        try
        {
            // Create mysql query to extract all of appointments that record in database on this specific date (JOIN TYPE)
            $result_show_form_of_appointments_on_specific_date = patients_appointment::result_show_form_of_appointments_on_specific_date($show_all_appointments_on_this_date) ;

            // How many appointment found on this specific date
            $count_of_appointment = $result_show_form_of_appointments_on_specific_date->count() ;

            // If there is not any appointment on the database
            if( $count_of_appointment == 0 )
            {
                return view('back.show_form_of_appointments_on_specific_date' , [ 'title_of_page' => '<b style="color:blue" >There is no Appointment on Date '.$show_all_appointments_on_this_date.'</b>' ] )
                ->with(['success_message' => '<span style="color:blue;" >There are not any Appointment on Date '.$show_all_appointments_on_this_date.'</span> <br> Please, Choose a Date to Show Appointments']) ;
            }

            $financial_management_data = '' ;
            if( strlen(Auth::user()->financial_management) > 0 )
            {
                $financial_management_data = Auth::user()->financial_management ;
            }

            return view('back.show_form_of_appointments_on_specific_date' ,
            [
                'title_of_page' => 'List of All Appointments on Date '.$show_all_appointments_on_this_date ,
                'result_show_form_of_appointments_on_specific_date' => $result_show_form_of_appointments_on_specific_date ,
                'count_of_appointment'                              => $count_of_appointment ,
                'show_all_appointments_on_this_date'                => $show_all_appointments_on_this_date ,
                'financial_management_data'                         => $financial_management_data
            ] ) ;
        }
        catch ( \Exception $exception )
        {
            return view('back.show_form_of_appointments_on_specific_date' , [ 'title_of_page' => 'List of All Appointments on Date '.$show_all_appointments_on_this_date ])
            ->with(['success_message' => '<b style="color:blue;" >We have an Error to show appointments on Date '.$show_all_appointments_on_this_date.'</b>']) ;
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\patients_appointment  $patients_appointment
     * @return \Illuminate\Http\Response
     */
    public function edit(patients_appointment $patients_appointment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Updatepatients_appointmentRequest  $request
     * @param  \App\Models\patients_appointment  $patients_appointment
     * @return \Illuminate\Http\Response
     */
    public function update(Updatepatients_appointmentRequest $request, patients_appointment $patients_appointment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\patients_appointment  $patients_appointment
     * @return \Illuminate\Http\Response
     */
    public function destroy(patients_appointment $patients_appointment , delete_this_appointment_idRequest $request  )
    {
        try
        {
            $result_of_delete_this_appointment_id = patients_appointment::delete_this_appointment_id($request->appointment_id) ;

            if(!$result_of_delete_this_appointment_id)
            {
                return redirect()->back()
                ->with(['success_message' => '<span style="color:blue;">The Selected Appointment WAS NOT Deleted!</span><br>You may have a related financial transaction to this appointment<br>So, first of all you should delete related financial transaction']);
            }
            return redirect()->back()
            ->with(['success_message' => '<span>The Selected Appointment Successfully Deleted</span>']);
        }
        catch (\Exception $exception)
        {
            return redirect()->back()
            ->with(['success_message' => '<span style="color:blue;">The Selected Appointment WAS NOT Deleted!</span><br>You may have a related financial transaction to this appointment<br>So, first of all you should delete related financial transaction']);
        }
    }

    public function show_patient_time_appointment_table( $choose_time_for_this_date , $choose_time_for_this_patient_id )
    {
        try
        {
            // All of HTML codes will be added to this variable and at the end of this function, this variable will be passed to view page.
            $text_trick = '';

            $start_of_day = strtotime('00:00');
            $end_end_day  = strtotime('24:00');

            // In here, the Algorithm is Chunk 1 day to small pieces of minutes
            // START of time appointment counter creator.
            for ( $index_counter = $start_of_day ; $index_counter <= $end_end_day ; $index_counter = $index_counter + Auth::user()->gap_time_between_appointments * 60 )
            {
                // The date function will change N minutes to HH:MM format
                // Make an appointment time trick
                $appointment_time_trick = date('H:i', $index_counter);

                // Create mysql query to extract all of appointments data on this specific time and date by (JOIN TYPE)
                $result_appointments_of_patients_on_this_time_and_date = patients_appointment::result_appointments_of_patients_on_this_time_and_date($choose_time_for_this_date, $appointment_time_trick) ;

                // How many appointment time equal with $appointment_time_trick exist in database.
                $num_of_res_time_trick = $result_appointments_of_patients_on_this_time_and_date->count();

                $trick_of_title = '' ;
                foreach ( $result_appointments_of_patients_on_this_time_and_date as $key_3 )
                {
                    $trick_of_title .= '( '.$key_3->patient_first_name.' '.$key_3->patient_last_name.' -> '.$key_3->patient_id.' ) ' ;
                }

                // Show Free time OR Busy time by RED and ORANGE div color
                if ($num_of_res_time_trick > '0' && $num_of_res_time_trick <= '3')
                {
                    $appointment_div_trick        = 'alert alert-warning well';
                    $appointment_text_color_trick = 'color:white;background-color: rgba(243,156,18,0.88);';
                }
                elseif ($num_of_res_time_trick > '3')
                {
                    $appointment_div_trick        = 'alert alert-danger well';
                    $appointment_text_color_trick = 'color:white;background-color: rgba(231,76,60,0.88);';
                }
                else
                {
                    $appointment_div_trick        = 'well';
                    $appointment_text_color_trick = 'color:gray;';
                }

                $text_trick .= '
                <label title="' . $trick_of_title . '" class="well col-md-2 col-sm-2 col-xs-2 form-group btn-default ' . $appointment_div_trick . '" style="text-align:center;font-weight:normal;cursor: pointer;font-size:14px;' . $appointment_text_color_trick . '" >';
                    if ($num_of_res_time_trick !== '0')
                    {
                        $text_trick .= '
                        <span>
                            ' . $num_of_res_time_trick . '
                        </span>';
                    }
                    else
                    {
                        $text_trick .= '
                        <span>
                            &nbsp;
                        </span>';
                    }
                     $text_trick .= '
                    <div title="' . $trick_of_title . '" ><input type="radio" name="appointment_time" class="flat" value="' . $appointment_time_trick . '" > ' . $appointment_time_trick . '</div>
                </label>';

            } // END of time appointment counter creator.

            return view('back.show_patient_time_appointment_table',
            [
                'title_of_page'                   => 'List of Appointments Time on Date: ' . $choose_time_for_this_date,
                'choose_time_for_this_date'       => $choose_time_for_this_date,
                'choose_time_for_this_patient_id' => $choose_time_for_this_patient_id,
                'text_trick'                      => $text_trick
            ]);
        }
        catch (\Exception $exception)
        {
            return redirect(route('home'))
            ->with( [ 'success_message' => '<span style="color:blue;">We Have an Error to Show List of Appointments Time on This Specific Date</span>' ] );
        }
    }

    public function store_patient_time_appointment_table( store_patient_time_appointment_tableRequest $request )
    {
        $choose_time_for_this_patient_id = request()->post('choose_time_for_this_patient_id') ;
        $choose_time_for_this_date       = request()->post('choose_time_for_this_date') ;
        $appointment_time                = request()->post('appointment_time') ;

        if( request()->post('appointment_child_dr_related_name') !== null )
        {
            $appointment_child_dr_related_name = request()->post('appointment_child_dr_related_name') ;
        }
        else
        {
            // This value SHOULD NOT BE NULL because we use this value is financial transaction searching page
            // So leave it EMPTY
            $appointment_child_dr_related_name = '' ;
        }

        if( request()->post('appointment_service_type') !== null )
        {
            $appointment_service_type = request()->post('appointment_service_type') ;
        }
        else
        {
            // This value SHOULD NOT BE NULL because we use this value is financial transaction searching page
            // So leave it EMPTY
            $appointment_service_type = '' ;
        }

        try
        {
            $result_store_new_patient_appointment_time              = patients_appointment::store_new_patient_appointment_time($choose_time_for_this_patient_id,$choose_time_for_this_date,$appointment_time,$appointment_child_dr_related_name,$appointment_service_type) ;
            $update_patient_general_info_last_appointment_data_time = patients_general_info::update_patient_general_info_last_appointment_data_time($choose_time_for_this_patient_id,$choose_time_for_this_date,$appointment_time) ;

            if(!$result_store_new_patient_appointment_time || !$update_patient_general_info_last_appointment_data_time)
            {
                return redirect(route('submit_new_patient_form'))
                ->with( [ 'success_message' => '<span style="color:blue;">The Time and Date Appointment Were NOT Successfully Submitted!</span>' ] );
            }
            return redirect(route('submit_new_patient_form'))
            ->with( [ 'success_message' => 'The Appointment Time= '.$appointment_time.' On Date= '.$choose_time_for_this_date.' <br> of <a href="'.route('edit_patient_form', $choose_time_for_this_patient_id ).'" ><b>Patient</b></a> Were Successfully Submitted' ] );
        }
        catch (\Exception $exception)
        {
            return redirect(route('submit_new_patient_form'))
            ->with( [ 'success_message' => '<span style="color:blue;">The Time and Date Appointment Were NOT Successfully Submitted!</span>' ] );
        }
    }

    public function show_form_of_appointments_on_specific_date()
    {
        return view('back.show_form_of_appointments_on_specific_date' , [ 'title_of_page' => 'List of Appointments on a Specific Date' ]) ;
    }
}
