<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoCreateRequest;
use App\Models\Todo;
use App\Models\TodoList;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index(TodoList $todoList)
    {
        $todoLists = auth()->user()->todoLists->find($todoList->id);

        $todos = $todoLists->find($todoList->id)->todos->sortBy([
            ['completed', 'asc'],
            ['position', 'desc'],
        ]);
        return view('todolist.todos.index', compact('todos', 'todoLists'));
    }

    public function create(TodoList $todoList)
    {
        return view('todolist.todos.create', compact('todoList'));
    }

    public function edit(TodoList $todoList, Todo $todo)
    {
        return view('todolist.todos.edit', compact('todoList', 'todo'));
    }

    public function store(TodoCreateRequest $request, TodoList $todoList)
    {
        $maxPosition = auth()->user()->todoLists()->find($todoList->id)->todos()->max('position');

        auth()->user()->todoLists()->find($todoList->id)->todos()->create(array_merge($request->all(), [
            'position' => $maxPosition + 1,
            'todo_list_id' => $todoList->id
        ]));

        return redirect()->back()->with('message', 'Todo Created Successfully');
    }

    public function update(TodoCreateRequest $request, TodoList $todoList, Todo $todo)
    {
        auth()->user()->todoLists()->find($todoList->id)->todos()->find($todo->id)->update(['title' => $request->title]);
        return redirect(route('todoList.todos.index', $todoList->id))->with('message', 'Updated!');
    }

    public function complete(Todo $todo)
    {
        $todo->update(['completed' => !$todo->completed]);
        return redirect()->back()->with('message', 'Task Marked as ' . ($todo->completed ? 'completed!' : 'incompleted!'));
    }

    public function destroy(TodoList $todoList, Todo $todo)
    {
        $todo->delete();
        return redirect()->back()->with('message', 'Task Deleted!');
    }

    public function down(TodoList $todoList, Todo $todo)
    {
        $prevPosition = auth()->user()->todoLists()->find($todoList->id)->todos()->where('position', '<', $todo->position)
            ->where('completed', $todo->completed)->max('position');

        if (is_null($prevPosition)) {
            return redirect()->back()->with('error', 'Task can\'t Down!');
        }

        auth()->user()->todoLists()->find($todoList->id)->todos()
            ->where('position', $prevPosition)->first()->update(['position' => $todo->position]);

        $todo->update(['position' => $prevPosition]);

        return redirect()->back()->with('message', 'Task Down!');
    }

    public function up(TodoList $todoList, Todo $todo)
    {
        $nextPosition = auth()->user()->todoLists()->find($todoList->id)->todos()->where('position', '>', $todo->position)
            ->where('completed', $todo->completed)->min('position');

        if (is_null($nextPosition)) {
            return redirect()->back()->with('error', 'Task can\'t Up!');
        }

        auth()->user()->todoLists()->find($todoList->id)->todos()
            ->where('position', $nextPosition)->first()->update(['position' => $todo->position]);

        $todo->update(['position' => $nextPosition]);

        return redirect()->back()->with('message', 'Task Up!');
    }
}
