<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use Carbon\Carbon;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        $scheduled = Carbon::createFromFormat('Y-m-d H:i', $request->day.' '.$request->hour);

        // dump($scheduled);
        // dd($request->all());

        auth()->user()->tasks()->create([
            'action' => $request->action,
            'scheduled' => $scheduled,
        ]);

        return redirect()->route('calendar');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        // dump($task->toArray());
        // dd($task);
        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        // dump('$task->toArray()');
        // dump($task->toArray());
        // dd($request->all());

        // $task->scheduled = null;
        // $task->save();
        //
        // $task = $task->fresh();
        //
        $scheduled = Carbon::createFromFormat('Y-m-d H:i:s', $request->day.' '.$request->hour);

        $task->action = $request->action;
        $task->scheduled = $scheduled;

        $task->save();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('calendar');
    }
}
