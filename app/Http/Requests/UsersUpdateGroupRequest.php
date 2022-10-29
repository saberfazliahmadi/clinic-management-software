<?php

namespace App\Http\Requests;

use App\Rules\CheckParentIdOfThisIdOfUser;
use App\Rules\CheckValidityOfFinancialManagement;
use Illuminate\Foundation\Http\FormRequest;

class UsersUpdateGroupRequest extends FormRequest
{
    public function authorize() : bool
    {
        return true;
    }

    public function rules() : array
    {
        return [
        'name_of_user'                    => 'required|string|exists:users,name' ,
        'id_of_user'                      => [ 'required' , 'string' , app(CheckParentIdOfThisIdOfUser::class) ] ,
        '_method'                         => 'required|in:put' ,
        'clinic_doctors_name'             => 'sometimes|string' ,
        'common_hypersensitivity'         => 'sometimes|string' ,
        'common_drug'                     => 'sometimes|string' ,
        'common_diet'                     => 'sometimes|string' ,
        'common_return_date'              => 'sometimes|string' ,
        'gap_time_between_appointments'   => 'sometimes|numeric|min:1' ,
        'phone_number'                    => 'sometimes|numeric|min:1' ,
        'college_branch'                  => 'sometimes|string' ,
        'contact_address'                 => 'sometimes|string' ,
        'money_console_status'            => 'sometimes|in:true,false' ,
        'financial_management'            => [ 'required' , 'string' , app(CheckValidityOfFinancialManagement::class ) ] ,
        'cms_menu_title_0'                => 'sometimes|string' ,
        'cms_menu_title_1'                => 'sometimes|string' ,
        'cms_menu_title_2'                => 'sometimes|string' ,
        'cms_menu_title_3'                => 'sometimes|string' ,
        'cms_menu_title_4'                => 'sometimes|string' ,
        'cms_menu_title_5'                => 'sometimes|string' ,

        'cms_menu_title_7'                => 'sometimes|string' ,
        'cms_menu_title_8'                => 'sometimes|string' ,
        'cms_menu_title_9'                => 'sometimes|string' ,
        'cms_menu_title_10'               => 'sometimes|string' ,
        'cms_menu_title_11'               => 'sometimes|string' ,
        'cms_menu_title_12'               => 'sometimes|string' ,
        'cms_menu_title_13'               => 'sometimes|string' ,
        'cms_menu_title_14'               => 'sometimes|string' ,
        'cms_menu_title_15'               => 'sometimes|string' ,
        'cms_menu_title_16'               => 'sometimes|string' ,
        'cms_menu_title_17'               => 'sometimes|string' ,
        'cms_menu_title_18'               => 'sometimes|string' ,
        'cms_menu_title_19'               => 'sometimes|string' ,
        'cms_menu_title_20'               => 'sometimes|string' ,
        'cms_menu_title_21'               => 'sometimes|string' ,
        'cms_menu_title_22'               => 'sometimes|string' ,
        'cms_menu_title_23'               => 'sometimes|string' ,
        'cms_menu_title_24'               => 'sometimes|string' ,
        'cms_menu_title_25'               => 'sometimes|string' ,
        'cms_menu_title_26'               => 'sometimes|string' ,
        'cms_menu_title_27'               => 'sometimes|string' ,
        'cms_menu_title_28'               => 'sometimes|string' ,
        'setting_status'                  => 'sometimes|in:true,false' ,
        'status_of_user'                  => 'required|in:'.config('global.active').','.config('global.ban') ,
        'level_of_user'                   => 'required|in:'.config('global.guest_level').','.config('global.user_level').','.config('global.admin_level').','.config('global.super_admin_level') ,
        ];
    }
}
