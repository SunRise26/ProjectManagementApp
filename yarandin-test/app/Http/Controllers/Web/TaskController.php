<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\TaskStatus;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function create()
    {
        return view('user_pages.task/create');
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
