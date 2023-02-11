@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-2">&nbsp;</div>
        <div class="col-md-8">
            <center><h4>List of all tasks</h4></center>
            <center><a href="{{ route('addtask') }}" class="btn btn-info btn-lg">New Task</a></center>
            <table class="table table-responsive table-stripped">
                <thead>
                    <tr>
                        <th>DB_ID</th>
                        <th>Task</th>
                        <th>Priority</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="tbody_sortable">
                    {{-- <x-laravel-blade-sortable::sortable as="tbody" animation="1000" ghost-class="opacity-25" drag-handle="drag-handle" onSortOrderChange="handleSortOrderChange"> --}}

                        @foreach ($tasks as $task)
                          {{-- <x-laravel-blade-sortable::sortable-item sort-key="{{ $task->name }}"> --}}
                            <tr class="so_row" data-id="{{ $task->id }}" data-priority="{{ $task->priority }}">
                                <td>{{ $task->id }}</td>
                                <td>{{ $task->name }}</td>
                                <td>#{{ $task->priority }}</td>
                                <td><a href="{{ url('./task/edit/'.$task->id )}}" class="btn btn-primary">Edit</a></td>
                                <td>
                                    <form method="POST" action="/task/delete/{{ $task->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger" type="submit">Delete</button>
                                    </form>
                                </td>
                            </tr>
                          {{-- </x-laravel-blade-sortable::sortable-item> --}}
                        @endforeach
                    {{-- </x-laravel-blade-sortable::sortable>  --}}

                </tbody>
            </table>
        </div>
    </div>
</div>    
<script>
  // document.querySelector('#tbody_sortable').addEventListener('sort', function(e) {
  //   console.log(e)
  // })
  $('#tbody_sortable').sortable();

  $('#tbody_sortable').on('sort', function(e) {

    // console.log(e.originalEvent.newIndex);
    // console.log(e.originalEvent);
    toastr.info('Updating table...')

    // After sorting
    let altered_order = $('.so_row'), len = altered_order.length; 
    let all_altered_el = [];

    for(let i=0; i<len; i++) {
      let id = altered_order[i].dataset.id;
      let priority = i+1; // altered_order[i].dataset.priority

      let xo = new Object();
      xo.id = id;
      xo.priority = priority;

      all_altered_el.push(xo);
    }

    var myHeaders = new Headers();
    myHeaders.append("Content-Type", "application/json");

    var raw = JSON.stringify(all_altered_el);

    var requestOptions = {
      method: 'POST',
      headers: myHeaders,
      body: raw,
      redirect: 'follow'
    };

    fetch("http://localhost:8000/api/update-priority", requestOptions)
      .then(response => response.text())
      .then(result => {
        console.log(result);
        toastr.success('Successful! Refreshing Page...')
        if(result == 1) {
          window.location.reload();
        }
      })
      .catch(error => console.log('error', error));
        console.log(all_altered_el);

      });

</script>
@endsection
