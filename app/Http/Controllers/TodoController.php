<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoCreateRequest;
use App\Models\Todo;
use http\Env\Request;

class TodoController extends Controller
{
    public function index()
    {
        $todos = auth()->user()->todos->sortBy('completed');
        //$todos = Todo::orderBy('completed')->get();
        return view('todos.index', compact('todos'));
    }

    public function create()
    {
        return view('todos.create');
    }

    public function edit(Todo $todo)
    {
        return view('todos.edit', compact('todo'));
    }

    public function store(TodoCreateRequest $request)
    {
        auth()->user()->todos()->create($request->all());
        return redirect()->back()->with('message', 'Todo Created Successfully');
    }

    public function update(TodoCreateRequest $request, Todo $todo)
    {
        $todo->update(['title' => $request->title]);
        return redirect(route('todos.index'))->with('message', 'Updated!');
    }

    public function complete(Todo $todo)
    {
        $todo->update(['completed' => !$todo->completed]);
        return redirect()->back()->with('message', 'Task Marked as ' . ($todo->completed ? 'completed!' : 'incompleted!'));
    }

    public function destroy(Todo $todo)
    {
        $todo->delete();
        return redirect()->back()->with('message', 'Task Deleted!');
    }
}
