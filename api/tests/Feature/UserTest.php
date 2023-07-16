<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_should_login_user(): void
    {
        $response = $this->postJson(
            '/api/v1/auth/user',
            [
                'user' => 'user',
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
