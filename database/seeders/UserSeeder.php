<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin User
        User::create([
            'name' => 'Admin Utama',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Teacher User
        User::create([
            'name' => 'Dosen Informatika',
            'email' => 'teacher@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'teacher',
        ]);

        // Student User
        User::create([
            'name' => 'Defilia Fatikasari',
            'email' => 'defiliatika@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'student',
        ]);
    }
}