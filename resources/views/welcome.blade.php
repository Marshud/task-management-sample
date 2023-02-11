@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 text-center pt-5">
                <h1 class="display-one mt-5">{{ config('app.name') }}</h1>
                <p>This awesome Task Management System has a couple of Tasks, click the button below to see them</p>
                <br>
                <a href="/tasks" class="btn btn-outline-primary">Show Tasks</a>
            </div>
        </div>
    </div>
@endsection