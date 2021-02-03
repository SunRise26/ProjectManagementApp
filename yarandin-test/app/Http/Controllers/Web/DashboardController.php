<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $projects = Project::getUserList($user->id);

        return view('user_pages.dashboard', [
            'projects' => $projects
        ]);
    }
}
