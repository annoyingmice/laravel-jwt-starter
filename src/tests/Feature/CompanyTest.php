<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CompanyTest extends TestCase
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

    public function test_should_list_companies(): void
    {
        $response = $this->get("$this->baseV1/v1/companies?limit=1", ['Authorization' => "Bearer $this->token"]);
        $response->assertStatus(200)
            ->assertJsonIsObject();
    }

    public function test_should_create_company(): void
    {
        $response = $this->postJson("$this->baseV1/v1/companies", [
            'avatar' => null,
            'cover' => null,
            'name' => $this->faker->unique()->company,
            'email' => $this->faker->unique()->safeEmail,
            'tel' => $this->faker->unique()->phoneNumber,
            'phone' => $this->faker->unique()->phoneNumber,
            'address' => $this->faker->address,
        ], ['Authorization' => "Bearer $this->token"]);
        $response->assertStatus(201)
            ->assertJsonIsObject();
    }

    public function test_should_update_company(): void
    {
        $response = $this->putJson("$this->baseV1/v1/companies/".$this->getSlugId('v1/companies'), [
            'avatar' => null,
            'cover' => null,
            'name' => $this->faker->unique()->company,
            'email' => $this->faker->unique()->safeEmail,
            'tel' => $this->faker->unique()->phoneNumber,
            'phone' => $this->faker->unique()->phoneNumber,
            'address' => $this->faker->address,
        ], ['Authorization' => "Bearer $this->token"]);

        $response->assertStatus(200)
            ->assertJsonIsObject();
    }

    public function test_should_show_company(): void
    {
        $response = $this->get("$this->baseV1/v1/companies/".$this->getSlugId('v1/companies'), ['Authorization' => "Bearer $this->token"]);
        $response->assertStatus(200)
            ->assertJsonIsObject();
    }

    public function test_should_delete_company(): void
    {
        $response = $this->get("$this->baseV1/v1/companies/".$this->getSlugId('v1/companies'), ['Authorization' => "Bearer $this->token"]);
        $response->assertStatus(200)
            ->assertJsonIsObject();
    }
}
