<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function to_register_Name_email_passwrdd_required()
    {
        $this->json('post', '/api/register')
            ->assertStatus(422)
            ->assertJson(['errors' =>
                [
                'name' => ['The name field is required.'],
                'email' => ['The email field is required.'],
                'password' => ['The password field is required.'],
            ]]);
    }

    /** @test */
    public function user_is_successfully_registered()
    {
        $payload = [
            'name' => 'Tanvir',
            'email' => 'tanvir@tanvir.dk',
            'password' => '123123',
            'password_confirmation' => '123123',
        ];

        $response = $this->json('post', '/api/register', $payload)
            ->assertStatus(201)
            ->assertJsonStructure([
                'data' => [
                    'id',
                    'name',
                    'email',
                    'created_at',
                    'updated_at',
                    'api_token',
                ],
            ]);
    }
}
