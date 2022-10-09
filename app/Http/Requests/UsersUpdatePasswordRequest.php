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
            'current_password'    => [ 'required' , 'string' , 'min:8' , 'max:100' , app(CheckCurrentPasswordEnteredByUserShouldBeEqualToUserPassword::class) ] ,
            'new_password'        => 'required|string|min:8|max:100|same:retype_new_password' ,
            'retype_new_password' => 'required|string|min:8|max:100|same:new_password'        ,
        ];
    }
}
