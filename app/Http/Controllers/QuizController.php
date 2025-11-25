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

        // Simple scoring: assume correct if answer is 'a'
        $questions = $quiz->questions_json;
        $score = 0;
        foreach ($questions as $q) {
            if (isset($answers[$q['id']]) && $answers[$q['id']] == $q['correct']) {
                $score++;
            }
        }
        $total = count($questions);
        $percentage = $total > 0 ? ($score / $total) * 100 : 0;

        // Update progress
        Progress::updateOrCreate(
            ['user_id' => $user->id, 'module_id' => $quiz->module_id],
            ['score' => $percentage]
        );

        return response()->json([
            'score' => $score,
            'total' => $total,
            'percentage' => $percentage
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
