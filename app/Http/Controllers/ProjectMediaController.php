<?php

namespace App\Http\Controllers;

use App\Models\ProjectMedia;
use App\Services\ProjectMediaService;
use Illuminate\Http\Request;

class ProjectMediaController extends Controller
{
    private ProjectMediaService $service;

    public function __construct(ProjectMediaService $service)
    {
        $this->service = $service;
    }

    /**
     * Update project media order.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function postUpdateProjectMediaOrder(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'id' => 'required|exists:project_media,id',
            'order' => 'required|integer'
        ]);

        /** @var int $id */
        $id = $request->id;
        /** @var int $order */
        $order = $request->order;

        $media = ProjectMedia::findOrFail($id);

        $media = $this->service->updateProjectMediaOrder($media, $order);

        return response()->json($media);
    }

    /**
     * Delete project media.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function postDeleteProjectMedia(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'id' => 'required|exists:project_media,id',
        ]);

        /** @var int $id */
        $id = $request->id;

        $media = ProjectMedia::findOrFail($id);

        $this->service->deleteProjectMedia($media);

        return response()->json($media);
    }
}
