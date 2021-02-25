@extends('todolist.todos.layout')

@section('content')
    <h1 class="text-2xl border-b border-gray-300 pb-4">Update this todo</h1>
    <x-alert/>
    <form method="POST" action="{{route('todolist.update', ['todolist' => $todolist->id])}}" class="py-y pt-10">
        @csrf
        @method('patch')
        <input type="text" name="title" value="{{$todolist->title}}" class="py-2 px-2 border rounded">
        <input type="submit" value="Update" class="p-2 border rounded">
    </form>
    <div class="justify-center m-5">
        <a href="{{route('todolist.index')}}" class="p-2 border rounded">Back</a>
    </div>

@endsection
