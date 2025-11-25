<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Task;
use App\Models\Module;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $flutterIntroModule = Module::where('title', 'Pengenalan Flutter')->first();
        $providerModule = Module::where('title', 'State Management Provider')->first();
        $sqlModule = Module::where('title', 'Dasar SQL')->first();
        $joinModule = Module::where('title', 'Join & Relasi Tabel')->first();

        // Tasks for Flutter Introduction Module
        Task::create([
            'module_id' => $flutterIntroModule->id,
            'title' => 'Tugas 1: Membuat UI Login',
            'description' => 'Buat halaman login Flutter dengan input validation',
            'due_date' => '2025-12-31',
        ]);

        // Tasks for Provider Module
        Task::create([
            'module_id' => $providerModule->id,
            'title' => 'Tugas 2: Implementasi Provider',
            'description' => 'Implementasikan state management menggunakan Provider pattern',
            'due_date' => '2025-12-31',
        ]);

        // Tasks for SQL Module
        Task::create([
            'module_id' => $sqlModule->id,
            'title' => 'Tugas 3: Query Dasar SQL',
            'description' => 'Buat query SELECT, INSERT, UPDATE, DELETE untuk tabel mahasiswa',
            'due_date' => '2025-12-31',
        ]);

        // Tasks for Join Module
        Task::create([
            'module_id' => $joinModule->id,
            'title' => 'Tugas 4: Query JOIN',
            'description' => 'Buat query JOIN untuk menggabungkan tabel mahasiswa dan nilai',
            'due_date' => '2025-12-31',
        ]);
    }
}