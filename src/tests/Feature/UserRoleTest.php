<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class UserRoleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Setup run before each test
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->initialize();
    }

    public function test_should_assign_role(): void
    {
        $response = $this->post("$this->baseV1/user-roles", ['user_id' => '1', 'roles' => [1]],['Authorization' => "Bearer $this->token"]);
        $response->assertStatus(200)
            ->assertJsonIsObject()
            ->assertJson(fn (AssertableJson $json) => $json->has('data.roles'));
    }
}
