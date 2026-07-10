<?php

namespace App\Policies;

use App\Models\ItineraryItem;
use App\Models\User;

class ItineraryItemPolicy
{
    public function viewAny(?User $user): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return $user->isAdmin();
    }

    public function update(User $user, ItineraryItem $itineraryItem): bool
    {
        return $user->isAdmin();
    }

    public function delete(User $user, ItineraryItem $itineraryItem): bool
    {
        return $user->isAdmin();
    }
}
