<?php

namespace App\Http\Controllers;

use App\Models\patients_appointment;
use App\Http\Requests\Storepatients_appointmentRequest;
use App\Http\Requests\Updatepatients_appointmentRequest;

// I added this Model to this page manually.
use App\Models\patients_general_info;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use mysql_xdevapi\Session;
use phpDocumentor\Reflection\Types\Null_;

class PatientsAppointmentController extends Controller
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
    public function show(patients_appointment $patients_appointment , Request $request )
    {
        // Make variable trick with if() to specify date of appointments by GET or POST method.
        if( strlen($request->post('show_all_appointments_on_this_date')) > 0 )
        {
            $show_all_appointments_on_this_date = $request->post('show_all_appointments_on_this_date') ;
        }
        elseif( strlen($request->show_all_appointments_this_date) > 0 )
        {
            $show_all_appointments_on_this_date = $request->show_all_appointments_this_date ;
        }
        else
        {
            $show_all_appointments_on_this_date = '' ;
        }

        $title_of_page = 'List of All Appointments on Date '.$show_all_appointments_on_this_date ;

        try
        {
            $admin_id_from_users_table = $this->find_admin_id_from_users_table() ;

            // Create mysql query to extract all of appointments that record in database on this specific date (JOIN TYPE)
            $result_show_form_of_appointments_on_specific_date = patients_appointment::
            join('patients_general_infos' , 'patients_general_infos.patient_id' , '=' , 'patients_appointments.appointment_patient_related_id')
            ->where('patients_appointments.appointment_dr_related_id' , '=' , $admin_id_from_users_table )
            ->where('patients_appointments.appointment_date'          , '=' , $show_all_appointments_on_this_date )
            ->orderBy('patients_appointments.appointment_time')
            ->get() ;

            // How many appointment found
            $count_of_appointment = $result_show_form_of_appointments_on_specific_date->count() ;

            // If more than 0 appointment exist on database.
            if( $count_of_appointment > 0 )
            {
                if( strlen(Auth::user()->financial_management) > 0 )
                {
                    $financial_management_data = Auth::user()->financial_management ;
                }
                else
                {
                    $financial_management_data = '' ;
                }
                return view('back.show_form_of_appointments_on_specific_date' , [ 'title_of_page' => $title_of_page , 'result_show_form_of_appointments_on_specific_date' => $result_show_form_of_appointments_on_specific_date , 'count_of_appointment' => $count_of_appointment , 'show_all_appointments_on_this_date' => $show_all_appointments_on_this_date , 'financial_management_data' => $financial_management_data ] ) ;
            }
            else
            {
                return view('back.show_form_of_appointments_on_specific_date' , [ 'title_of_page' => $title_of_page ] )
                ->with(['success_message' => '<span style="color:blue;" >There are not any Appointment on Date '.$show_all_appointments_on_this_date.'</span> <br> Please, Choose a Date to Show Appointments']) ;
            }
        }
        catch ( \Exception $exception )
        {
            return view('back.show_form_of_appointments_on_specific_date' , [ 'title_of_page' => $title_of_page ])
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
    public function destroy(patients_appointment $patients_appointment , Request $request  )
    {
        $admin_id_from_users_table = $this->find_admin_id_from_users_table() ;
        $show_all_appointments_this_date = $request->show_all_appointments_this_date ;

        try
        {
            patients_appointment::
            select(['appointment_id' , 'appointment_dr_related_id' ])
            ->where( 'appointment_id'            , '=' , $request->appointment_id )
            ->where( 'appointment_dr_related_id' , '=' , $admin_id_from_users_table )
            ->limit('1')
            ->delete() ;

            return redirect()->back()
            ->with(['success_message' => '<span>The Selected Appointment Successfully Deleted</span>']);
        }
        catch (\Exception $exception)
        {
            return redirect()->back()
            ->with(['success_message' => '<span style="color:blue;">The Selected Appointment WAS NOT Deleted!</span>']);
        }
    }

    public function show_patient_time_appointment_table( $choose_time_for_this_date , $choose_time_for_this_patient_id )
    {
        try
        {
            // All of HTML codes will be added to this variable and at the end of this function, this variable will be passed to view page.
            $text_trick = '';

            $clinic_doctors_name = Auth::user()->clinic_doctors_name;

            // START of show doctors of clinic
            if( strlen($clinic_doctors_name) > 0 )
            {
                $text_trick .= '
                <div class="form-group col-md-12 col-sm-12 col-xs-12" style="margin-bottom:25px;" >
                
                    <center>
                        <label class="control-label col-md-12 col-sm-12 col-xs-12" style="font-size:22px;font-weight:normal;text-align: center!important;margin-bottom:15px;" >
                            Choose Doctor of Patient
                        </label>
                    </center>
                    
                    <div class="col-md-12 col-sm-12 col-xs-12" >
                      <div class="form-group" >
                        <div class="col-md-12 col-sm-12 col-xs-12" >
                            <div class="col-md-12 col-sm-12 col-xs-12" >';

                                // Explode and make array type variable
                                $common_clinic_dr_1      = explode(",",$clinic_doctors_name);
                                // Estimate how many index exist in this variable
                                $common_clinic_dr_number = count($common_clinic_dr_1);
                                // Make end number for loop
                                $end 					 = $common_clinic_dr_number;
                                for( $start='0' ; $start < $end ; $start++ )
                                {
                                    if(strlen($common_clinic_dr_1[$start])>'0')
                                    {
                                        $text_trick .= '
                                        <label class="btn btn-default well" data-toggle-class="btn-primary" style="font-size:20px;background-color:white;" >
                                            <input type="radio" name="appointment_child_dr_related_name" value="'.$common_clinic_dr_1[$start].'" > '.$common_clinic_dr_1[$start].'
                                        </label>';
                                    }
                                }

                            $text_trick .= '
                            </div>
                         </div>
                     </div>
                    </div>
                    
                </div>' ;
            }
            // END of show doctors of clinic

            // START of select service type of appointment
            if( strlen(Auth::user()->financial_management) > 0 )
            {
                $text_trick .= '
                <center>
                    <label class="control-label col-md-12 col-sm-12 col-xs-12" style="font-size:22px;font-weight:normal;text-align: center!important;margin-bottom:15px;margin-top:5px;" >
                        Choose Type Service of This Appointment
                    </label>
                    <div style="margin-top:10px;margin-bottom:30px;" class="col-md-12 col-sm-12 col-xs-12" >' ;

                        // Explode and make array type variable
                        $appointment_service_type = explode(",", Auth::user()->financial_management) ;
                        // Estimate how many index exist in this variable
                        $appointment_service_type_number = count($appointment_service_type);
                        // Make end number for loop
                        $end = $appointment_service_type_number ;
                        for( $start ='0' ; $start < $end ; $start++ )
                        {
                            if( strlen($appointment_service_type[$start]) > 0 )
                            {
                                $text_trick .= '
                                <label class="btn btn-default well" data-toggle-class="btn-primary" style="font-size:20px;background-color:white;border: 1px solid #ccc;border-radius: 4px!important;margin-top:5px;margin-bottom:5px;" >
                                    <input type="radio" name="appointment_service_type" value="' . $appointment_service_type[$start] . '" > ' . $appointment_service_type[$start] . '
                                </label>';
                            }
                        }

                   $text_trick .= '
                   </div>
                </center>';
            }
            // END of select service type of appointment

            $appointment_gap_time = Auth::user()->gap_time_between_appointments;

            $start_of_day = strtotime('00:00');
            $end_end_day  = strtotime('24:00');

            // START of time appointment counter creator.
            for ( $index_counter = $start_of_day ; $index_counter <= $end_end_day ; $index_counter = $index_counter + $appointment_gap_time * 60 )
            {
                $admin_id_from_users_table = $this->find_admin_id_from_users_table();

                // Make an appointment time trick
                $appointment_time_trick = date('H:i', $index_counter);

                // Create mysql query to extract all of appointments that record in database on this specific time by (JOIN TYPE)
                $result_patients_appointment = patients_appointment::
                join('patients_general_infos' , 'patients_general_infos.patient_id' , '=' , 'patients_appointments.appointment_patient_related_id')
                ->select('patients_appointments.*' , 'patients_general_infos.patient_id' , 'patients_general_infos.patient_first_name' , 'patients_general_infos.patient_last_name' )
                ->where('patients_appointments.appointment_dr_related_id' , '=' , $admin_id_from_users_table)
                ->where('patients_appointments.appointment_date'          , '=' , $choose_time_for_this_date)
                ->where('patients_appointments.appointment_time'          , '=' , $appointment_time_trick)
                ->get();

                // How many appointment time equal with $appointment_time_trick exist in database.
                $num_of_res_time_trick = $result_patients_appointment->count();

                $trick_of_title = '' ;
                foreach ( $result_patients_appointment as $key_3 )
                {
                    $trick_of_title .= '( '.$key_3->patient_first_name.' '.$key_3->patient_last_name.' -> '.$key_3->patient_id.' ) ' ;
                }

                // Show Free time OR Busy time by RED and ORANGE div colour.
                if ($num_of_res_time_trick > '0' && $num_of_res_time_trick <= '3')
                {
                    $appointment_div_trick = 'alert alert-warning well';
                    $appointment_text_color_trick = 'color:white;background-color: rgba(243,156,18,0.88);';
                }
                elseif ($num_of_res_time_trick > '3')
                {
                    $appointment_div_trick = 'alert alert-danger well';
                    $appointment_text_color_trick = 'color:white;background-color: rgba(231,76,60,0.88);';
                }
                else
                {
                    $appointment_div_trick = 'well';
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

            $title_of_page = 'List of Appointments Time on Date: ' . $choose_time_for_this_date;
            return view('back.show_patient_time_appointment_table', ['title_of_page' => $title_of_page, 'choose_time_for_this_date' => $choose_time_for_this_date, 'choose_time_for_this_patient_id' => $choose_time_for_this_patient_id, 'text_trick' => $text_trick]);
        }
        catch (\Exception $exception)
        {
            return redirect(route('home'))
            ->with( [ 'success_message' => '<span style="color:blue;">We have an error to show List of Appointments time on this Specific Date </span>' ] );
        }
    }

    public function store_patient_time_appointment_table( Request $request )
    {
        $request->validate(
            [
                'choose_time_for_this_patient_id' => 'required|min:1' ,
            ]
        ) ;

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
            $admin_id_from_users_table = $this->find_admin_id_from_users_table() ;

            $result_store_patient_time_appointment_table = new patients_appointment(
                [
                    'appointment_dr_related_id'         => $admin_id_from_users_table ,
                    'appointment_patient_related_id'    => $choose_time_for_this_patient_id ,
                    'appointment_date'                  => $choose_time_for_this_date ,
                    'appointment_time'                  => $appointment_time ,
                    'appointment_child_dr_related_name' => $appointment_child_dr_related_name ,
                    'appointment_service_type'          => $appointment_service_type ,
                ]
            );

            $result_store_patient_time_appointment_table->save();

            patients_general_info::
            select( 'patient_id'            , 'patient_last_appointment_date' , 'patient_last_appointment_time' , 'patient_dr_related_id' )
            ->where('patient_id'            , '=' , $choose_time_for_this_patient_id )
            ->where('patient_dr_related_id' , '=' , $admin_id_from_users_table )
            ->limit('1')
            ->update([
                'patient_last_appointment_date' => $choose_time_for_this_date ,
                'patient_last_appointment_time' => $appointment_time
            ]);

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
        $title_of_page = 'List of Appointments on a Specific Date' ;
        return view('back.show_form_of_appointments_on_specific_date' , [ 'title_of_page' => $title_of_page ]) ;
    }
}
