<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Listing;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Comment>
 */
class CommentFactory extends Factory
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
            'text' => fake()->paragraph(),
            'created_at' => fake()->dateTimeBetween('-1 month'),
        ];
    }
}
