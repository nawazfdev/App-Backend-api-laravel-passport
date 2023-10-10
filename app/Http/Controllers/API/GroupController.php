<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class GroupController extends Controller
{
    public function index($group_id)
{
    // Get the group.
    $group = Group::findOrFail($group_id);
    // If the user is not authorized to view the group's task lists, return an error.
    if (!$group->isMember(Auth::user())) {
        return response()->json([
            'message' => 'Unauthorized.',
        ], 403);
    }

    // Get the task lists of the group.
    $taskLists = $group->tasks;

    // Return the task lists.
    return response()->json([
        'taskLists' => $taskLists,
    ]);
}
public function create(Request $request)
{
    // Check if the user is authenticated.
    if (auth()->check()) {
        // Get the authenticated user's ID.
        $userId = auth()->user()->id;

        // Validate the request.
        $rules = [
            'name' => 'required|string',
            // You can add validation rules for 'user_id' if needed.
        ];
    
        // Create a validator instance
        $validator = Validator::make($request->all(), $rules);

        // Create a new group.
        $group = Group::create([
            'name' => $request->name,
            'user_id' => $userId, // Assign the authenticated user's ID.
        ]);

        // Return the group's ID.
        return response()->json([
            'group_id' => $group->id,
            'msg' => "Group is added successfully"
        ]);
    } else {
        // Handle the case where the user is not authenticated.
        return response()->json([
            'error' => 'Unauthorized',
            'msg' => 'You must be authenticated to perform this action.'
        ], 401); // 401 status code indicates unauthorized access.
 
 
    }

    // $group = Group::create([
    //     'name' => $request->input('name'),
    // ]);

    // $user = auth()->user();
    // $user->groups()->attach($group->id);

    // return response()->json(['message' => 'Group created successfully'], 201);



    
}


     
}
