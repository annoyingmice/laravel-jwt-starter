<?php

namespace Tests;

use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected $token;

    /**
     * Indicates whether the default seeder should run before each test.
     *
     * @var bool
     */
    protected $seed = true;

    protected $baseV1 = '/api';

    // @TODO
    // Should run artisan in test env
    // $this->artisan('app:rsa');

    public function initialize(): void
    {
        $this->postJson("$this->baseV1/login", ['phone' => '1234']);
        $response = $this->postJson("$this->baseV1/verify", ['otp' => '123456']);
        $this->token = $response->json()['data']['access_token'];
    }

    /**
     * Helper method to get slug ID
     * @test
     */
    protected function getSlugId(string $uri): string
    {
        $response = $this->get("$this->baseV1/$uri?limit=1", ['Authorization' => "Bearer $this->token"]);
        return $response->json()['data'][0]['slug'];
    }
}
