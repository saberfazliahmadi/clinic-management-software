<?php
namespace App\Http\Middleware;

use Closure;
use App\Responses\Responses;
use Illuminate\Http\Request;

class ValidatorMainSettingsSoftwareFormRequest
{
    public function handle(Request $request, Closure $next)
    {
        $rules = [
            'clinic_doctors_name'             => 'string' ,
            'common_hypersensitivity'         => 'string' ,
            'common_drug'                     => 'string' ,
            'common_diet'                     => 'string' ,
            'common_return_date'              => 'string' ,
            'gap_time_between_appointments'   => 'integer' ,
            'phone_number'                    => 'string' ,
            'college_branch'                  => 'string' ,
            'contact_address'                 => 'string' ,
            'money_console_status'            => 'string' ,
            'cms_menu_title_0'                => 'string' ,
            'cms_menu_title_1'                => 'string' ,
            'cms_menu_title_2'                => 'string' ,
            'cms_menu_title_3'                => 'string' ,
            'cms_menu_title_4'                => 'string' ,
            'cms_menu_title_5'                => 'string' ,

            'cms_menu_title_7'                => 'string' ,
            'cms_menu_title_8'                => 'string' ,
            'cms_menu_title_9'                => 'string' ,
            'cms_menu_title_10'               => 'string' ,
            'cms_menu_title_11'               => 'string' ,
            'cms_menu_title_12'               => 'string' ,
            'cms_menu_title_13'               => 'string' ,
            'cms_menu_title_14'               => 'string' ,
            'cms_menu_title_15'               => 'string' ,
            'cms_menu_title_16'               => 'string' ,
            'cms_menu_title_17'               => 'string' ,
            'cms_menu_title_18'               => 'string' ,
            'cms_menu_title_19'               => 'string' ,
            'cms_menu_title_20'               => 'string' ,
            'cms_menu_title_21'               => 'string' ,
            'cms_menu_title_22'               => 'string' ,
            'cms_menu_title_23'               => 'string' ,
            'cms_menu_title_24'               => 'string' ,
            'cms_menu_title_25'               => 'string' ,
            'cms_menu_title_26'               => 'string' ,
            'cms_menu_title_27'               => 'string' ,
            'cms_menu_title_28'               => 'string' ,

            'name_of_user'   => 'string|exists:users,name' ,
             encrypt_decrypt('decrypt', request()->id_of_user) => 'string|exists:users,id' ,

            'status_of_user' => 'nullable|in:'.config('global.active').','.config('global.ban') ,
            'level_of_user'  => 'nullable|in:'.config('global.guest_level').','.config('global.user_level').','.config('global.admin_level') ,
        ];
        $request->validate($rules);

        /** Check the $request->financial_management
         * and then if we have an error on $financial_management_revealed_errors,
         * show related Error message to user **/
        $financial_management_revealed_errors = $this->validation_of_financial_management_variable($request->financial_management) ;
        if( $financial_management_revealed_errors !== '' )
        {
            return Responses::Failed( 'back_to_previous_page' , '' , '<b>Financial Type Error</b><br><b style="color:red;">'.$financial_management_revealed_errors.' is wrong</b><br><b style="color:blue;" >At least type 3 characters followed by this type <br> Service Name : Service Amount</b><br>Remember, each service type should have this character <b style="color:blue;" >:</b>' ) ;
        }

        return $next($request);
    }

    public function validation_of_financial_management_variable($request_post_financial_management)
    {
        $financial_management_revealed_errors = '' ;
        // If ADMIN typed something for financial management service
        if ($request_post_financial_management ==! '')
        {
            // Check all financial items to be eligible
            // Each of financial transaction items should have number & character & ':'
            $exploded_values = explode(',', $request_post_financial_management);
            foreach ($exploded_values as $financial_item)
            {
                // Check all require conditions that financial items should have
                if (! (strpos($financial_item, ':') && strlen($financial_item) > 2 && preg_match('/[A-Za-z]/', $financial_item) && preg_match('/[0-9]/', $financial_item)))
                {
                    $financial_management_revealed_errors .= ' '.$financial_item ;
                }
            }
        }
        return $financial_management_revealed_errors ;
    }
}
