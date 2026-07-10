<?php

namespace App\Policies;

use App\Models\TourPackage;
use App\Models\User;

class TourPackagePolicy
{
    public function viewAny(?User $user): bool
    {
        return true;
    }

    public function view(?User $user, TourPackage $tourPackage): bool
    {
        return $tourPackage->status === 'active' || $user?->isStaff();
    }

    public function create(User $user): bool
    {
        return $user->isAdmin();
    }

    public function update(User $user, TourPackage $tourPackage): bool
    {
        return $user->isAdmin();
    }

    public function delete(User $user, TourPackage $tourPackage): bool
    {
        return $user->isAdmin();
    }
}
