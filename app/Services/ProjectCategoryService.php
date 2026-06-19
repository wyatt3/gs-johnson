<?php

namespace App\Services;

use App\Models\Project;
use App\Models\ProjectCategory;

class ProjectCategoryService
{
    private ProjectService $projectService;

    public function __construct(ProjectService $projectService)
    {
        $this->projectService = $projectService;
    }

    /**
     * create project category
     *
     * @param string $name
     * @param int $order
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
     * @param int $order
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
     * @return bool
     */
    public function deleteProjectCategory(ProjectCategory $category): bool
    {
        $category->projects()->each(function ($project) {
            /** @var Project $project */
            $this->projectService->deleteProject($project);
        });
        $category->delete();
        return true;
    }
}
