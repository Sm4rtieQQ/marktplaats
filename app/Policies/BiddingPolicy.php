<?php

namespace App\Policies;

use App\Models\Bidding;
use App\Models\User;

class BiddingPolicy
{
    public function delete(User $user, Bidding $bidding): bool
    {
        return $user->id === $bidding->user_id;
    }
}
