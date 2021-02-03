<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $request, $id)
    {
        $user = auth()->user();
        $project = Project::getUserProject($user->id, $id);

        return view('user_pages.project/details', [
            'project' => $project,
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
