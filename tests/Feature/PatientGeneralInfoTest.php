<?php
namespace Tests\Feature;
use App\Models\patients_general_info;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;

// ./vendor/bin/phpunit.bat
// $this->withoutExceptionHandling() ;
// $ php artisan test --filter test1 tests/Feature/ExampleTest.php
// $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
// $response->assertValidationErrors(['title']);
// $this->assertDatabaseHas('posts', [ 'title' => 'test', 'body' => 'this is a test' ]);
// $this->assertDatabaseMissing('deposito',['id_deposito'=> $deposit->id_deposito]);
// Artisan::call('migrate:refresh') ;
// Artisan::call('db:seed') ;
// $response_of_view = $this->view('back.test');
// $response_of_view->assertSee(Auth::user()->name);
// $response->dumpHeaders();
// $response->dumpSession();
// $response->dump();
// $response_store_new_patient_form_test->assertSessionHasNoErrors();
// $response->assertRedirectContains('Welcome');
// $this->actingAs($user , 'web' )->post(route('login') , [ 'email' => $user->email, 'password' => 'password', ] );
// Carbon::setTestNow(now()->endOfDay()->addSecond());
// $this->assertAuthenticatedAs($user);
/** Inside this folder, each test class is named as <name>Test.php.
 * This format allows PHPUnit to find each test class—it will ignore anything that does not end in Test.php.
 */
class ExampleTest extends TestCase
{
    use WithFaker;
    // use RefreshDatabase;
    // use WithoutMiddleware;

    public function setUp(): void
    {
        parent::setUp();

        DB::beginTransaction();

        $user = User::factory()->create();
        Auth::loginUsingId($user->id);
    }

    public function tearDown(): void
    {
        Auth::logout();

        DB::rollBack();

        parent::tearDown();
    }

    public function test_should_allow_an_authenticated_user_to_store_new_patient_information()
    {
        $patient_first_name    = $this->faker->name ;
        $patient_last_name     = $this->faker->lastName ;
        $patient_mobile_number = $this->faker->numerify('+90(###)###########');

        $counted_before_insert_data = patients_general_info::all()->count() ;

        $response = $this->post( route('patients.store' ), [
            'patient_first_name'            => $patient_first_name ,
            'patient_last_name'             => $patient_last_name ,
            'patient_mobile_number'         => $patient_mobile_number ,
            'patient_nationality_number'    => NULL ,
            'patient_last_appointment_date' => NULL ,
            'patient_birth_day'             => NULL ,
            'patient_address'               => NULL ,
            'patient_phone_number'          => NULL ,
            'patient_email_address'         => NULL ,
            'patient_relationship_status'   => NULL ,
            'patient_gender'                => NULL ,
            'patient_surgery_history'       => NULL ,
            'patient_disease_background'    => NULL ,
            'patient_medication_history'    => NULL ,
            'patient_allergies_history'     => NULL ,
            'patient_more_description'      => NULL ,
            '_token'                        => csrf_token() ,
            '_method'                       => 'put' ,
        ]);

        $counted_after_insert_data = patients_general_info::all()->count() ;

        $this->assertAuthenticated();
        $this->assertDatabaseHas('patients_general_infos', [ 'patient_first_name' => $patient_first_name, 'patient_last_name' => $patient_last_name, 'patient_mobile_number' => $patient_mobile_number ]);
        $this->assertEquals( $counted_after_insert_data ,$counted_before_insert_data + 1 );
        $response->assertStatus(302);
        $response->assertRedirect(route('patients.create')) ;
        // $this->followRedirects($response)->assertsee('Successfullysss Submittedsss') ;

    }

    public function test_should_check_an_unauthenticated_user_can_not_store_new_patient_information()
    {
        Auth::logout();

        $patient_first_name    = $this->faker->name ;
        $patient_last_name     = $this->faker->lastName ;
        $patient_mobile_number = $this->faker->numerify('+90(###)###########');

        $counted_before_insert_data = patients_general_info::all()->count() ;

        $response = $this->post( route('patients.store'), [
            'patient_first_name'            => $patient_first_name ,
            'patient_last_name'             => $patient_last_name ,
            'patient_mobile_number'         => $patient_mobile_number ,
            'patient_nationality_number'    => NULL ,
            'patient_last_appointment_date' => NULL ,
            'patient_birth_day'             => NULL ,
            'patient_address'               => NULL ,
            'patient_phone_number'          => NULL ,
            'patient_email_address'         => NULL ,
            'patient_relationship_status'   => NULL ,
            'patient_gender'                => NULL ,
            'patient_surgery_history'       => NULL ,
            'patient_disease_background'    => NULL ,
            'patient_medication_history'    => NULL ,
            'patient_allergies_history'     => NULL ,
            'patient_more_description'      => NULL ,
            '_token'                        => csrf_token() ,
            '_method'                       => 'put' ,
        ]);

        $counted_after_insert_data = patients_general_info::all()->count() ;

        $this->assertGuest();
        $this->assertDatabaseMissing('patients_general_infos', [ 'patient_first_name' => $patient_first_name, 'patient_last_name' => $patient_last_name, 'patient_mobile_number' => $patient_mobile_number ]);
        $this->assertEquals($counted_after_insert_data , $counted_before_insert_data );
        $response->assertStatus(302);
        $response->assertRedirect(route('login')) ;
    }

    public function test_should_check_validation_rules_of_submit_patient_form_works_well()
    {

    }

    public function test_should_check_user_can_not_see_patients_of_other_clinics()
    {

    }

    public function test_should_check_user_can_not_edit_patient_info_of_other_clinics()
    {

    }

    public function test_should_check_user_can_not_delete_patient_document_of_other_clinics()
    {

    }

    public function test_should_check_blocked_user_can_not_do_anything()
    {

    }

}
