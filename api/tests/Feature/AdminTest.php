<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_should_login_admin(): void
    {
        $response = $this->postJson(
            '/api/v1/auth/admin',
            [
                'user' => 'admin',
                'password' => 'password'
            ],
            [
                'content-type' => 'application/json',
                'accept' => 'application/json'
            ]
        );
        $response->dump();
        $response->assertStatus(200)
            ->assertSee('token');
    }
}
