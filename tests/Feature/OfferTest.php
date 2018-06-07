<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use App\Offer;

class OfferTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function create_offers()
    {
        $user = factory(User::class)->create();
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];
        $offer = factory(Offer::class)->create();

        $response = $this->json('POST', '/api/offers', $offer->toArray(), $headers);

        $response->assertStatus(201);
    }

    /** @test */
    public function offer_can_be_updated()
    {
        $user = factory(User::class)->create();
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];
        $article = factory(Offer::class)->create();

        $payload = [
            'title' => 'Lorem',
            'description' => 'Ipsum',
            'email' => 'Ipsum@foo.com',
            'image' => 'https://www.google.dk/',
        ];

        $response = $this->json('PUT', '/api/offers/' . $article->id, $payload, $headers)
            ->assertStatus(200);
    }

    /** @test */
    public function offers_can_be_deleted()
    {
        $user = factory(User::class)->create();
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];
        $article = factory(Offer::class)->create();

        $this->json('DELETE', '/api/offers/' . $article->id, [], $headers)
            ->assertStatus(204);
    }

    /** @test */
    public function offers_are_listed_correctly()
    {
        factory(Offer::class)->create([
            'title' => 'First Offer'
        ]);

        factory(Offer::class)->create([
            'title' => 'Second Offer'
        ]);

        $user = factory(User::class)->create();
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];

        $response = $this->json('GET', '/api/offers', [], $headers)
            ->assertStatus(200)
            ->assertJson([
                ['title' => 'First Offer'],
                ['title' => 'Second Offer']
            ])
            ->assertJsonStructure([
                '*' => ['id', 'title', 'description', 'email', 'image', 'created_at', 'updated_at'],
            ]);
    }
}
