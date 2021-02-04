<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectPostRequest;
use App\Models\Project;
use Exception;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $projects = Project::getUserList($user->id);

        return response()->json($projects->toJson());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ProjectPostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectPostRequest $request)
    {
        $user = auth()->user();

        $validatedData = $request->validated();

        $project = Project::create([
            'user_id' => $user->id,
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'position' => $validatedData['position'],
        ]);
        return response()->json($project->toJson(), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed                     $id
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project, $id)
    {
        $user = auth()->user();

        try {
            $project = Project::getUserProject($user->id, $id);
        } catch (Exception $e) {
            return response()->json([], 204);
        }

        return response()->json($project->toJson());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ProjectPostRequest  $request
     * @param  mixed                                  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProjectPostRequest $request, $id)
    {
        $user = auth()->user();

        try {
            $project = Project::getUserProject($user->id, $id);
        } catch (Exception $e) {
            return response()->json([], 204);
        }

        $validatedData = $request->validated();

        $project->update([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'position' => $validatedData['position'],
        ]);
        return response()->json($project->toJson());
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
            $project = Project::getUserProject($user->id, $id);
        } catch (Exception $e) {
            return response()->json([], 204);
        }

        $project->delete();
        return response()->json();
    }
}
