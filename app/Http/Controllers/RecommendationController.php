<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\Progress;
use Illuminate\Http\Request;

class RecommendationController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        // Get completed modules
        $completed = Progress::where('user_id', $user->id)
            ->where('completed', true)
            ->pluck('module_id');

        // Recommend next modules: not completed, or with low score
        $recommendations = Module::with('classroom')
            ->whereNotIn('id', $completed)
            ->orWhereHas('progress', function($q) use ($user) {
                $q->where('user_id', $user->id)->where('score', '<', 70);
            })
            ->take(5)
            ->get();

        return response()->json($recommendations);
    }
}
