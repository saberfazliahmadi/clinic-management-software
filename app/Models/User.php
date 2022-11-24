<?php
namespace App\Models;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
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
        'id' ,
        'name',
        'phone',
        'gender',
        'dob',
        'user_level' ,
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
        'status' ,
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

    public static function scopename($query,$this_user_name)
    {
        return $query->where('name' , $this_user_name) ;
    }

    public static function scopeid($query,$Auth_user_id)
    {
        return $query->where('id' , $Auth_user_id) ;
    }

    public function scopeequalThisToAdminIdFromUserTable($query, $equal_this)
    {
        return $query->where($equal_this, findAdminIdFromUsersTable()) ;
    }

    public static function fetchMainSettingsOfSoftwareFormData()
    {
        return self::
        id(Auth::id())
        ->name(Auth::user()->name)
        ->limit('1')
        ->first();
    }

    public static function updateMainSettingsOfSoftwareForm( $common_drug, $common_diet, $common_return_date, $phone_number, $college_branch, $contact_address, $common_hypersensitivity, $options_for_user, $cms_menu_title, $gap_time_between_appointments, $clinic_doctors_name , $financial_management )
    {
        return self::
        name(Auth::user()->name)
        ->id(Auth::id())
        ->limit('1')
        ->update(
        [
            'common_drug'                   => $common_drug,
            'common_diet'                   => $common_diet,
            'common_return_date'            => $common_return_date,
            'phone_number'                  => $phone_number,
            'college_branch'                => $college_branch,
            'contact_address'               => $contact_address,
            'common_hypersensitivity'       => $common_hypersensitivity,
            'options_for_user'              => $options_for_user,
            'cms_menu_title'                => $cms_menu_title,
            'gap_time_between_appointments' => $gap_time_between_appointments,
            'clinic_doctors_name'           => $clinic_doctors_name ,
            'financial_management'          => $financial_management
        ]);
    }

    public static function updateMainSettingsOfSoftwareFormForSuperAdmin($id_of_user , $name_of_user , $common_drug, $common_diet, $common_return_date, $phone_number, $college_branch, $contact_address, $common_hypersensitivity, $options_for_user, $cms_menu_title, $gap_time_between_appointments, $clinic_doctors_name , $request_status_of_user , $request_level_of_user , $financial_management )
    {
        return self::
        name($name_of_user)
        ->id($id_of_user)
        ->limit('1')
        ->update(
        [
            'common_drug'                   => $common_drug,
            'common_diet'                   => $common_diet,
            'common_return_date'            => $common_return_date,
            'phone_number'                  => $phone_number,
            'college_branch'                => $college_branch,
            'contact_address'               => $contact_address,
            'common_hypersensitivity'       => $common_hypersensitivity,
            'options_for_user'              => $options_for_user,
            'cms_menu_title'                => $cms_menu_title,
            'gap_time_between_appointments' => $gap_time_between_appointments,
            'clinic_doctors_name'           => $clinic_doctors_name ,
            'user_level'                    => $request_level_of_user ,
            'status'                        => $request_status_of_user ,
            'financial_management'          => $financial_management ,
        ]);
    }

    public static function allUsersRelatedToThisSuperAdmin()
    {
        return self::
        where('parent_id',Auth::id())
        ->get();
    }

    public static function runChangePasswordForm($hashed_new_password)
    {
        return self::
        select( [ 'id' , 'name' , 'password' ] )
        ->id(Auth::id())
        ->name(Auth::user()->name)
        ->limit('1')
        ->update(['password' => $hashed_new_password ]);
    }

    public static function makeBanOrActiveThisUserIdByUpdateHisStatus($name_of_user , $id_of_user , $action)
    {
        return self::
        select( [ 'id' , 'name' , 'status' ] )
        ->id($id_of_user)
        ->name($name_of_user)
        ->limit('1')
        ->update([ 'status' => $action ]);
    }

    public static function countExistanceOfParentIdRelatedToThisIdOfUser($id_of_user)
    {
        return self::
        select(['id','parent_id'])
        ->where([ 'id'        => $id_of_user ,
                   'parent_id' => Auth::id() ])
        ->limit('1')
        ->count() ;
    }
}