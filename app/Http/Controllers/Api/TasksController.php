<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Task;
use Exception;
use Illuminate\Http\Response;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return response()->json(\App\Repository\Task::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TaskRequest $request
     * @return Response
     */
    public function store(TaskRequest $request)
    {
        \App\Repository\Task::flush();
        Task::create($request->all());
        return response([], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param TaskRequest $request
     * @param Task $task
     * @return Response
     */
    public function update(TaskRequest $request, Task $task)
    {
        \App\Repository\Task::flush();
        $task->update(['name' => $request->name]);
        return response([], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Task $task
     * @return Response
     * @throws Exception
     */
    public function destroy(Task $task)
    {
        \App\Repository\Task::flush();
        $task->delete();
        return response([], 200);
    }
}
