<?php

namespace App\Services;

use App\Facades\ProjectMediaService;
use App\Models\Project;
use App\Models\ProjectCategory;

class ProjectService
{
    /**
     * create project
     *
     * @param string $name
     * @param string $description
     * @param ProjectCategory $category
     * @param integer $order
     * @return Project
     */
    public function createProject(string $name, string $description, ProjectCategory $category, int $order): Project
    {
        return Project::create([
            'title' => $name,
            'description' => $description,
            'category_id' => $category->getKey(),
            'order' => $order
        ]);
    }

    /**
     * edit project
     *
     * @param Project $project
     * @param string $name
     * @param string $description
     * @param ProjectCategory $category
     * @param integer $order
     * @return Project
     */
    public function editProject(Project $project, string $name, string $description, ProjectCategory $category, int $order): Project
    {
        $project->update([
            'title' => $name,
            'description' => $description,
            'category_id' => $category->getKey(),
            'order' => $order
        ]);

        return $project;
    }

    /**
     * delete project
     *
     * @param Project $project
     * @return boolean
     */
    public function deleteProject(Project $project): bool
    {
        $project->delete();
        $project->media()->each(function ($media) {
            ProjectMediaService::deleteProjectMedia($media);
        });
        return true;
    }
}
