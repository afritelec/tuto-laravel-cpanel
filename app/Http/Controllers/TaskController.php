<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        return view('tasks', ['tasks' => Task::latest()->get()]);
    }

    public function store(Request $request)
    {
        Task::create($request->validate(['title' => 'required|max:255']));

        return back();
    }

    public function update(Request $request, Task $task)
    {
        $task->update($request->validate(['title' => 'required|max:255']));

        return back();
    }

    public function toggle(Task $task)
    {
        $task->update(['done' => ! $task->done]);

        return back();
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return back();
    }
}
