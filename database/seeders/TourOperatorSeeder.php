<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TourOperatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * Creates one Admin account and one Staff account so you have
     * somewhere to log in immediately.
     *
     * IMPORTANT: change these passwords after first login.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@tourops.test'],
            [
                'name' => 'System Admin',
                'password' => Hash::make('Admin@12345'),
                'role' => UserRole::Admin,
            ]
        );

        User::updateOrCreate(
            ['email' => 'staff@tourops.test'],
            [
                'name' => 'Tour Staff',
                'password' => Hash::make('Staff@12345'),
                'role' => UserRole::Staff,
            ]
        );
    }
}