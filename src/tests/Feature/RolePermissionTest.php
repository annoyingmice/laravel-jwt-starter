<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class RolePermissionTest extends TestCase
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

    public function test_should_assign_permission(): void
    {
        $response = $this->post("$this->baseV1/role-permissions", ['role_id' => '1', 'permissions' => [1]],['Authorization' => "Bearer $this->token"]);
        $response->assertStatus(200)
            ->assertJsonIsObject()
            ->assertJson(fn (AssertableJson $json) => $json->has('data.permissions'));
    }
}
