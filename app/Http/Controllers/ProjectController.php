<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function getProjects()
    {
        $projects = Project::with(['media'])->orderBy('order')->get()->groupBy('projectCategory.name');
        return response()->json($projects);
    }

    public function getProject($id)
    {
        $project = Project::with(['media'])->find($id);
        return response()->json($project);
    }

    public function getCreateProject()
    {
        return view('admin.projects.create');
    }

    public function postCreateProject(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'category_id' => 'required',
            'order' => 'required'
        ]);
        $project = Project::create($request->all());
        return response()->json($project);
    }
}
