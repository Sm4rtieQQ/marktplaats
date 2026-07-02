<?php

namespace App\Policies;

use App\Models\Listing;
use App\Models\User;

class ListingPolicy
{
    public function edit(User $user, Listing $listing)
    {
        return $user->id === $listing->user_id;
    }

    public function chat(User $user, Listing $listing)
    {
        return $user->id !== $listing->user_id;
    }
}
