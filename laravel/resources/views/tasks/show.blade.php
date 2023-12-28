@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mb-4">
            <div class="col-md-2 float-left mb-3 p-0">
                <a class="btn btn-primary" href="{{ route('tasks.create') }}">Create Task</a>
            </div>
            <div class="col-md-10 input-group rounded" style="width:80%; height: 80%;">
                <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search"
                    aria-describedby="search-addon" />
                <span class="input-group-text border-0 text-primary" id="search-addon">
                    <i class="fas fa-search"></i>
                </span>
            </div>
        </div>
        <div class="row">
            <table class="table table-striped">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Content</th>
                    <th>Actions</th>
                </tr>
                <th>{{ $task->id }}</th>
                <th>{{ $task->name }}</th>
                <th>{{ $task->content }}</th>
                <th class="d-flex">
                    <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning me-2">Update</a>
                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger">Delete</button>
                    </form>
                </th>
                </tr>
            </table>
        </div>
    </div>
    </div>
@endsection
