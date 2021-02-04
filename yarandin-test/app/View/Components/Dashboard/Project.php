<?php

namespace App\View\Components\Dashboard;

use App\Models\Project as ModelsProject;
use Illuminate\View\Component;

class Project extends Component
{
    public ModelsProject $project;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(ModelsProject $project)
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
        return view('components.dashboard.project');
    }
}
