<?php

use Illuminate\Database\Seeder;
use App\Offer;

class OffersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Let's truncate our existing records to start from scratch.
        Offer::truncate();

        $faker = \Faker\Factory::create();

        // And now, let's create a few articles in our database:
        for ($i = 0; $i < 50; $i++) {
            Offer::create([
                'title' => $faker->sentence,
                'description' => $faker->paragraph,
                'email' => $faker->email,
                'image' => $faker->url,
            ]);
        }
    }
}
