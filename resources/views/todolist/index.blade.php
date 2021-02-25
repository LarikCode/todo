@extends('todolist.todos.layout')

@section('content')
    <div class="flex justify-center border-b border-gray-300 pb-4">
        <a href="/" class="mx-5 py-2 px-1 bg-blue-400 cursor-pointer rounded text-white">
            <span class="fas fa-arrow-left"></span>
        </a>
        <h1 class="text-2xl">All Your to-do lists</h1>
        <a href="{{route('todolist.create')}}" class="mx-5 py-2 px-1 bg-blue-400 cursor-pointer rounded text-white">
            <span class="fas fa-plus-circle"></span>
        </a>
    </div>

    <ul class="my-5">
        <x-alert/>
        @forelse($todoLists as $list)
            <li class="flex justify-between pl-4 pr-2 py-4">
                <div class="flex-auto align-middle">
                    <a href="{{route('todoList.todos.index', $list->id)}}"
                       class="underline text-blue-700 cursor-pointer">
                        <p>{{$list->title}}</p>
                    </a>
                </div>

                <div class="inline-flex">
                    <a href="{{route('todolist.edit', ['todolist' => $list->id])}}"
                       class="text-yellow-500 cursor-pointer">
                        <span class="fas fa-edit px-2"></span>
                    </a>
                    <a href="" class="cursor-pointer">
                        <span class="fas fa-trash text-red-500 px-2" onclick="event.preventDefault();
                            if(confirm('Are you really want to delete?')){
                            document.getElementById('form-delete-{{$list->id}}').submit()
                            }"></span>
                    </a>
                    <form style="display:none" id="{{'form-delete-'.$list->id}}" method="post"
                          action="{{route('todolist.destroy', $list->id)}}">
                        @csrf
                        @method('delete')
                    </form>
                </div>
            </li>
        @empty
            <p>No task lists available, create one.</p>
        @endforelse
    </ul>
@endsection


