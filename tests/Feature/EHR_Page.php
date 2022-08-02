<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EHR_Page extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/show_patients_ehr_document_page/NG0razhIRDgwV0FyS0JyRjQ4M2YzZz09');

        $response->assertStatus(200);
        // $response->assertSee('Alpha');
        $response->assertDontSee('Beta');
    }
}
