<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PatientsShowRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'search_text' => 'required|min:2'
        ];
    }

    public function messages()
    {
        return [
            'search_text.required' => '<span style="color:blue;" >The word you entered to search for document of patient must be more than 2 letter </span> <br>Suggestion: You can search based on the patient\'s mobile number,<br> <span style="font-weight:bolder;" > which should be more than 1 letters</span> <br>Please re-enter the correct type of information and press the Search button again',
            'search_text.min'      => '<span style="color:blue;" >The word you entered to search for document of patient must be more than 2 letter </span> <br>Suggestion: You can search based on the patient\'s mobile number,<br> <span style="font-weight:bolder;" > which should be more than 1 letters</span> <br>Please re-enter the correct type of information and press the Search button again',
        ];
    }

    ///**
    // *  Filters to be applied to the input.
    // *
    // * @return array
    // */
    //public function filters()
    //{
    //    return [
    //        'search_text' => 'trim|lowercase',
    //        'search_text'  => 'trim|capitalize|escape'
    //    ];
    //}
}
