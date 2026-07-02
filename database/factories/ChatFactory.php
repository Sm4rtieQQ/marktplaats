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
        $user1 = Listing::inRandomOrder()
            ->first()
            ->user_id;

        $listing = Listing::where('user_id', $user1)
            ->inRandomOrder()
            ->first();

        $user2 = User::whereNotIn('id', [$user1])
            ->inRandomOrder()
            ->first()
            ->id;

        return [
            'listing_id' => $listing->id,
            'receiver_uid' => $user1,
            'sender_uid' => $user2,
            'created_at' => fake()->dateTimeBetween('-1 month'),
        ];
    }
}
