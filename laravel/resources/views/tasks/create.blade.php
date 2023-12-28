@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2>Create task</h2>
                <form action="{{ route('tasks.store') }}" method="POST">
                    @csrf
                    <div class="card">
                        <div class="card-body">
                            <input type="text" name="name" id="name" class="form-group" placeholder="Name ...">
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="card-body">
                            <input type="text" name="content" id="content" class="form-group"
                                placeholder="Content ...">
                        </div>
                    </div>
                    <button class="btn btn-success">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
