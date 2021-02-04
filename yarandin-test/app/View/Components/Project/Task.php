<?php

namespace App\View\Components\Project;

use App\Models\Task as ModelsTask;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class Task extends Component
{
    public ModelsTask $task;
    public Collection $taskStatuses;

    /**
     * Create a new component instance.
     *
     * @param ModelsTask $task
     * @param Collection $taskStatuses
     * @return void
     */
    public function __construct(ModelsTask $task, Collection $taskStatuses)
    {
        $this->task = $task;
        $this->taskStatuses = $taskStatuses;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.project.task');
    }
}
