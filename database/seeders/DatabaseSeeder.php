<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /** In the future, when you will make all modules of your application,
    * you should define & add each one of bellow seeders class inside related service provider of each module that you will create => in register method of service provider you will write something like this => (array_splice(DatabaseSeeder::$seeders, The number of key for example 3 , 0 , [SeederClassNameOfYourModule::class] );),
    * But remember, you should to follow orders of seeders classes, like the below array variable, because these orders will be important when you want to use the php artisan db:seed (they are dependent to each other)
    * You can apply below orders by define "repositories" inside the composer.json file like this code => "repositories": [ { "type": "path", "url": "./AppEHR" },{ "type": "path", "url": "./Module2" },{{ "type": "path", "url": "./Module3" },},{...},... ],
     and Inside each new composer.json file of each new module you will define new service providers of that module **/
    public static $seeders =
    [
        PatientsGeneralInfoSeeder::class,
        PatientsAppointmentSeeder::class,
        FinancialTransactionSeeder::class,
        PatientsPhotoSeeder::class,
    ];

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       User::factory(100)->create();

        foreach(self::$seeders as $seed)
        {
            for($x = 1 ; $x <= config('global.number_of_seeders_reputation_for_loop') ; $x++)
            {
                $this->call([$seed]);
            }
        }
    }
}
