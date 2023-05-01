<?php

namespace App\Services;

use App\Facades\ProjectService;
use App\Models\ProjectCategory;

class ProjectCategoryService
{
    public function createProjectCategory(string $name, int $order): ProjectCategory
    {
        return ProjectCategory::create([
            'name' => $name,
            'order' => $order
        ]);
    }

    public function editProjectCategory(ProjectCategory $category, string $name, int $order): ProjectCategory
    {
        $category->update([
            'name' => $name,
            'order' => $order
        ]);

        return $category;
    }

    public function deleteProjectCategory(ProjectCategory $category): bool
    {
        $category->projects()->each(function ($project) {
            ProjectService::deleteProject($project);
        });
        $category->delete();
        return true;
    }
}
