@extends('todos.layout')

@section('content')
    <div class="flex justify-center border-b border-gray-300 pb-4">
        <h1 class="text-2xl">All Your Todos</h1>
        <a href="{{route('todos.create')}}" class="mx-5 py-2 px-1 bg-blue-400 cursor-pointer rounded text-white">
            <span class="fas fa-plus-circle"></span>
        </a>
    </div>

    <ul class="my-5">
        <x-alert/>
        @forelse($todos as $todo)
            <li class="flex justify-between pl-4 pr-2 py-4">
                <div class="inline-flex">
                    <span
                        onclick="event.preventDefault();document.getElementById('form-complete-{{$todo->id}}').submit()"
                        class="fas fa-check text-{{$todo->completed ? 'green-500' : 'gray-300'}} cursor-pointer px-2"></span>
                    <form style="display:none" id="{{'form-complete-'.$todo->id}}" method="post"
                          action="{{route('todos.complete', $todo->id)}}">
                        @csrf
                        @method('put')
                    </form>

                    <span
                        onclick="event.preventDefault();document.getElementById('form-up-{{$todo->id}}').submit()"
                        class="fas fa-arrow-up cursor-pointer px-1"></span>
                    <form style="display:none" id="{{'form-up-'.$todo->id}}" method="post"
                          action="{{route('todos.up', $todo->id)}}">
                        @csrf
                        @method('put')
                    </form>

                    <span
                        onclick="event.preventDefault();document.getElementById('form-down-{{$todo->id}}').submit()"
                        class="fas fa-arrow-down cursor-pointer px-1"></span>
                    <form style="display:none" id="{{'form-down-'.$todo->id}}" method="post"
                          action="{{route('todos.down', $todo->id)}}">
                        @csrf
                        @method('put')
                    </form>
                </div>

                <div class="flex">
                    @if($todo->completed)
                        <p class="line-through" style="text-decoration-color:red; text-decoration-style: wavy;">{{$todo->title}}</p>
                    @else
                        <p>{{$todo->title}}</p>
                    @endif
                </div>


                <div class="inline-flex">
                    <a href="{{route('todos.edit', $todo->id)}}" class="text-yellow-500 cursor-pointer">
                        <span class="fas fa-edit px-2"></span>
                    </a>
                    <a href="{{route('todos.edit', $todo->id)}}" class="cursor-pointer">
                        <span class="fas fa-trash text-red-500 px-2" onclick="event.preventDefault();
                            if(confirm('Are you really want to delete?')){
                            document.getElementById('form-delete-{{$todo->id}}').submit()
                            }"></span>
                    </a>
                    <form style="display:none" id="{{'form-delete-'.$todo->id}}" method="post"
                          action="{{route('todos.destroy', $todo->id)}}">
                        @csrf
                        @method('delete')
                    </form>
                </div>
            </li>
        @empty
            <p>No task available, create one.</p>
        @endforelse
    </ul>
@endsection


