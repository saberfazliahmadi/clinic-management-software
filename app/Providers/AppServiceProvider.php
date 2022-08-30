<?php
namespace App\Providers;
use Illuminate\Support\ServiceProvider;

// I added this manually
use Illuminate\Pagination\Paginator;
// use App\LogTypes\LogTypes;
// use Illuminate\Support\Facades\DB;
// use Illuminate\Database\Connection;

class  AppServiceProvider extends ServiceProvider
{
    public function register()
    {

    }

    public function boot()
    {
        Paginator::useBootstrap();

        //// This method works on Laravel 9.x (not less)
        //DB::whenQueryingForLongerThan(500, static function (Connection $connection) {
        //    LogTypes::RunNormalLog("Database queries exceeded 5 seconds on {$connection->getName()}") ;
        //    // or notify the development team...
        //});
    }
}
