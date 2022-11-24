<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class  AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        Paginator::useBootstrap();

        //// This method works on Laravel 9.x (not works on less than 9.x)
        //DB::whenQueryingForLongerThan(500, static function (Connection $connection) {
        //    LogTypes::runNormalLog("Database queries exceeded 5 seconds on {$connection->getName()}") ;
        //    // or notify the development team...
        //});
    }
}
