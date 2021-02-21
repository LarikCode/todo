<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoCreateRequest;
use App\Models\Todo;
use http\Env\Request;

class TodoController extends Controller
{
    public function index(){
        $todos = Todo::orderBy('completed')->get();
        return view('todos.index', compact('todos'));
    }

    public function create(){
        return view('todos.create');
    }

    public function edit(Todo $todo){
        //dd($todo->title);
        return view('todos.edit', compact('todo'));
    }

    public function store(TodoCreateRequest $request){
        Todo::create($request->all());
        return redirect()->back()->with('message', 'Todo Created Successfully');
    }

    public function update(TodoCreateRequest $request, Todo $todo)
    {
        //dd($request->all());
        $todo->update(['title' => $request->title]);
        return redirect(route('todo.index'))->with('message', 'Updated!');
    }

    public function complete(Todo $todo){
        $todo->update(['completed' => !$todo->completed]);
        return redirect()->back()->with('message', 'Task Marked as completed!');
    }
}
