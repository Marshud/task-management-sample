@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-6">
            <center><h4>Edit Task</h4></center>
            <form action="/task/edit/{{$task->id}}" method="post">
                @csrf
                @method('PUT')
                <h4>Edit Task</h4>
                {{-- {{dd($task)}} --}}
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" value="{{$task->name}}">
                </div>

                <div class="mb-3">
                    <label for="name" class="form-label">Priority</label>
                    <select name="priority" id="priority" class="form-control">
                        @for ($i = 1; $i <= 10; $i++)
                            <option value="{{ $i }}" 
                            @if ($i == $task->priority)
                                {{'selected'}}
                            @endif  >{{ $i }}</option>
                        @endfor
                    </select>
                </div>
                <input type="submit" class="btn btn-primary" value="Edit">
            </form>
        </div>
    </div>
</div>
@endsection