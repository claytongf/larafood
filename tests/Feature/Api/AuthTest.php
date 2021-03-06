<?php

namespace Tests\Feature\Api;

use App\Models\Client;
use Tests\TestCase;
use Illuminate\Support\Str;

class AuthTest extends TestCase
{
    /**
     * Test Validation Auth
     *
     * @return void
     */
    public function testValidationAuth()
    {
        $response = $this->postJson('/api/auth/token');

        $response->assertStatus(422);
    }

    /**
     * Test Auth with faker user
     *
     * @return void
     */
    public function testAuthFakeClient()
    {
        $payload = [
            'email' => 'fasdfads@fakeemail.com',
            'password' => '1234643',
            'device_name' => Str::random(10)
        ];

        $response = $this->postJson('/api/auth/token', $payload);

        $response->assertStatus(404)
            ->assertExactJson([
                'message' => trans('messages.invalid_credentials')
            ]);
    }

    /**
     * Test Auth Success
     *
     * @return void
     */
    public function testAuthSuccess()
    {
        $client = factory(Client::class)->create();

        $payload = [
            'email' => $client->email,
            'password' => 'password',
            'device_name' => Str::random(10)
        ];

        $response = $this->postJson('/api/auth/token', $payload);
        // $response->dump();

        $response->assertStatus(200)
            ->assertJsonStructure(['token']);
    }

    /**
     * Error Get Me
     *
     * @return void
     */
    public function testErrorGetMe()
    {
        $response = $this->getJson('/api/auth/me');

        $response->assertStatus(401);
    }

    /**
     * Get Me
     *
     * @return void
     */
    public function testGetMe()
    {
        $client = factory(Client::class)->create();
        $token = $client->createToken(Str::random(10))->plainTextToken;
        $response = $this->getJson('/api/auth/me', [
            'Authorization' => "Bearer {$token}"
        ]);
        // $response->dump();

        $response->assertStatus(200)
            ->assertExactJson([
                'data' => [
                    'name' => $client->name,
                    'email' => $client->email
                ]
            ]);
    }

    /**
     * Test Logout
     *
     * @return void
     */
    public function testLogout()
    {
        $client = factory(Client::class)->create();
        $token = $client->createToken(Str::random(10))->plainTextToken;
        $response = $this->postJson('/api/auth/logout', [], [
            'Authorization' => "Bearer {$token}"
        ]);
        // $response->dump();

        $response->assertStatus(204);
    }
}
