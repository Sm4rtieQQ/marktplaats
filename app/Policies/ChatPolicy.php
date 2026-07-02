<?php

namespace App\Policies;

use App\Models\Chat;
use App\Models\User;

class ChatPolicy
{
    public function view(User $user, Chat $chat)
    {
        return $user->id === $chat->sender_uid | $user->id === $chat->receiver_uid;
    }
}
