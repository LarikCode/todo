@extends('todolist.todos.layout')

@section('content')
    <h1 class="text-2xl border-b border-gray-300 pb-4">What next you need To Do</h1>
    <x-alert/>
    <form method="POST" action="{{route('todoList.todos.store', $todoList->id)}}" class="py-5 pt-10">
        @csrf
        <input type="text" name="title" class="py-2 px-2 border rounded">
        <input type="submit" value="Create" class="p-2 border rounded">
    </form>
    <div class="justify-center m-5">
        <a href="{{route('todoList.todos.index', $todoList->id)}}" class="p-2 border rounded">Back</a>
    </div>

@endsection
