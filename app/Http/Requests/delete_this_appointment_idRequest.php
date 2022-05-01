<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class delete_this_appointment_idRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'appointment_id' => 'integer|min:1' ,
        ];
    }
}
