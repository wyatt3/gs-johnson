<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function getProjects()
    {
        $projects = Project::with('media')->groupBy('category')->orderBy('order')->get();
        return response()->json($projects);
    }
}
