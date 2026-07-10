<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Vehicle;

class VehiclePolicy
{
    public function viewAny(User $user): bool
    {
        return $user->isStaff();
    }

    public function view(User $user, Vehicle $vehicle): bool
    {
        return $user->isStaff();
    }

    public function create(User $user): bool
    {
        return $user->isStaff();
    }

    public function update(User $user, Vehicle $vehicle): bool
    {
        return $user->isStaff();
    }

    public function delete(User $user, Vehicle $vehicle): bool
    {
        return $user->isAdmin();
    }
}
