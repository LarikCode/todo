@extends('todolist.todos.layout')

@section('content')
    <div class="row justify-center">
        <div class="col-md-7 border border-gray-900 rounded">
            <div class="row justify-center border-b border-gray-300">
                <div class="col-2 my-3">
                    <a href="{{route('todolist.index')}}">
                        <span class="fas fa-arrow-left py-3 px-3 bg-blue-400 cursor-pointer rounded text-white"></span>
                    </a>
                </div>
                <div class="col-8 my-3">
                    <h1 class="text-2xl">{{$todoLists->title}}</h1>
                </div>
                <div class="col-2 my-3">
                    <a href="{{route('todoList.todos.create', $todoLists->id)}}">
                        <span class="fas fa-plus-circle py-3 px-3 bg-blue-400 cursor-pointer rounded text-white"></span>
                    </a>
                </div>
            </div>
            <x-alert/>
            @forelse($todos as $todo)
                <div class="row justify-between my-3">
                    <div class="col-3">
                    <span
                        onclick="event.preventDefault();document.getElementById('form-complete-{{$todo->id}}').submit()"
                        class="fas fa-check text-{{$todo->completed ? 'green-500' : 'gray-300'}} cursor-pointer"></span>
                        <form style="display:none" id="{{'form-complete-'.$todo->id}}" method="post"
                              action="{{route('todos.complete', $todo->id)}}">
                            @csrf
                            @method('put')
                        </form>
                        <span
                            onclick="event.preventDefault();document.getElementById('form-up-{{$todo->id}}').submit()"
                            class="fas fa-arrow-up cursor-pointer"></span>
                        <form style="display:none" id="{{'form-up-'.$todo->id}}" method="post"
                              action="{{route('todos.up', ['todoList' => $todoLists->id, 'todo' => $todo->id])}}">
                            @csrf
                            @method('put')
                        </form>
                        <span
                            onclick="event.preventDefault();document.getElementById('form-down-{{$todo->id}}').submit()"
                            class="fas fa-arrow-down cursor-pointer"></span>
                        <form style="display:none" id="{{'form-down-'.$todo->id}}" method="post"
                              action="{{route('todos.down', ['todoList' => $todoLists->id, 'todo' => $todo->id])}}">
                            @csrf
                            @method('put')
                        </form>
                    </div>
                    <div class="col-7">
                        @if($todo->completed)
                            <p class="line-through"
                               style="text-decoration-color:red; text-decoration-style: wavy;">{{$todo->title}}</p>
                        @else
                            <p>{{$todo->title}}</p>
                        @endif
                    </div>
                    <div class="col-2 inline-flex">
                        <a href="{{route('todoList.todos.edit', ['todoList' => $todoLists->id, 'todo' => $todo->id])}}"
                           class="text-yellow-500 cursor-pointer">
                            <span class="fas fa-edit"></span>
                        </a>
                        <span class="fas fa-trash text-red-500 cursor-pointer px-2 mt-1" onclick="event.preventDefault();
                            if(confirm('Are you really want to delete?')){
                            document.getElementById('form-delete-{{$todo->id}}').submit()
                            }">
                    </span>
                        <form style="display:none" id="{{'form-delete-'.$todo->id}}" method="post"
                              action="{{route('todoList.todos.destroy', ['todoList' => $todoLists->id, 'todo' => $todo->id])}}">
                            @csrf
                            @method('delete')
                        </form>
                    </div>
                </div>
            @empty
                <p>No task available, create one.</p>
            @endforelse
        </div>
    </div>
@endsection


