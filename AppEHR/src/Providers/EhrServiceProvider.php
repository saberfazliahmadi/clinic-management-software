<?php
namespace AppEHR\Providers;

use AppEHR\Interfaces\EHRRepositoryInterface;
use AppEHR\Repositories\EHRRepository ;
use Illuminate\Support\ServiceProvider;
use AppEHR\Http\Middleware\CheckValidityOfEHRID ;
use Database\Seeders\DatabaseSeeder;
use AppEHR\Database\Seeders\PatientsEHRDocumentSeeder;

class EhrServiceProvider extends ServiceProvider
{
    public function register()
    {
        /** To use MYSQL database we bind EHRRepository::class
        If in the future, you decide to use a new type of database which Laravel does not support that
        You can change EHRRepository::class to your DesiredRepository::class here via Repository Pattern Strategy that we have used in this Module **/
        app()->bind(EHRRepositoryInterface::class,EHRRepository::class);
    }

    public function boot()
    {
        // $this->app()->make(Factory::class)->load(PatientsEHRDocumentFactory::class);
        // DatabaseSeeder::$seeders = PatientsEHRDocumentSeeder::class;
        $this->loadRoutesFrom(base_path('AppEHR/src/Routes/web.php'));
        $this->loadMigrationsFrom(base_path('AppEHR/src/Database/Migrations/2022_01_31_134829_create_patients_e_h_r_documents_table.php'));
        $this->loadViewsFrom(base_path('AppEHR/src/Views'),'EHR');
        // Define a new middleware specifically for EHR Module (you should remove it from Kernel.php)
        app('router')->aliasMiddleware('CheckValidityOfEHRID',CheckValidityOfEHRID::class);
    }
}