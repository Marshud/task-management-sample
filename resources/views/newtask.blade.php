@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-6">
            <h4>New Task</h4>
            <form action="{{ route('task.create') }}" method="post">
                @csrf
                @method('POST')
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" class="form-control">
                </div>
                <input type="submit" class="btn btn-primary" value="Add Task">
            </form>
        </div>
    </div>
</div>
@endsection