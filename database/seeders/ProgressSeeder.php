<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Progress;
use App\Models\User;
use App\Models\Module;

class ProgressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $student = User::where('role', 'student')->first();
        $flutterIntroModule = Module::where('title', 'Pengenalan Flutter')->first();

        // Progress for student on Flutter Introduction module
        Progress::create([
            'user_id' => $student->id,
            'module_id' => $flutterIntroModule->id,
            'completed' => true,
            'score' => 85,
        ]);
    }
}