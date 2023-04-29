<?php

namespace App\Services;

use App\Models\Project;
use App\Models\ProjectCategory;

class ProjectCatergoryService
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
        $category->delete();
        $category->projects()->delete();
        return true;
    }
}
