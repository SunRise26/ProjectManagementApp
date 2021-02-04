<?php

namespace App\View\Components\Project;

use App\Models\Project;
use Illuminate\View\Component;

class Form extends Component
{
    public $project;

    /**
     * Create a new component instance.
     *
     * @param mixed $project
     * @return void
     */
    public function __construct($project = null)
    {
        $this->project = $project;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.project.form');
    }
}
