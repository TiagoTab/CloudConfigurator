<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AvailabilityTest extends TestCase
{

    /**
     * Check if the api is working
     *
     * @return void
     */
    public function test_the_api_is_available(){
        $response = $this->post('/api/v1/configurator/filtered');
        $response->assertStatus(200);
    }

    /**
     * Check if the api is filtering
     *
     * @return void
     */
    public function test_api_filtering(){
        //TODO TEST
        $response = $this->json('POST', '/api/v1/configurator/filtered',
            [
                "is_available" => 1
            ]
        );
        //wait for response or error
        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'entries'
            ]);
    }

    /**
     * Confirm that the admin page is protected
     *
     * @return void
     */
    public function test_the_admin_required_auth(){
        $responseUnauthenticated = $this->get('/admin/panel');
        $responseUnauthenticated->assertStatus(401);
    }

}
