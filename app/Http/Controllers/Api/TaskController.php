<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TaskController extends Controller
{
    use AuthorizesRequests;

    public function index(Request $request)
    {
        return Task::where('user_id', $request->user()->id)->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $task = Task::create([
            'title' => $validated['title'],
            'description' => $validated['description'] ?? '',
            'user_id' => $request->user()->id,
        ]);

        return response()->json($task, 201);
    }

    public function show(Task $task)
    {
        $this->authorize('view', $task);
        return $task;
    }

    public function update(Request $request, Task $task)
    {
        $this->authorize('update', $task);
        $task->update($request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]));
        return $task;
    }

    public function destroy(Request $request, $id)
    {
        $task = Task::where('id', $id)->where('user_id', $request->user()->id)->first();

        if (!$task) {
            return response()->json(['error' => 'Failed to delete task'], 404);
        }

        $task->delete();
        return response()->json(['success' => 'Task deleted successfully']);
    }
}
