<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Module;
use App\Models\Classroom;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mobileClass = Classroom::where('name', 'Pemrograman Mobile')->first();
        $databaseClass = Classroom::where('name', 'Basis Data')->first();

        // Modules for Pemrograman Mobile
        Module::create([
            'class_id' => $mobileClass->id,
            'title' => 'Pengenalan Flutter',
            'type' => 'pdf',
            'content_url' => 'https://repository.unas.ac.id/id/eprint/11255/1/Mobile%20Programming%20Menggunakan%20Flutter%20dan%20Visual%20Studio%20Code%20Untuk%20Pemula.pdf',
        ]);

        Module::create([
            'class_id' => $mobileClass->id,
            'title' => 'State Management Provider',
            'type' => 'text',
            'content_url' => 'Dasar state management Provider',
        ]);

        // Modules for Basis Data
        Module::create([
            'class_id' => $databaseClass->id,
            'title' => 'Dasar SQL',
            'type' => 'pdf',
            'content_url' => 'https://example.com/sql-basic.pdf',
        ]);

        Module::create([
            'class_id' => $databaseClass->id,
            'title' => 'Join & Relasi Tabel',
            'type' => 'video',
            'content_url' => 'https://youtube.com/tutorial-sql-join',
        ]);
    }
}