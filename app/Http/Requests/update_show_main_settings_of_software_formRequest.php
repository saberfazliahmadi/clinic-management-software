<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class update_show_main_settings_of_software_formRequest extends FormRequest
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
    }
}
