<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\File;
use App\Models\Project;
use App\Models\TaskStatus;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $request, $id)
    {
        $user = auth()->user();
        $project = Project::getUserProject($user->id, $id);
        $taskStatuses = TaskStatus::getSortedList();

        // filter unsupported task status filters
        $statusIds = array_map(function ($e) {return $e['id'];}, $taskStatuses->toArray());
        $selectedTaskStatuses = array_intersect(request('tasks_status_ids', []), $statusIds);
        // unselect all filters if used every of availale
        if (empty(array_diff($statusIds, $selectedTaskStatuses))) {
            $selectedTaskStatuses = [];
        }

        // prepare tasks and apply search filters
        $tasks = $project->tasks()->with('file');
        if (!empty($selectedTaskStatuses)) {
            $tasks->whereIn('status_id', $selectedTaskStatuses);
        }
        $tasks = $tasks->get();

        return view('user_pages.project/details', [
            'project' => $project,
            'tasks' => $tasks,
            'taskStatuses' => $taskStatuses,
            'selectedTaskStatuses' => $selectedTaskStatuses,
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
