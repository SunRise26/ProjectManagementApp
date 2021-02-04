<?php

namespace App\View\Components\Task;

use Illuminate\View\Component;

class Form extends Component
{
    public $task;
    public $taskStatuses;

    /**
     * Create a new component instance.
     *
     * @param mixed $task
     * @return void
     */
    public function __construct($task = null, $taskStatuses = null)
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
        return view('components.task.form');
    }
}
