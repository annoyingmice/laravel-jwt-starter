<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HealthcheckTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_should_response_200(): void
    {
        $response = $this->getJson('/api/healthcheck');

        $response->assertStatus(200)
            ->assertJson(['ok' => true]);
    }
}
