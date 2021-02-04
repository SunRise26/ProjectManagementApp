<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\File;
use App\Models\Project;
use App\Models\Task;
use App\Models\TaskStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

    /**
     * Force file download
     *
     * @param  \App\Http\Requests\Project\PostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function taskAttachment(Request $request, $taskId) {
        $user = auth()->user();
        $task = Task::getUserTask($user->id, $taskId);
        $file = File::findOrFail($task->attached_file_id);

        return Storage::download($file->getFullPath(), $file->title);
    }
}
