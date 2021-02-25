<?php

namespace App\Http\Controllers;

use App\Models\TodoList;
use Illuminate\Http\Request;
use App\Http\Requests\TodoCreateRequest;

class TodoListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $todoLists = auth()->user()->todoLists->sortBy('title');
        return view('todolist.index', compact('todoLists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('todolist.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(TodoCreateRequest $request)                  //Request $request)
    {
        auth()->user()->todoLists()->create($request->all());

        return redirect()->back()->with('message', 'Todolist Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\TodoList $todoList
     * @return \Illuminate\Http\Response
     */
    public function show(TodoList $todoList)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\TodoList $todoList
     */
    public function edit(TodoList $todolist)
    {
        return view('todolist.edit', compact('todolist'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param App\Http\Requests\TodoCreateRequest $request
     * @param \App\Models\TodoList $todoList
     */
    public function update(TodoCreateRequest $request, TodoList $todolist)
    {
        auth()->user()->todoLists()->find($todolist->id)->update(['title' => $request->title]);
        return redirect(route('todolist.index'))->with('message', 'Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\TodoList $todoList
     */
    public function destroy(TodoList $todolist)
    {
        $todolist->delete();
        return redirect()->back()->with('message', 'TodoList Deleted!');
    }
}
