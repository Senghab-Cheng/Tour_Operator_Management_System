<?php

namespace App\Policies;

use App\Models\TourSchedule;
use App\Models\User;

class TourSchedulePolicy
{
    public function viewAny(?User $user): bool
    {
        return true;
    }

    public function view(?User $user, TourSchedule $tourSchedule): bool
    {
        return $tourSchedule->status === 'scheduled' || $user?->isStaff();
    }

    public function create(User $user): bool
    {
        return $user->isStaff();
    }

    public function update(User $user, TourSchedule $tourSchedule): bool
    {
        return $user->isStaff();
    }

    public function delete(User $user, TourSchedule $tourSchedule): bool
    {
        return $user->isStaff();
    }
}
