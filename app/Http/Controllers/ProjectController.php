<?php

namespace App\Http\Controllers;

use App\Facades\ProjectService;
use App\Models\Project;
use App\Models\ProjectCategory;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function getProjects()
    {
        $projects = ProjectCategory::with(['projects.media'])->orderBy('order')->get();
        return response()->json($projects);
    }

    public function getProjectsInterface()
    {
        return view('admin.projects.index');
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

    public function postUpdateProjectOrder(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:projects,id',
            'order' => 'required'
        ]);

        $project = Project::find($request->id);
        $project = ProjectService::updateProjectOrder($project, $request->order);
        return response()->json($project);
    }

    public function postDeleteProject(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:projects,id'
        ]);

        $project = Project::find($request->id);
        ProjectService::deleteProject($project);
        return response()->json($project);
    }
}
