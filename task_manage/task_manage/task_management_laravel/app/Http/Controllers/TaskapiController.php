<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class TaskapiController extends Controller
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
        return response()->json($collection);
    }


    // Show form to create a task
    public function create()
    {
        return response()->json('done');
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

        return response()->json('Task created successfully.');
    }


    // Show a single task
    public function show($id)
    {
        $collection = Task::findOrFail($id);
        return response()->json($collection);
    }

    // Show form to edit a task
    public function edit($id)
    {
        $collection = Task::findOrFail($id);
        return response()->json($collection);
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
        return response()->json('Task updated successfully.');
    }

    // Delete a task
    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
        return response()->json('Task deleted successfully.');
    }
}
