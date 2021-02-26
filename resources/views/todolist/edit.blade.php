@extends('todolist.todos.layout')

@section('content')
    <div class="row justify-center">
        <div class="col-md-7 border border-gray-900 rounded">
            <div class="row justify-center border-b border-gray-300">
                <div class="col">
                    <h1 class="text-2xl  m-4 p-4">Update this todo list</h1>
                </div>
            </div>
            <x-alert/>
            <div class="row">
                <form method="POST" action="{{route('todolist.update', ['todolist' => $todolist->id])}}"
                      class="py-y pt-10">
                    @csrf
                    @method('patch')
                    <input type="text" name="title" value="{{$todolist->title}}" class="py-2 px-2 border rounded">
                    <input type="submit" value="Update" class="p-2 border rounded">
                </form>
            </div>
            <div class="row">
                <div class="my-5">
                    <a href="{{route('todolist.index')}}" class="p-2 no-underline border rounded text-gray-600">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
