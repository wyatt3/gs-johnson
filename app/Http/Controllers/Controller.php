<?php

namespace App\Http\Controllers;

use App\Facades\AdminService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use stdClass;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index()
    {
        $left = file_exists(__DIR__ . '/../../../social/left.json') ? json_decode(file_get_contents(__DIR__ . '/../../../social/left.json')) : null;
        $right = file_exists(__DIR__ . '/../../../social/right.json') ? json_decode(file_get_contents(__DIR__ . '/../../../social/right.json')) : null;
        return view('index', [
            'left' => $left,
            'right' => $right
        ]);
    }

    public function adminIndex()
    {
        $left = file_exists(__DIR__ . '/../../../social/left.json') ? json_decode(file_get_contents(__DIR__ . '/../../../social/left.json')) : new stdClass;
        $right = file_exists(__DIR__ . '/../../../social/right.json') ? json_decode(file_get_contents(__DIR__ . '/../../../social/right.json')) : new stdClass;
        return view('admin.index', [
            'left' => $left,
            'right' => $right
        ]);
    }

    public function postAdminUpdateResume(Request $request)
    {
        $request->validate([
            'resume' => 'required|file|mimes:pdf'
        ]);
        AdminService::updateResume($request->resume);
        return redirect()->route('admin');
    }

    public function postAdminUpdateSocialLink(Request $request)
    {
        $request->validate([
            'filename' => 'required|string',
            'displayName' => 'required|string',
            'url' => 'required|url'
        ]);
        AdminService::updateSocialLink($request->filename, $request->displayName, $request->url);
        return redirect()->route('admin');
    }
}
