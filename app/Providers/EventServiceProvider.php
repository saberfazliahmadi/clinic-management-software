<?php
namespace App\Providers;

use App\Models\patients_general_info;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        // Remember After we make all modules for our app, these types of listeners should be transfer to its module Service Provider
        Event::listen('InSeederOfEhrModuleProvideUserModel' , function ()
        {
            $user = User::select(['id','common_return_date','clinic_doctors_name','common_drug','common_diet','parent_id','user_level'])->where(['parent_id'=>null,'user_level'=>config('global.super_admin_level')])->inRandomOrder()->first();
            return [
                'id'                  => $user->id ,
                'common_return_date'  => $user->common_return_date ,
                'clinic_doctors_name' => $user->clinic_doctors_name ,
                'common_drug'         => $user->common_drug ,
                'common_diet'         => $user->common_diet ,
            ];
        });

        Event::listen('InSeederOfEhrModuleProvidePatientGeneralInfoModel' , function ($payload)
        {
            $patients_general_info = patients_general_info::select(['patient_id','patient_dr_related_id'])->where('patient_dr_related_id',$payload)->inRandomOrder()->first();
            return
            [
                'patient_id'             => $patients_general_info->patient_id ,
                'patient_dr_related_id'  => $patients_general_info->patient_dr_related_id
            ];
        });
    }
}
