<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class run_change_password_formRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true ;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'current_password'    => 'required|min:8|max:50' ,
            'new_password'        => 'required|min:8|max:50' ,
            'retype_new_password' => 'required|min:8|max:50' ,
        ];
    }
}
