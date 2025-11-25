<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Classroom;
use App\Models\User;

class ClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teacher = User::where('role', 'teacher')->first();

        // Pemrograman Mobile Class
        Classroom::create([
            'name' => 'Pemrograman Mobile',
            'description' => 'Belajar Flutter & Android Development',
            'teacher_id' => $teacher->id,
        ]);

        // Basis Data Class
        Classroom::create([
            'name' => 'Basis Data',
            'description' => 'Fundamental Database, SQL, dan ERD',
            'teacher_id' => $teacher->id,
        ]);
    }
}