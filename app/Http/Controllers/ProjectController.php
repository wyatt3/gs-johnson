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

    public function getCreateProject()
    {
        $categories = ProjectCategory::orderBy('name')->get();
        return view('admin.projects.create', ['categories' => $categories]);
    }

    public function postCreateProject(Request $request)
    {
        $request->validate([
            'title' => 'required',
            // 'description' => 'required',
            'category_id' => 'required|exists:project_categories,id',
            'uploadedFiles' => 'array'
        ]);

        $category = ProjectCategory::findOrFail($request->category_id);
        $lastProjectInCategory = Project::where('category_id', $category->getKey())->orderBy('order', 'desc')->first();

        ProjectService::createProject($request->title, $request->description ?? '', $category, $lastProjectInCategory ? $lastProjectInCategory->order + 1 : 1, $request->uploadedFiles);
        return redirect()->route('admin.projects.index');
    }

    public function getEditProject($id)
    {
        $categories = ProjectCategory::orderBy('name')->get();
        $project = Project::find($id)->load(['media']);
        return view('admin.projects.edit', ['project' => $project, 'categories' => $categories]);
    }

    public function postUpdateProject(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:projects,id',
            'title' => 'required',
            // 'description' => 'required',
            'category_id' => 'required|exists:project_categories,id',
            'uploadedFiles' => 'array'
        ]);

        $project = Project::find($request->id);
        $category = ProjectCategory::findOrFail($request->category_id);

        ProjectService::updateProject($project, $request->title, $request->description ?? '', $category, $request->uploadedFiles);
        return redirect()->route('admin.projects.index');
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
