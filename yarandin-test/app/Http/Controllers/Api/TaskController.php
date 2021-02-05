<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Task\PostRequest;
use App\Http\Requests\Task\UpdateRequest;
use App\Models\Project;
use App\Models\Task;
use App\Models\TaskStatus;
use Exception;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $projects = Task::getUserList($user->id);

        return response()->json($projects->toJson());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Task\PostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $user = auth()->user();

        $validatedData = $request->validated();
        $project = Project::getUserProject($user->id, $validatedData['project_id']);
        $defaultStatus = TaskStatus::where('code', 'new')->firstOrFail();

        $task = Task::create([
            'creator_id' => $user->id,
            'status_id' => $defaultStatus->id,
            'project_id' => $project->id,
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'position' => $validatedData['position'],
        ]);

        // save file
        try {
            if ($attachedFile = $request->file('attached_file')) {
                $task->saveFile($attachedFile);
            }
        } catch (Exception $e) {
            // TODO: handle save fail
        }

        return response()->json($task->toJson(), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed                     $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $user = auth()->user();

        try {
            $task = Task::getUserTask($user->id, $id);
        } catch (Exception $e) {
            return response()->json([], 404);
        }

        return response()->json($task->toJson());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Task\UpdateRequest  $request
     * @param  mixed                                  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        $user = auth()->user();

        try {
            $task = Task::getUserTask($user->id, $id);
        } catch (Exception $e) {
            return response()->json([], 404);
        }

        $validatedData = $request->validated();

        $task->update($validatedData);
        return response()->json($task->toJson());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed                     $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $user = auth()->user();

        try {
            $task = Task::getUserTask($user->id, $id);
        } catch (Exception $e) {
            return response()->json([], 404);
        }

        $task->delete();
        return response()->json();
    }
}
