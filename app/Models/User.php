<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

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
        'common_rejim' ,
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
}
