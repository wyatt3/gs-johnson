<?php

namespace App\Services;

use App\Facades\ProjectMediaService;
use App\Models\Project;
use App\Models\ProjectCategory;
use Symfony\Component\HttpFoundation\FileBag;

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
    public function createProject(string $name, string $description, ProjectCategory $category, int $order, array $files = []): Project
    {

        $project = Project::create([
            'title' => $name,
            'description' => $description,
            'category_id' => $category->getKey(),
            'order' => $order
        ]);
        foreach ($files as $index => $file) {
            $file = ProjectMediaService::createProjectMedia($project, $file, $index + 1);
        }

        return $project;
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
     * update project order
     *
     * @param Project $project
     * @param integer $order
     * @return Project
     */
    public function updateProjectOrder(Project $project, int $order): Project
    {
        $project->update([
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
        $project->media()->each(function ($media) {
            ProjectMediaService::deleteProjectMedia($media);
        });
        $project->delete();
        return true;
    }
}
