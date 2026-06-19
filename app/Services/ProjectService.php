<?php

namespace App\Services;

use App\Models\Project;
use App\Models\ProjectCategory;
use App\Models\ProjectMedia;

class ProjectService
{
    private ProjectMediaService $projectMediaService;

    public function __construct(ProjectMediaService $projectMediaService)
    {
        $this->projectMediaService = $projectMediaService;
    }

    /**
     * create project
     *
     * @param string $name
     * @param string $description
     * @param ProjectCategory $category
     * @param int $order
     * @param ?array<\Illuminate\Http\UploadedFile> $files
     * @return Project
     */
    public function createProject(string $name, string $description, ProjectCategory $category, int $order, ?array $files): Project
    {
        $files = $files ?? [];
        $project = Project::create([
            'title' => $name,
            'description' => $description,
            'category_id' => $category->getKey(),
            'order' => $order
        ]);
        foreach ($files as $index => $file) {
            $file = $this->projectMediaService->createProjectMedia($project, $file, $index + 1);
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
     * @param ?array<\Illuminate\Http\UploadedFile> $files
     * @return Project
     */
    public function updateProject(Project $project, string $name, string $description, ProjectCategory $category, ?array $files): Project
    {
        $project->update([
            'title' => $name,
            'description' => $description,
            'category_id' => $category->getKey(),
        ]);

        if ($files) {
            $order = $project->media()->count();
            foreach ($files as $file) {
                $this->projectMediaService->createProjectMedia($project, $file, $order++);
            }
        }

        return $project;
    }

    /**
     * update project order
     *
     * @param Project $project
     * @param int $order
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
     * @return bool
     */
    public function deleteProject(Project $project): bool
    {
        $project->media()->each(function ($media) {
            /** @var ProjectMedia $media */
            $this->projectMediaService->deleteProjectMedia($media);
        });
        $project->delete();
        return true;
    }
}
