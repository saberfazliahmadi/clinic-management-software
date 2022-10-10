<?php
namespace App\Http\Requests;

use App\Rules\CheckCurrentPasswordEnteredByUserShouldBeEqualToUserPassword;
use Illuminate\Foundation\Http\FormRequest;

class UsersUpdatePasswordRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return
        [
            'password'              => [ 'required' , 'string' , 'min:8' , 'max:100' , app(CheckCurrentPasswordEnteredByUserShouldBeEqualToUserPassword::class) ] ,
            'new_password'          => 'required|string|min:8|max:100|same:re_type_new_password' ,
            're_type_new_password'  => 'required|string|min:8|max:100|same:new_password'          ,
        ];
    }
}
