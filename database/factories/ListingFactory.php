<?php

namespace Database\Factories;

use App\Models\Listing;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Listing>
 */
class ListingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->sentence(4),
            'description' => fake()->paragraph(),
            'price' => fake()->randomfloat(2, 5, 250),
            'user_id' => User::inRandomOrder()->first()->id,
            'promoted' => fake()->boolean(20),
            'created_at' => fake()->dateTimeBetween('-1 month'),
        ];
    }
}
