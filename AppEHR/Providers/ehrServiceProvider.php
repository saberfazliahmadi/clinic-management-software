<?php
namespace AppEHR\Providers;

use Illuminate\Support\ServiceProvider;

class ehrServiceProvider extends ServiceProvider
{
    public function register()
    {
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