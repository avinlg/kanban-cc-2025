<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        return Task::orderBy('order')->get();
    }

    public function store(Request $request)
    {
        $task = Task::create($request->all());
        return response()->json($task, 201);
    }

    public function update(Request $request, Task $task)
    {
        $task->update($request->all());
        return response()->json($task);
    }

    public function destroy(Task $task)
    {
        $task->delete(); // Soft delete
        return response()->json(null, 204);
    }

    public function reorder(Request $request)
    {
        foreach ($request->tasks as $order => $id) {
            Task::where('id', $id)->update(['order' => $order]);
        }
        return response()->json(['message' => 'Reordered successfully']);
    }
}
