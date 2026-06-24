<?php

namespace App\Http\Controllers;

use App\Models\ProjectCategory;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index(): \Illuminate\Contracts\View\View
    {
        $categories = ProjectCategory::orderBy('order')->get();
        /** @var string $fileContents */
        $fileContents = file_get_contents(__DIR__ . '/../../../footer/links.json');
        $footerLinks = file_exists(__DIR__ . '/../../../footer/links.json') ? json_decode($fileContents) : [];
        return view('index', [
            'categories' => $categories,
            'footerLinks' => $footerLinks
        ]);
    }

    public function adminIndex(): \Illuminate\Contracts\View\View
    {
        return view('admin.index');
    }
}
