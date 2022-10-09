<?php
namespace App\Http\Requests;

use App\Rules\CheckParentIdOfThisIdOfUser;
use App\Rules\CheckValidityOfFinancialManagement;
use Illuminate\Foundation\Http\FormRequest;

class UsersUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            '_method' => 'required|in:put',
            'clinic_doctors_name' => 'string',
            'common_hypersensitivity' => 'string',
            'common_drug' => 'string',
            'common_diet' => 'string',
            'common_return_date' => 'string',
            'gap_time_between_appointments' => 'numeric|min:1',
            'phone_number' => 'numeric|min:1',
            'college_branch' => 'string',
            'contact_address' => 'string',
            'money_console_status' => 'in:true,false',
            'financial_management' => ['required', 'string', app(CheckValidityOfFinancialManagement::class)],
            'cms_menu_title_0' => 'string',
            'cms_menu_title_1' => 'string',
            'cms_menu_title_2' => 'string',
            'cms_menu_title_3' => 'string',
            'cms_menu_title_4' => 'string',
            'cms_menu_title_5' => 'string',

            'cms_menu_title_7' => 'string',
            'cms_menu_title_8' => 'string',
            'cms_menu_title_9' => 'string',
            'cms_menu_title_10' => 'string',
            'cms_menu_title_11' => 'string',
            'cms_menu_title_12' => 'string',
            'cms_menu_title_13' => 'string',
            'cms_menu_title_14' => 'string',
            'cms_menu_title_15' => 'string',
            'cms_menu_title_16' => 'string',
            'cms_menu_title_17' => 'string',
            'cms_menu_title_18' => 'string',
            'cms_menu_title_19' => 'string',
            'cms_menu_title_20' => 'string',
            'cms_menu_title_21' => 'string',
            'cms_menu_title_22' => 'string',
            'cms_menu_title_23' => 'string',
            'cms_menu_title_24' => 'string',
            'cms_menu_title_25' => 'string',
            'cms_menu_title_26' => 'string',
            'cms_menu_title_27' => 'string',
            'cms_menu_title_28' => 'string',
            'setting_status' => 'in:true,false',
        ];
    }
}
