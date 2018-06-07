<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function email_and_passowrd_is_required()
    {
        $response = $this->json('POST', 'api/login')
            ->assertStatus(422)
            ->assertJson(
                ['errors' =>
                    [
                    'email' => ['The email field is required.'],
                    'password' => ['The password field is required.'],
                ]]
            );
    }

    /** @test */
    public function successfull_login()
    {
        $user = factory(User::class)->create([
            'email' => 'user@user.com',
            'password' => bcrypt('123123'),
        ]);

        $payload = ['email' => 'user@user.com', 'password' => '123123'];

        $this->json('POST', 'api/login', $payload)
            ->assertStatus(200)
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
