<?php
namespace AppEHR\Providers;
use AppEHR\Interfaces\EHRRepositoryInterface;
use AppEHR\Repositories\EHRRepository ;
use Illuminate\Support\ServiceProvider;
class ehrServiceProvider extends ServiceProvider
{
    public function register()
    {
        /** To use MYSQL database we bind EHRRepository::class
        If in the future, you decide to use a new type of database which Laravel does not support that
        You can change EHRRepository::class to your DesiredRepository::class here behind Repository Pattern Strategy that we used **/
        app()->bind( EHRRepositoryInterface::class , EHRRepository::class );
    }

    public function boot()
    {
        $this->loadMigrationsFrom(
            base_path('AppEHR/Migrations/2022_01_31_134829_create_patients__e_h_r_documents_table.php')
        );

        $this->loadViewsFrom(
            base_path('AppEHR/Views') , 'EHR'
        );
    }
}