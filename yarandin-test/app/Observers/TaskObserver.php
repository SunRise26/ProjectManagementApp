<?php

namespace App\Observers;

use App\Models\Task;
use App\Models\User;
use App\Notifications\TaskStatusChange;
use Illuminate\Support\Facades\Notification;

class TaskObserver
{
    /**
     * Handle the Task "updated" event.
     *
     * @param  \App\Models\Task  $task
     * @return void
     */
    public function updated(Task $task)
    {
        $user = User::find($task->creator_id);

        if ($task->status_id != $task->getOriginal('status_id')) {
            Notification::send($user, new TaskStatusChange($task));
        }
    }
}
