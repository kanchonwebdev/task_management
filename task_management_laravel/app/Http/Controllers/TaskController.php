<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // Show all task
    public function index(Request $request)
    {
        $query = Task::with('user')->where('user_id', Auth::id());

        if ($request->filled('type') && $request->filled('name')) {
            $query->where($request->type, 'like', '%' . $request->name . '%');
        }

        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('created_at', [$request->start_date, $request->end_date]);
        }

        $collection = $query->paginate(9)->appends($request->query());
        return view('task.index', compact('collection', 'request'));
    }


    // Show form to create a task
    public function create()
    {
        return view('task.create');
    }

    // Store a new task
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'status' => 'required|string|max:255',
        ]);

        Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'user_id' => Auth::id(),
        ]);
        return back()->with('success', 'Task created successfully.');
    }


    // Show a single task
    public function show($id)
    {
        $collection = Task::findOrFail($id);
        return view('task.view', compact('collection'));
    }

    // Show form to edit a task
    public function edit($id)
    {
        $collection = Task::findOrFail($id);
        return view('task.edit', compact('collection'));
    }

    // Update a task
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'status' => 'required|string|max:255',
        ]);

        $task = Task::findOrFail($id);
        $task->update($request->all());
        return back()->with('success', 'Task updated successfully.');
    }

    // Delete a task
    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
        return back()->with('success', 'Task deleted successfully.');
    }
}
