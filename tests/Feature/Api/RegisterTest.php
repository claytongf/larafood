<?php

namespace Tests\Feature\Api;

use Tests\TestCase;

class RegisterTest extends TestCase
{
    /**
     * Error create new Client.
     *
     * @return void
     */
    public function testErrorCreateNewClient()
    {
        $payload = [
            'name' => 'Clayton',
            'email' => 'clayton@techwing.com.br',
        ];
        $response = $this->postJson('/api/auth/register', $payload);
        // $response->dump();

        $response->assertStatus(422);
        // ->assertExactJson([
            //     'message' => 'The given data was invalid.',
            //     'errors' => [
            //         'password' => [trans('validation.required', ['attribute' => 'password'])]
            //     ]
            // ]);
    }

    /**
     * create new Client.
     *
     * @return void
     */
    public function testSuccessCreateNewClient()
    {
        $payload = [
            'name' => 'Clayton',
            'email' => 'clayton@techwing.com.br',
            'password' => '123456'
        ];
        $response = $this->postJson('/api/auth/register', $payload);
        // $response->dump();

        $response->assertStatus(201)
            ->assertExactJson([
                'data' => [
                    'name' => $payload['name'],
                    'email' => $payload['email']
                ]
            ]);
    }
}
