<?php

namespace App\Http\Controllers;

use App\Models\ProjectCategory;
use App\Services\ProjectCategoryService;
use Illuminate\Http\Request;

class ProjectCategoryController extends Controller
{
    private ProjectCategoryService $service;

    public function __construct(ProjectCategoryService $service)
    {
        $this->service = $service;
    }

    /**
     * Get the project categories interface.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function getProjectCategoriesInterface(): \Illuminate\Contracts\View\View
    {
        return view('admin.project-categories.index');
    }

    /**
     * Get the project categories.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getProjectCategories(): \Illuminate\Http\JsonResponse
    {
        $projectCategories = ProjectCategory::orderBy('order')->get();
        return response()->json($projectCategories);
    }

    /**
     * Create a new project category.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function postCreateProjectCategory(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'name' => 'required',
            'order' => 'required'
        ]);

        /** @var string $name */
        $name = $request->name;
        /** @var int $order */
        $order = $request->order;

        $projectCategory = $this->service->createProjectCategory($name, $order);
        return response()->json($projectCategory);
    }

    /**
     * Edit a project category.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function postEditProjectCategory(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'id' => 'required|exists:project_categories,id',
            'name' => 'required',
            'order' => 'required'
        ]);

        /** @var int $id */
        $id = $request->id;
        /** @var string $name */
        $name = $request->name;
        /** @var int $order */
        $order = $request->order;

        $category = ProjectCategory::findOrFail($id);
        $projectCategory = $this->service->editProjectCategory($category, $name, $order);

        return response()->json($projectCategory);
    }

    /**
     * Delete a project category.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function postDeleteProjectCategory(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'id' => 'required|exists:project_categories,id'
        ]);

        /** @var int $id */
        $id = $request->id;

        $category = ProjectCategory::findOrFail($id);
        $projectCategory = $this->service->deleteProjectCategory($category);
        return response()->json($projectCategory);
    }
}
