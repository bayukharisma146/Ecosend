<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Admin Ecosend',
            'email' => 'admin@ecosend.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        // User biasa
        User::create([
            'name' => 'User Biasa',
            'email' => 'user@ecosend.com',
            'password' => Hash::make('user123'),
            'role' => 'user',
        ]);
    }
}
