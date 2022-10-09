<?php
namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\User ;
class CheckParentIdOfThisIdOfUser implements Rule
{
    public function passes($attribute, $value)
    {
        return User::countExistanceOfParentIdRelatedToThisIdOfUser(encryptDecrypt('decrypt',$value)) === 1 ;
    }

    public function message()
    {
        return 'You are not authorize to change this user information';
    }
}
