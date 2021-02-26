@extends('todolist.todos.layout')

@section('content')
    <div class="row justify-center">
        <div class="col-md-7 border border-gray-900 rounded">
            <div class="row justify-center border-b border-gray-300">
                <div class="col">
                    <h1 class="text-2xl m-4 p-4">To-do list name</h1>
                </div>
            </div>
            <x-alert/>
            <div class="row m-3">
                <form method="POST" action="{{route('todolist.store')}}" class="py-3 pt-10">
                    @csrf
                    <input type="text" name="title" class="py-2 px-2 border rounded">
                    <input type="submit" value="Create" class="p-2 border rounded">
                </form>
            </div>
            <div class="row my-3">
                <div class="my-1">
                    <a href="{{route('todolist.index')}}" class="p-2 no-underline border rounded text-gray-600">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
