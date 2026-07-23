<?php

namespace App\Policies;

use App\Models\Destination;
use App\Models\User;

class DestinationPolicy
{
    public function viewAny(?User $user): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return $user->isStaff();
    }

    public function update(User $user, Destination $destination): bool
    {
        return $user->isStaff();
    }

    public function delete(User $user, Destination $destination): bool
    {
        return $user->isAdmin();
    }
}