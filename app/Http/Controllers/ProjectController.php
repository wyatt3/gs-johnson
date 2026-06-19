<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectCategory;
use App\Services\ProjectService;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    private ProjectService $projectService;

    public function __construct(ProjectService $projectService)
    {
        $this->projectService = $projectService;
    }

    /**
     * Get the projects.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getProjects(): \Illuminate\Http\JsonResponse
    {
        $projects = ProjectCategory::with(['projects.media'])->orderBy('order')->get();
        return response()->json($projects);
    }

    /**
     * Get the projects interface.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function getProjectsInterface(): \Illuminate\Contracts\View\View
    {
        return view('admin.projects.index');
    }

    /**
     * Get the create project interface.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function getCreateProject(): \Illuminate\Contracts\View\View
    {
        $categories = ProjectCategory::orderBy('name')->get();
        return view('admin.projects.create', ['categories' => $categories]);
    }

    /**
     * Create a new project.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postCreateProject(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'title' => 'required',
            // 'description' => 'required',
            'category_id' => 'required|exists:project_categories,id',
            'uploadedFiles' => 'array'
        ]);

        /** @var string $title */
        $title = $request->title;
        /** @var string $description */
        $description = $request->description ?? '';
        /** @var int $categoryId */
        $categoryId = $request->category_id;
        /** @var list<\Illuminate\Http\UploadedFile> $uploadedFiles */
        $uploadedFiles = $request->uploadedFiles;

        $category = ProjectCategory::findOrFail($categoryId);
        $lastProjectInCategory = Project::where('category_id', $category->getKey())->orderBy('order', 'desc')->first();

        $this->projectService->createProject($title, $description, $category, $lastProjectInCategory ? $lastProjectInCategory->order + 1 : 1, $uploadedFiles);
        return redirect()->route('admin.projects.index');
    }

    /**
     * Get the edit project interface.
     *
     * @param Project $project
     * @return \Illuminate\Contracts\View\View
     */
    public function getEditProject(Project $project): \Illuminate\Contracts\View\View
    {
        $categories = ProjectCategory::orderBy('name')->get();
        return view('admin.projects.edit', ['project' => $project->load('media'), 'categories' => $categories]);
    }

    /**
     * Update a project.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postUpdateProject(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'id' => 'required|exists:projects,id',
            'title' => 'required',
            // 'description' => 'required',
            'category_id' => 'required|exists:project_categories,id',
            'uploadedFiles' => 'array'
        ]);

        /** @var int $id */
        $id = $request->id;
        /** @var string $title */
        $title = $request->title;
        /** @var string $description */
        $description = $request->description ?? '';
        /** @var int $categoryId */
        $categoryId = $request->category_id;
        /** @var list<\Illuminate\Http\UploadedFile> $uploadedFiles */
        $uploadedFiles = $request->uploadedFiles;

        $project = Project::findOrFail($id);
        $category = ProjectCategory::findOrFail($categoryId);

        $this->projectService->updateProject($project, $title, $description, $category, $uploadedFiles);
        return redirect()->route('admin.projects.index');
    }

    /**
     * Update a project order.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function postUpdateProjectOrder(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'id' => 'required|exists:projects,id',
            'order' => 'required'
        ]);

        /** @var int $id */
        $id = $request->id;
        /** @var int $order */
        $order = $request->order;

        $project = Project::findOrFail($id);
        $project = $this->projectService->updateProjectOrder($project, $order);
        return response()->json($project);
    }

    /**
     * Delete a project.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function postDeleteProject(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'id' => 'required|exists:projects,id'
        ]);

        /** @var int $id */
        $id = $request->id;

        $project = Project::findOrFail($id);
        $this->projectService->deleteProject($project);
        return response()->json($project);
    }
}
