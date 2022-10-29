<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AppointmentsShowRequest extends FormRequest
{
    public function authorize() : bool
    {
        return true;
    }

    public function rules() : array
    {
        return [
        'show_all_appointments_on_this_date' => 'required|min:6|max:10|date_format:Y-m-d' ,
        ];
    }
}
