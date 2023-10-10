<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function create(Request $request)
    {
        // Validate the request.
        $request->validate([
            'group_id' => 'required|integer',
            'title' => 'required|string',
            'description' => 'required|string',
            'start_time' => 'required',
            'task_date' => 'required',
        ]);

        // Create a new task.
        $group = Group::find($request->group_id);

        $task = Task::create([
            'start_time' => $request->start_time,
            'task_date' => $request->task_date,
            'title' => $request->title,
            'group_id' => $request->group_id,
            'description' => $request->description,
            
        ]);

        // Return the task's ID.
        return response()->json([
            'msg'=> "Task is Added Successfully",
            'task_id' => $task->id,
        ]);
    }
}
