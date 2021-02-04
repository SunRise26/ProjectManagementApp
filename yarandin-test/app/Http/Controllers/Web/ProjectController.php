<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\TaskStatus;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $request, $id)
    {
        $user = auth()->user();
        $project = Project::getUserProject($user->id, $id);
        $tasks = $project->tasks()->get();
        $taskStatuses = TaskStatus::getSortedList();

        return view('user_pages.project/details', [
            'project' => $project,
            'tasks' => $tasks,
            'taskStatuses' => $taskStatuses,
        ]);
    }

    public function create()
    {
        return view('user_pages.project/create');
    }

    public function edit(Request $request, $id)
    {
        $user = auth()->user();
        $project = Project::getUserProject($user->id, $id);

        return view('user_pages.project/edit', [
            'project' => $project,
        ]);
    }
}
