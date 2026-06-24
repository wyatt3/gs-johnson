<?php

namespace App\Services;

use App\Models\Project;
use App\Models\ProjectCategory;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
     * @param string $description
     * @param UploadedFile $image
     * @param int $order
     * @return ProjectCategory
     */
    public function createProjectCategory(string $name, string $description, UploadedFile $image, int $order): ProjectCategory
    {
        $path = $this->storeImage($image);

        return ProjectCategory::create([
            'name' => $name,
            'description' => $description,
            'image' => $path,
            'order' => $order
        ]);
    }

    /**
     * edit project category
     *
     * @param ProjectCategory $category
     * @param string $name
     * @param string $description
     * @param ?UploadedFile $image
     * @param int $order
     * @return ProjectCategory
     */
    public function editProjectCategory(ProjectCategory $category, string $name, string $description, int $order, ?UploadedFile $image): ProjectCategory
    {
        if ($image) {
            $path = $this->storeImage($image);
            if ($category->image) {
                Storage::disk('categories')->delete($category->image);
            }
            $category->update([
                'image' => $path
            ]);
        }

        $category->update([
            'name' => $name,
            'description' => $description,
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
        if ($category->image) {
            Storage::disk('categories')->delete($category->image);
        }
        $category->delete();
        return true;
    }

    /**
     * Store the category image
     *
     * @param UploadedFile $image
     * @return string
     */
    private function storeImage(UploadedFile $image): string
    {
        $path = Str::uuid() . '.' . $image->getClientOriginalExtension();
        $image->storeAs(
            '/',
            $path,
            'categories'
        );

        return $path;
    }
}
