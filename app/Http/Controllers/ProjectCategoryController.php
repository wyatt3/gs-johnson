<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProjectCategoryController extends Controller
{
    public function getProjectCategoriesInterface()
    {
        return view('admin.project-categories.index');
    }
}
