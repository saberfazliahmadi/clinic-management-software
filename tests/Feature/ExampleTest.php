<?php

namespace Tests\Feature;

use App\Models\User;
use http\Env\Request;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;
use Illuminate\Support\Str;

// ./vendor/bin/phpunit.bat
// $this->withoutExceptionHandling() ;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test()
    {
        //Artisan::call('migrate:refresh') ;
        //Artisan::call('db:seed') ;

        //User::create([
        //    'id' => '101' ,
        //    'name' => 'saber ahmadi',
        //    'email' => 'saber@gmail.com',
        //    'password' => bcrypt('12345678'),
        //    'user_level' => 'global.admin_level' ,
        //    'mobile_number' => '09121009560' ,
        // ]);

        $user = new User([
            'id' => '101' ,
            'name' => 'saber ahmadi',
            'email' => 'saber@gmail.com',
            'password' => bcrypt('12345678'),
            'user_level' => '3' ,
            'mobile_number' => '09121009560' ,
         ]) ;

        $response = $this->actingAs($user)->get(route('login'));
        // $response->assertRedirect(route('home'));

        // $response1 = $this->actingAs($user)->get(route('test'));
        // $response1->assertSee( '09121009560' ) ;

        $response_store_new_patient_form_test = $this->actingAs($user)->post(route('store_new_patient_form_test'),
             [
                'patient_first_name'            => Str::random(10),
                'patient_last_name'             => Str::random(10),
                'patient_mobile_number'         => mt_rand(11111111111, 999999999999) ,
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

        $response_store_new_patient_form_test->assertSessionHasNoErrors();
        $response_store_new_patient_form_test->assertRedirect(route('submit_new_patient_form'));





        //$response->assertRedirectContains('Welcome');

        //$response = $this->get('/login');
        //
        //$response->assertSuccessful();
        //$response->assertViewIs('auth.login');




        // $this->assertEquals('auth.login', $response->original->name());

        // $this->withoutExceptionHandling() ;
        //$box = new Box(['0' => 'ali' , '1' => 'saber' , '2' => 'saba' ]) ;
        //$box = $box->show() ;
        //$response = $this->get(route('home'));
        ////$response->assertRedirect(route('login')) ;
        //$response->assertSee('Welcome')  ;

        //$response = $this->get(route('edit_patient_form' , ['edit_this_patient_id' => '12'])) ;
        //$response->assertRedirect(route('login'));
        //$response = $this->get(route('login'));

        //$response = $this->put(route('update_this_patient' , ['update_this_patient_id' => '12'])) ;
        //$response->assertRedirect(route('login')) ;

        // $response->assertRedirect(route('login')) ;
        // $response->assertStatus(200);
        //$this->assertContains('saber' , $box);
        //$response->assertDontSee('Beta');
    }

    //public function testEHRController()
    //{
    //    $PatientsEHRDocumentController = new PatientsEHRDocumentController() ;
    //    $this->assertTrue($PatientsEHRDocumentController->show_patients_ehr_document_page( )) ;
    //}

    //# Test function for Box class
    //public function testBoxContents()
    //{
    //    $box = new Box(['toy']);
    //    $this->assertTrue($box->has('toy'));
    //    $this->assertFalse($box->has('ball'));
    //}
    //
    //public function testTakeOneFromTheBox()
    //{
    //    $box = new Box(['torch']);
    //    $this->assertEquals('torch', $box->takeOne());
    //
    //    // Null, now the box is empty
    //    $this->assertNull($box->takeOne());
    //}
    //
    //public function testStartsWithALetter()
    //{
    //    $box = new Box(['toy', 'torch', 'ball', 'cat', 'tissue','ss','saba','saber']);
    //
    //    $results = $box->startsWith('s');
    //
    //    $this->assertCount(3, $results);
    //    $this->assertContains('ss', $results);
    //    $this->assertContains('saba', $results);
    //    $this->assertContains('saber', $results);
    //
    //    // Empty array if passed even
    //    $this->assertNotEmpty($box->startsWith('ss'));
    //}

}
