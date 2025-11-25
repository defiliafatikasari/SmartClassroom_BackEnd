<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
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
}
