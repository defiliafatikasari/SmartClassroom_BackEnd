<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\RecommendationController;

// Public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/profile', [AuthController::class, 'profile']);

    // Class routes
    Route::get('/classes', [ClassController::class, 'index']);
    Route::post('/classes/join', [ClassController::class, 'join']);
    Route::get('/classes/{id}', [ClassController::class, 'show']);

    // Module routes
    Route::get('/modules', [ModuleController::class, 'index']);
    Route::get('/modules/{id}', [ModuleController::class, 'show']);
    Route::post('/modules/{id}/complete', [ModuleController::class, 'complete']);

    // Task routes
    Route::get('/tasks', [TaskController::class, 'index']);
    Route::post('/tasks/{id}/submit', [TaskController::class, 'submit']);

    // Quiz routes
    Route::get('/quizzes', [QuizController::class, 'index']);
    Route::post('/quizzes/{id}/submit', [QuizController::class, 'submit']);
    Route::get('/quizzes/{id}/result', [QuizController::class, 'result']);

    // Recommendation routes
    Route::get('/recommendations', [RecommendationController::class, 'index']);
});
