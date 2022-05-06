<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes ;
    protected $primaryKey = 'id' ;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'phone',
        'gender',
        'dob',
        'email',
        'email_verified_at',
        'password' ,
        'gap_time_between_appointments' ,
        'company_name' ,
        'contact_address' ,
        'college' ,
        'college_branch' ,
        'phone_number' ,
        'mobile_number' ,
        'website' ,
        'user_ip' ,
        'http_user_agent' ,
        'activation_status' ,
        'language' ,
        'telegram' ,
        'common_hypersensitivity' ,
        'cms_menu_title' ,
        'common_drug' ,
        'common_diet' ,
        'common_return_date' ,
        'clinic_doctors_name' ,
        'notif_sms_credit' ,
        'financial_management' ,
        'options_for_user' ,
        'remember_token' ,
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    static function scopename($query,$this_user_name)
    {
        return $query->where('name' , $this_user_name) ;
    }

    static function scopeid($query,$Auth_user_id)
    {
        return $query->where('id' , $Auth_user_id) ;
    }

    static function show_main_settings_of_software_form($Auth_user_id, $Auth_user_name)
    {
        $result_show_main_settings_of_software_form = self::
        name($Auth_user_name)
        ->id($Auth_user_id)
        ->limit('1')
        ->first();
        return $result_show_main_settings_of_software_form;
    }

    static function update_main_settings_of_software_form($Auth_user_id, $Auth_user_name, $common_drug, $common_diet, $common_return_date, $phone_number, $college_branch, $contact_address, $common_hypersensitivity, $options_for_user, $cms_menu_title, $gap_time_between_appointments, $clinic_doctors_name)
    {
        $result_update_main_settings_of_software_form = self::
        name($Auth_user_name)
        ->id($Auth_user_id)
        ->limit('1')
        ->update(
        [
            'common_drug'         => $common_drug,
            'common_diet'         => $common_diet,
            'common_return_date'  => $common_return_date,
            'phone_number'        => $phone_number,
            'college_branch'      => $college_branch,
            'contact_address'     => $contact_address,
            'common_hypersensitivity' => $common_hypersensitivity,
            'options_for_user'    => $options_for_user,
            'cms_menu_title'      => $cms_menu_title,
            'gap_time_between_appointments' => $gap_time_between_appointments,
            'clinic_doctors_name' => $clinic_doctors_name
        ]);
        return $result_update_main_settings_of_software_form ;
    }

    static function run_change_password_form($Auth_user_id, $Auth_user_name, $hashed_new_password)
    {
        $result_run_change_password_form = self::
        select( [ 'id' , 'name' , 'password' ] )
        ->name($Auth_user_name)
        ->id($Auth_user_id)
        ->limit('1')
        ->update( ['password' => $hashed_new_password ]);
        return $result_run_change_password_form ;
    }
}
