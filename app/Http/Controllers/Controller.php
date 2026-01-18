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
        $footerLinks = file_exists(__DIR__ . '/../../../footer/links.json') ? json_decode(file_get_contents(__DIR__ . '/../../../footer/links.json')) : [];
        return view('index', [
            'footerLinks' => $footerLinks
        ]);
    }

    public function adminIndex()
    {
        return view('admin.index', []);
    }
}
