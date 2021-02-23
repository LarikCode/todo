<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoCreateRequest;
use App\Models\Todo;
use http\Env\Request;

class TodoController extends Controller
{
    public function index()
    {
        $todos = auth()->user()->todos->sortBy([
            ['completed', 'asc'],
            ['position', 'desc'],
        ]);
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
        $maxPosition = auth()->user()->todos()->max('position');
        auth()->user()->todos()->create(array_merge($request->all(), [
            'position' => $maxPosition + 1,
        ]));
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

    public function down(Todo $todo)
    {
        $prevPosition = auth()->user()->todos()->where('position', '<', $todo->position)
            ->where('completed', $todo->completed)->max('position');
        if (is_null($prevPosition)) {
            return redirect()->back()->with('error', 'Task can\'t Down!');
        }
        $prevTodo = auth()->user()->todos()->where('position', $prevPosition)->first();
        $prevTodo->position = $todo->position;
        $prevTodo->save();
        $todo->update(['position' => $prevPosition]);
        return redirect()->back()->with('message', 'Task Down!');
    }

    public function up(Todo $todo)
    {
        $nextPosition = auth()->user()->todos()->where('position', '>', $todo->position)
            ->where('completed', $todo->completed)->min('position');
        if (is_null($nextPosition)) {
            return redirect()->back()->with('error', 'Task can\'t Up!');
        }
        $prevTodo = auth()->user()->todos()->where('position', $nextPosition)->first();
        $prevTodo->position = $todo->position;
        $prevTodo->save();
        $todo->update(['position' => $nextPosition]);
        return redirect()->back()->with('message', 'Task Up!');
    }
}
