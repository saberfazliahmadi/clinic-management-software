<?php

namespace App\Rules;

use App\Models\patients_general_info;
use Illuminate\Contracts\Validation\Rule;

class CheckMobileNumberDuplicationForStoreNewPatientRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        /** Check for mobile number duplication
        WE SHOULD NOT HAVE 2 PATIENTS WITH SAME MOBILE NUMBERS IN OUR DATABASE!
        It means, the mobile numbers should be unique.
        If the Mobile Number was not unique then redirect him to route('back_to_previous_page') **/
        return patients_general_info::numberOfDuplicateMobileNumber(null , $value ) === 0 ;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The Mobile Number Should Be Unique<br>
        But, There Is Another Mobile Number Equal To The <span style="color:blue;font-weight:bolder;" >Number You Entered</span> in The Database,<br>
        <span style="color:blue;font-weight:bolder;" >So Your New Patient Was NOT Submitted!</span><br>
        Please, Enter a Unique Mobile Number and Try This Process Again' ;
    }
}
