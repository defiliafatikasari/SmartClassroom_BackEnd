<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\Progress;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    public function index(Request $request)
    {
        $classId = $request->query('class_id');
        $modules = Module::with('classroom')
            ->when($classId, fn($q) => $q->where('class_id', $classId))
            ->get();
        return response()->json($modules);
    }

    public function show($id)
    {
        $module = Module::with('classroom', 'tasks', 'quizzes')->findOrFail($id);
        return response()->json($module);
    }

    public function complete(Request $request, $id)
    {
        $user = $request->user();
        $module = Module::findOrFail($id);

        Progress::updateOrCreate(
            ['user_id' => $user->id, 'module_id' => $id],
            ['completed' => true]
        );

        return response()->json(['message' => 'Module marked as completed']);
    }
}
