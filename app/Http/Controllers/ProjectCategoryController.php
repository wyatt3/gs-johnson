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
}
