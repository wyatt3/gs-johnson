<?php

namespace App\Services;

use App\Facades\ProjectService;
use App\Models\ProjectCategory;

class ProjectCategoryService
{
    /**
     * create project category
     *
     * @param string $name
     * @param integer $order
     * @return ProjectCategory
     */
    public function createProjectCategory(string $name, int $order): ProjectCategory
    {
        return ProjectCategory::create([
            'name' => $name,
            'order' => $order
        ]);
    }

    /**
     * edit project category
     *
     * @param ProjectCategory $category
     * @param string $name
     * @param integer $order
     * @return ProjectCategory
     */
    public function editProjectCategory(ProjectCategory $category, string $name, int $order): ProjectCategory
    {
        $category->update([
            'name' => $name,
            'order' => $order
        ]);

        return $category;
    }

    /**
     * delete project category
     *
     * @param ProjectCategory $category
     * @return boolean
     */
    public function deleteProjectCategory(ProjectCategory $category): bool
    {
        $category->projects()->each(function ($project) {
            ProjectService::deleteProject($project);
        });
        $category->delete();
        return true;
    }
}
