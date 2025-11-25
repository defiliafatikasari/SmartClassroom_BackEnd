<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Quiz;
use App\Models\Module;

class QuizSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil modul
        $flutterIntroModule = Module::where('title', 'Pengenalan Flutter')->first();
        $providerModule = Module::where('title', 'State Management Provider')->first();
        $sqlModule = Module::where('title', 'Dasar SQL')->first();
        $joinModule = Module::where('title', 'Join & Relasi Tabel')->first();

        // Quiz untuk modul Flutter Introduction
        $flutterQuestions = [
            [
                "question" => "Apa itu widget di Flutter?",
                "options" => ["Class", "Library", "Framework", "Component"],
                "answer" => 3
            ],
            [
                "question" => "Apa fungsi Pubspec?",
                "options" => ["Style", "Dependency", "Database", "Image"],
                "answer" => 1
            ],
            [
                "question" => "Widget apa yang digunakan untuk layout vertikal?",
                "options" => ["Row", "Column", "Stack", "Container"],
                "answer" => 1
            ]
        ];

        Quiz::create([
            'module_id' => $flutterIntroModule->id,
            'title' => 'Quiz Flutter Dasar',
            'questions_json' => $flutterQuestions,
        ]);

        // Quiz untuk modul Provider
        $providerQuestions = [
            [
                "question" => "Apa itu Provider di Flutter?",
                "options" => ["Database", "State Management", "Router", "Animation"],
                "answer" => 1
            ],
            [
                "question" => "Method apa yang digunakan untuk notify listeners?",
                "options" => ["setState", "notifyListeners", "updateState", "refresh"],
                "answer" => 1
            ]
        ];

        Quiz::create([
            'module_id' => $providerModule->id,
            'title' => 'Quiz State Management',
            'questions_json' => $providerQuestions,
        ]);

        // Quiz untuk modul SQL
        $sqlQuestions = [
            [
                "question" => "Perintah SQL untuk memilih data adalah?",
                "options" => ["INSERT", "UPDATE", "SELECT", "DELETE"],
                "answer" => 2
            ],
            [
                "question" => "Kunci utama (Primary Key) adalah?",
                "options" => ["Kolom unik", "Kolom yang bisa kosong", "Kolom duplikat", "Kolom teks"],
                "answer" => 0
            ]
        ];

        Quiz::create([
            'module_id' => $sqlModule->id,
            'title' => 'Quiz SQL Dasar',
            'questions_json' => $sqlQuestions,
        ]);

        // Quiz untuk modul Join
        $joinQuestions = [
            [
                "question" => "JOIN apa yang menampilkan semua data dari kedua tabel?",
                "options" => ["INNER JOIN", "LEFT JOIN", "RIGHT JOIN", "FULL OUTER JOIN"],
                "answer" => 3
            ],
            [
                "question" => "Foreign Key digunakan untuk?",
                "options" => ["Membuat index", "Menghubungkan tabel", "Menyimpan file", "Validasi data"],
                "answer" => 1
            ]
        ];

        Quiz::create([
            'module_id' => $joinModule->id,
            'title' => 'Quiz JOIN & Relasi',
            'questions_json' => $joinQuestions,
        ]);
    }
}
