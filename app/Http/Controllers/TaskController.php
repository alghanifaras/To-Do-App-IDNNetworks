<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $tasks = Task::latest()->get();
        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'priority' => 'required',
            'status' => 'required',
            'tags' => 'required',
            'due_date' => 'required',
        ],
        [
            'title.required' => 'The title field is required.',
            'description.required' => 'The description field is required.',
            'priority.required' => 'The priority field is required.',
            'status.required' => 'The status field is required.',
            'tags.required' => 'The tags field is required.',
            'due_date.required' => 'The due date field is required.',
        ]);

        $validated['is_important'] = $request->has('is_important');

        Task::create($validated);

        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        //
        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        //
        $validated = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'priority' => 'required',
            'status' => 'required',
            'tags' => 'required',
            'due_date' => 'required',
        ],
        [
            'title.required' => 'The title field is required.',
            'description.required' => 'The description field is required.',
            'priority.required' => 'The priority field is required.',
            'status.required' => 'The status field is required.',
            'tags.required' => 'The tags field is required.',
            'due_date.required' => 'The due date field is required.',
        ]);

        $validated['is_important'] = $request->has('is_important');

        $task->update($validated);

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        //
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }
}
