<?php

namespace App\Http\Controllers;

use App\Http\Requests\Task\StoreRequest;
use App\Models\Task;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TaskController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        Task::create($request->validated());
        return redirect()->route('goal.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function changeStatus(Request $request, Task $task)
    {
//        dd($request);
        $task->update($request->validate(['status' => 'required',]));
        return redirect()->route('goal.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(Task $task)
    {
        $task->delete();
        return redirect()->route('goal.index');
    }
}
