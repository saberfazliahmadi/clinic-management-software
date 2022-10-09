<?php
namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CheckValidityOfFinancialManagement implements Rule
{
    public function passes($attribute, $value)
    {
        /** Check the $request->financial_management
        and then if we have an error on $financial_management_revealed_errors,
        show related Error message to user **/
        return $this->validation_of_financial_management_variable($value) === '' ;
    }

    public function message()
    {
        return '
        <b>Financial Type Error</b><br>
        <b style="color:red;"> :attribute is wrong</b><br>
        <b style="color:blue;" >At least type 3 characters followed by this type<br>
        Service Name : Service Amount</b><br>
        Remember, each service type should have this character <b style="color:blue;">:</b> and <b style="color:blue;">Digit Numbers</b>';
    }

    public function validation_of_financial_management_variable($request_post_financial_management)
    {
        $financial_management_revealed_errors = '' ;
        // If ADMIN typed something for financial management service
        if ($request_post_financial_management ==! '')
        {
            $exploded_values = explode(',', $request_post_financial_management);
            foreach ($exploded_values as $financial_item)
            {
                // Check all require conditions that a correct financial item should have
                // Each of financial transaction items should have number & character & ':' & more than 2 characters
                if (! (strpos($financial_item, ':') && strlen($financial_item) > 2 && preg_match('/[A-Za-z]/', $financial_item) && preg_match('/[0-9]/', $financial_item)))
                {
                    $financial_management_revealed_errors .= ' '.$financial_item ;
                }
            }
        }
        return $financial_management_revealed_errors ;
    }
}
