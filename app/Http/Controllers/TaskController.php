<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
// use App\Http\Controllers\TaskController;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = DB::table('tasks')
                    ->orderBy('priority', 'asc')
                    ->get();
        return view('display', ['tasks' => $tasks]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('newtask');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'=>'required'
        ]);

        // Get the number of tasks
        $count = Task::count(); 

        Task::create([
            'name'=> $request->name,
            'priority' => $count+1
        ]);

        return redirect('/tasks');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        return $task;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        return view('edit', ['task' => $task]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $t_update = Task::find($id);
        $t_update->name = $request->name;
        $t_update->priority = $request->priority;
        $t_update->save();

        return $this->index();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return $this->index();
    }

    /**
     * Handles sorting and updates the priority
     * 
     * @param Request
     * @return boolean
     */
    public function handleSortOrderChange(Request $request) {
        $updated_orders = $request->json()->all();
        foreach($updated_orders as $order) {
            extract($order);
            $update = Task::find($id);
            $update->priority = $priority;
            $update->save();

        }

        return true;
    }
}
