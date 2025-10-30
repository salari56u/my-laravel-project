<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all(); 
        return view('tasks.index', ['tasks' => $tasks]);
    }

    public function create()
    {

        return view('tasks.form');
    }


    public function store(Request $request)
    {


        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        
        Task::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'is_completed' => $request->has('is_completed'), 
        ]);
        
        return Redirect::route('tasks.index');
    }


    public function show(string $id)
    {
       
        $task = Task::findOrFail($id); 
        return view('tasks.show', ['task' => $task]);
    }


    public function edit(string $id)
    {
 
        $task = Task::findOrFail($id);
        return view('tasks.form', ['task' => $task]);
    }

    public function update(Request $request, string $id)
    {

        $task = Task::findOrFail($id);
        
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $task->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'is_completed' => $request->has('is_completed'),
        ]);

        return Redirect::route('tasks.index');
    }

    public function destroy(string $id)
    {
        $task = Task::findOrFail($id);
        $task->delete(); 
        return Redirect::route('tasks.index');
    }
}
