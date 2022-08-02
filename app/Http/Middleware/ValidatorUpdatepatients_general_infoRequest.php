<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;

class ValidatorUpdatepatients_general_infoRequest
{
    public function handle(Request $request, Closure $next)
    {
        $rules = [
            'patient_first_name'    => 'required|min:3' ,
            'patient_last_name'     => 'required|min:3' ,
            'patient_mobile_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:8' ,
            'patient_last_appointment_date' => 'date_format:Y-m-d' ,
        ];

        $request->validate($rules);
        return $next($request);
    }
}
