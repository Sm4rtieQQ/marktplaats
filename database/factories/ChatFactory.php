<?php

namespace Database\Factories;

use App\Models\Chat;
use App\Models\Listing;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Chat>
 */
class ChatFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user1 = User::inRandomOrder()->first()->id;
        $user2 = User::inRandomOrder()->whereNotIn('id', [$user1])->first()->id;

        $userIds = collect([$user1, $user2])->sort()->implode('_');

        return [
            'listing_id' => Listing::inRandomOrder()->first()->id,
            'user_ids' => $userIds,
            'created_at' => fake()->dateTimeBetween('-1 month'),
        ];
    }
}
