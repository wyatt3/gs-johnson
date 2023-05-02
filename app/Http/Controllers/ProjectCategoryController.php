<?php

namespace App\Http\Controllers;

use App\Facades\ProjectCategoryService;
use App\Models\ProjectCategory;
use Illuminate\Http\Request;

class ProjectCategoryController extends Controller
{
    public function getProjectCategoriesInterface()
    {
        return view('admin.project-categories.index');
    }

    public function getProjectCategories()
    {
        $projectCategories = ProjectCategory::orderBy('order')->get();
        return response()->json($projectCategories);
    }

    public function postCreateProjectCategory(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'order' => 'required'
        ]);

        $projectCategory = ProjectCategoryService::createProjectCategory($request->name, $request->order);
        return response()->json($projectCategory);
    }

    public function postEditProjectCategory(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:project_categories,id',
            'name' => 'required',
            'order' => 'required'
        ]);

        $category = ProjectCategory::find($request->id);
        $projectCategory = ProjectCategoryService::editProjectCategory($category, $request->name, $request->order);

        return response()->json($projectCategory);
    }

    public function postDeleteProjectCategory(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:project_categories,id'
        ]);

        $category = ProjectCategory::find($request->id);
        $projectCategory = ProjectCategoryService::deleteProjectCategory($category);
        return response()->json($projectCategory);
    }
}
