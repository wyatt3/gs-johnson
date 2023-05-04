<?php

namespace App\Http\Controllers;

use App\Facades\AdminService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index()
    {
        return view('index');
    }

    public function adminIndex()
    {
        return view('admin.index');
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
        AdminService::updateSocialLinks($request->filename, $request->displayName, $request->url);
        return redirect()->route('admin');
    }
}
