<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use AppEHR\Database\Seeders\PatientsEHRDocumentSeeder;

class DatabaseSeeder extends Seeder
{
    /** In the future, when you will make all modules of your application,
    * you should define each one of bellow seeders class inside related service provider of each module that you have created => in register method of service provider you will write something like this => (DatabaseSeeder::$seeders = SeederClassName::class ;),
    * But remember, you should to follow orders of seeders classes, like the below array variable, because these orders will be important when you want to use the php artisan db:seed
    * You can follow below orders by define service provider inside the config/app.php file 'providers' => [...] **/
    public static $seeders =
    [
        PatientsGeneralInfoSeeder::class,
        PatientsAppointmentSeeder::class,
        PatientsPhotoSeeder::class,
        PatientsEHRDocumentSeeder::class,
        FinancialTransactionSeeder::class,
    ];

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(100)->create();

        foreach(self::$seeders as $seed)
        {
            for($x = 1 ; $x <= config('global.number_of_seeders_reputation_for_loop') ; $x++)
            {
                $this->call([$seed]);
            }
        }
    }
}
