<?php

namespace Database\Seeders;

use App\Models\Chat;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Chat::factory(30)->create()->each(function ($chat) {
            $userIds = explode('_', $chat->user_ids);

            $chat->users()->attach($userIds);
        });
    }
}
