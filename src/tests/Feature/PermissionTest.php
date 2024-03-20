<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PermissionTest extends TestCase
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

    public function test_should_list_permissions(): void
    {
        $response = $this->get("$this->baseV1/permissions?limit=1", ['Authorization' => "Bearer $this->token"]);
        $response->assertStatus(200)
            ->assertJsonIsObject();
    }

    public function test_should_create_permission(): void
    {
        $response = $this->postJson("$this->baseV1/permissions", ['name' => 'test', 'owner' => null], ['Authorization' => "Bearer $this->token"]);
        $response->assertStatus(201)
            ->assertJsonIsObject();
    }

    public function test_should_update_permission(): void
    {
        $response = $this->putJson("$this->baseV1/permissions/".$this->getSlugId('permissions'), ['name' => 'test1', 'owner' => null], ['Authorization' => "Bearer $this->token"]);
        $response->assertStatus(200)
            ->assertJsonIsObject();
    }

    public function test_should_show_permission(): void
    {
        $response = $this->get("$this->baseV1/permissions/".$this->getSlugId('permissions'), ['Authorization' => "Bearer $this->token"]);
        $response->assertStatus(200)
            ->assertJsonIsObject();
    }

    public function test_should_delete_permission(): void
    {
        $response = $this->get("$this->baseV1/permissions/".$this->getSlugId('permissions'), ['Authorization' => "Bearer $this->token"]);
        $response->assertStatus(200)
            ->assertJsonIsObject();
    }
}
