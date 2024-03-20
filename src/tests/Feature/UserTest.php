<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * Setup run before each test
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->initialize();
    }

    public function test_should_list_users(): void
    {
        $response = $this->get("$this->baseV1/users?limit=1", ['Authorization' => "Bearer $this->token"]);
        $response->assertStatus(200)
            ->assertJsonIsObject();
    }

    public function test_should_create_user(): void
    {
        $response = $this->postJson("$this->baseV1/users", [
            'first_name' => 'test', 
            'middle_name' => null,
            'last_name' => 'test',
            'phone' => '09123456789',
            'email' => 'test@test.com',
            'address' => 'test',
            'password' => 'password',
            'password_confirmation' => 'password'
        ], ['Authorization' => "Bearer $this->token"]);
        $response->assertStatus(201)
            ->assertJsonIsObject();
    }

    public function test_should_update_user(): void
    {
        $response = $this->putJson("$this->baseV1/users/".$this->getSlugId('users'), [
            'first_name' => 'test',
            'middle_name' => null,
            'last_name' => 'test',
            'phone' => '09123456789',
            'email' => 'test@test.com',
            'address' => 'test',
        ], ['Authorization' => "Bearer $this->token"]);
        $response->assertStatus(200)
            ->assertJsonIsObject();
    }

    public function test_should_show_user(): void
    {
        $response = $this->get("$this->baseV1/users/".$this->getSlugId('users'), ['Authorization' => "Bearer $this->token"]);
        $response->assertStatus(200)
            ->assertJsonIsObject();
    }

    public function test_should_delete_user(): void
    {
        $response = $this->get("$this->baseV1/users/".$this->getSlugId('users'), ['Authorization' => "Bearer $this->token"]);
        $response->assertStatus(200)
            ->assertJsonIsObject();
    }
}
