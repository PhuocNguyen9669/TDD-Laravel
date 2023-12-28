@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mb-4">
            <div class="col-md-2 float-left mb-3 p-0">
                <a class="btn btn-primary" href="{{ route('tasks.create') }}">Create Task</a>
            </div>
            <form action="{{route('tasks.index')}}" method="GET">
                <div class="col-md-10 input-group rounded" style="width:80%; height: 80%;">
                    <input type="search" value="{{ request()->search }}" class="form-control rounded" placeholder="Search" aria-label="Search" name="search"
                        aria-describedby="search-addon" />
                    <button class="input-group-text border-0 text-primary" id="search-addon">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>
        </div>
        <div class="row">
            <table class="table table-striped">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Content</th>
                    <th>Actions</th>
                </tr>
                @foreach ($tasks as $task)
                    <th>{{ $task->id }}</th>
                    <th><a href="{{ route('tasks.show', $task->id) }}">{{ $task->name }}</a></th>
                    <th>{{ $task->content }}</th>
                    <th class="d-flex">
                        <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning me-2">Update</a>
                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" onsubmit="return confirm('Are you want to delete task?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger">Delete</button>
                        </form>
                    </th>
                    </tr>
                @endforeach
            </table>
        </div>
        {{ $tasks->links() }}
    </div>
    </div>
@endsection

