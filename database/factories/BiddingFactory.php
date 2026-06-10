<?php

namespace Database\Factories;

use App\Models\Bidding;
use App\Models\Listing;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Bidding>
 */
class BiddingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'listing_id' => Listing::inRandomOrder()->first()->id,
            'user_id' => User::inRandomOrder()->first()->id,
            'bid' => fake()->randomfloat(2, 0, 200),
        ];
    }
}
