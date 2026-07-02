<?php

namespace Database\Factories;

use App\Models\Chat;
use App\Models\Message;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Message>
 */
class MessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $chat = Chat::inRandomOrder()->first();

        $userId = random_int(0, 1) ? $chat->sender_uid : $chat->receiver_uid;

        return [
            'chat_id' => $chat->id,
            'user_id' => $userId,
            'text' => fake()->sentence(),
            'created_at' => fake()->dateTimeBetween('-1 month'),
        ];
    }
}
