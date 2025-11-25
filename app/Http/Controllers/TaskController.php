<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $moduleId = $request->query('module_id');
        $tasks = Task::with('module')
            ->when($moduleId, fn($q) => $q->where('module_id', $moduleId))
            ->get();
        return response()->json($tasks);
    }

    public function submit(Request $request, $id)
    {
        $task = Task::findOrFail($id);
        // For simplicity, just return success
        // In real app, store submission
        return response()->json(['message' => 'Task submitted successfully']);
    }
}
