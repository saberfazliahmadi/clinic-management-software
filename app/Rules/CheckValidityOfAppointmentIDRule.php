<?php
namespace App\Rules;

use App\Models\patients_appointment;
use Illuminate\Contracts\Validation\Rule;

class CheckValidityOfAppointmentIDRule implements Rule
{
    public function passes($attribute, $value)
    {
        return patients_appointment::CheckValidityOfAppointmentID($value) === 1 ;
    }

    public function message()
    {
        return '<span style="color:blue;">The Requested :attribute of Patient Does Not Exist!</span>';
    }
}
