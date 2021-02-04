<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Task;
use App\Models\TaskStatus;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function create()
    {
        $user = auth()->user();
        $projectId = request("project_id");
        $project = Project::getUserProject($user->id, $projectId);

        return view('user_pages.task/create', [
            'project' => $project,
        ]);
    }

    public function edit(Request $request, $id)
    {
        $user = auth()->user();
        $task = Task::getUserTask($user->id, $id);
        $taskStatuses = TaskStatus::getSortedList();

        return view('user_pages.task/edit', [
            'task' => $task,
            'taskStatuses' => $taskStatuses
        ]);
    }
}
