<?php

namespace App\Http\Controllers;

use App\Facades\ProjectMediaService;
use App\Models\ProjectMedia;
use Illuminate\Http\Request;

class ProjectMediaController extends Controller
{
    public function postUpdateProjectMediaOrder(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:project_media,id',
            'order' => 'required|integer'
        ]);
        $media = ProjectMedia::find($request->id);

        $media = ProjectMediaService::updateProjectMediaOrder($media, $request->order);

        return response()->json($media);
    }

    public function postDeleteProjectMedia(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:project_media,id',
        ]);
        $media = ProjectMedia::find($request->id);

        ProjectMediaService::deleteProjectMedia($media);

        return response()->json($media);
    }
}
