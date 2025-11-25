<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Progress;
use App\Models\QuizResult;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function index(Request $request)
    {
        $moduleId = $request->query('module_id');
        $quizzes = Quiz::with('module')
            ->when($moduleId, fn($q) => $q->where('module_id', $moduleId))
            ->get();
        return response()->json($quizzes);
    }

    public function submit(Request $request, $id)
    {
        $quiz = Quiz::findOrFail($id);
        $user = $request->user();
        $answers = $request->input('answers', []);

        // Scoring based on question index
        $questions = $quiz->questions_json;
        $score = 0;
        $total = count($questions);

        foreach ($questions as $index => $question) {
            $userAnswer = $answers[$index] ?? null;
            $correctAnswer = $question['answer'] ?? null;

            if ($userAnswer !== null && $userAnswer == $correctAnswer) {
                $score++;
            }
        }

        $percentage = $total > 0 ? ($score / $total) * 100 : 0;
        $passed = $percentage >= 70;

        // Save quiz result
        QuizResult::create([
            'user_id' => $user->id,
            'quiz_id' => $quiz->id,
            'score' => $score,
            'total_questions' => $total,
            'percentage' => round($percentage, 2),
            'passed' => $passed,
            'answers' => $answers,
            'questions' => $questions,
        ]);

        // Update progress
        Progress::updateOrCreate(
            ['user_id' => $user->id, 'module_id' => $quiz->module_id],
            ['score' => $percentage, 'completed' => true]
        );

        return response()->json([
            'score' => $score,
            'total' => $total,
            'percentage' => round($percentage, 2),
            'passed' => $passed,
            'message' => 'Quiz submitted successfully'
        ]);
    }

    public function result($id)
    {
        $user = request()->user();
        $progress = Progress::where('user_id', $user->id)
            ->where('module_id', $id)
            ->first();
        return response()->json($progress);
    }

    public function history(Request $request)
    {
        $user = $request->user();
        $quizId = $request->query('quiz_id');

        $results = QuizResult::with('quiz')
            ->where('user_id', $user->id)
            ->when($quizId, fn($q) => $q->where('quiz_id', $quizId))
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($results);
    }
}
