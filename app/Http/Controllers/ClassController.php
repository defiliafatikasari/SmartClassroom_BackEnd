<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\User;
use App\Models\Progress;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    public function index()
    {
        $classes = Classroom::with('teacher')->get();
        return response()->json($classes);
    }

    public function join(Request $request)
    {
        $request->validate([
            'class_id' => 'required|exists:classrooms,id',
        ]);

        // For simplicity, just return success
        // In real app, add to enrollment table
        return response()->json(['message' => 'Joined class successfully']);
    }

    public function show($id)
    {
        $class = Classroom::with('teacher', 'modules')->findOrFail($id);
        return response()->json($class);
    }

    public function students($id)
    {
        $class = Classroom::findOrFail($id);

        // For demo purposes, get all students and their progress for this class
        // In a real app, you'd have an enrollment table
        $students = User::where('role', 'student')
            ->with(['progress' => function($query) use ($id) {
                $query->whereHas('module', function($q) use ($id) {
                    $q->where('class_id', $id);
                });
            }])
            ->get()
            ->map(function($student) use ($id) {
                $classModules = Classroom::find($id)->modules ?? collect();
                $completedModules = $student->progress->where('completed', true)->count();
                $totalModules = $classModules->count();
                $progressPercentage = $totalModules > 0 ? ($completedModules / $totalModules) * 100 : 0;

                return [
                    'id' => $student->id,
                    'name' => $student->name,
                    'email' => $student->email,
                    'completed_modules' => $completedModules,
                    'total_modules' => $totalModules,
                    'progress_percentage' => round($progressPercentage, 2),
                ];
            });

        return response()->json([
            'class' => $class,
            'students' => $students,
        ]);
    }
}
