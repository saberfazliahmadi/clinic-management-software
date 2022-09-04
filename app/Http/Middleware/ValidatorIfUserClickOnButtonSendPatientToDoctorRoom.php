<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;

class ValidatorIfUserClickOnButtonSendPatientToDoctorRoom
{
    public function handle(Request $request, Closure $next)
    {
        $Rules = [
            'appointment_id'               => 'required|integer' ,
            'send_patient_to_doctors_room' => 'required'
        ];

        $ErrorMessage = [
            'appointment_id.required' => 'Send patient to doctors room was not successfully done <br> Please select one of the patient from list to send to doctors room' ,
        ];

        $request->validate($Rules,$ErrorMessage);
        return $next($request);
    }
}
