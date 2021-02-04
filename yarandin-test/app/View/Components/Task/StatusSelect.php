<?php

namespace App\View\Components\Task;

use Illuminate\View\Component;

class StatusSelect extends Component
{
    public $taskStatuses;
    public $selectedId;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($selectedId, $taskStatuses)
    {
        $this->selectedId = $selectedId;
        $this->taskStatuses = $taskStatuses;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.task.status-select');
    }
}
