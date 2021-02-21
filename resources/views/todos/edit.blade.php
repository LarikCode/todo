@extends('todos.layout')

@section('content')
    <h1 class="text-2xl border-b border-gray-300 pb-4">Update this todo list</h1>
    <x-alert />
    <form method="POST" action="{{route('todo.update', $todo->id)}}" class="py-y pt-10">
        @csrf
        @method('patch')
        <input type="text" name="title" value="{{$todo->title}}" class="py-2 px-2 border rounded">
        <input type="submit" value="Update" class="p-2 border rounded">
    </form>
    <div class="justify-center m-5">
        <a href="/todos" class="p-2 border rounded">Back</a>
    </div>

@endsection
