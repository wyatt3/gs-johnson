<?php

namespace App\Services;

use App\Models\Project;
use App\Models\ProjectMedia;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProjectMediaService
{
    public function createProjectMedia(Project $project, UploadedFile $file, int $order): ProjectMedia
    {
        $media = ProjectMedia::make([
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

    public function deleteProjectMedia(ProjectMedia $media): bool
    {
        Storage::disk('postImages')->delete($media->path);
        $media->delete();
        return true;
    }
}
