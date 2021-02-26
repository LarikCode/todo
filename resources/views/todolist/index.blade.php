@extends('todolist.todos.layout')

@section('content')
    <div class="row justify-center">
        <div class="col-md-7 border border-gray-900 rounded">
            <div class="row justify-center border-b border-gray-300">
                <div class="col-2 my-3">
                    <a href="/">
                        <span class="fas fa-arrow-left py-3 px-3 bg-blue-400 cursor-pointer rounded text-white"></span>
                    </a>
                </div>
                <div class="col-8 my-3">
                    <h1 class="text-2xl">All Your to-do lists</h1>
                </div>
                <div class="col-2 my-3">
                    <a href="{{route('todolist.create')}}">
                        <span class="fas fa-plus-circle py-3 px-3 bg-blue-400 cursor-pointer rounded text-white"></span>
                    </a>
                </div>
            </div>
            <x-alert/>
            @forelse($todoLists as $list)
                <div class="row justify-between my-3">
                    <div class="col-2"></div>
                    <div class="col-8">
                        <a href="{{route('todoList.todos.index', $list->id)}}"
                           class="underline text-blue-700 cursor-pointer">
                            <p>{{$list->title}}</p>
                        </a>
                    </div>
                    <div class="col-2 inline-flex">
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
                </div>
            @empty
                <p>No task lists available, create one.</p>
            @endforelse
        </div>
    </div>
@endsection
