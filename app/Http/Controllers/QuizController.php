<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Progress;
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

        // Update progress
        Progress::updateOrCreate(
            ['user_id' => $user->id, 'module_id' => $quiz->module_id],
            ['score' => $percentage, 'completed' => true]
        );

        return response()->json([
            'score' => $score,
            'total' => $total,
            'percentage' => round($percentage, 2),
            'passed' => $percentage >= 70 // Assuming 70% is passing grade
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
}
