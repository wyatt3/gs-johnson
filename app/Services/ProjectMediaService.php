<?php

namespace App\Services;

use App\Models\Project;
use App\Models\ProjectMedia;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProjectMediaService
{
    /**
     * create project media
     *
     * @param Project $project
     * @param UploadedFile $file
     * @param int $order
     * @return ProjectMedia
     */
    public function createProjectMedia(Project $project, UploadedFile $file, int $order): ProjectMedia
    {
        $media = new ProjectMedia([
            'order' => $order,
        ]);

        $media->path = Str::uuid() . '.' . $file->getClientOriginalExtension();

        $project->media()->save($media);

        $file->storeAs(
            '/',
            $media->path,
            'media'
        );

        return $media;
    }

    /**
     * update project media order
     *
     * @param ProjectMedia $media
     * @param int $order
     * @return ProjectMedia
     */
    public function updateProjectMediaOrder(ProjectMedia $media, int $order): ProjectMedia
    {
        $media->update([
            'order' => $order
        ]);

        return $media;
    }

    /**
     * delete project media
     *
     * @param ProjectMedia $media
     * @return bool
     */
    public function deleteProjectMedia(ProjectMedia $media): bool
    {
        Storage::disk('media')->delete($media->path);
        $media->delete();
        return true;
    }
}
