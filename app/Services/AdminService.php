<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;

class AdminService
{
    /**
     * update resume
     *
     * @param UploadedFile $resume
     * @return void
     */
    public function updateResume(UploadedFile $resume): bool
    {
        $resume->storeAs('public/', 'GracieJohnson.pdf');
        return true;
    }

    /**
     * update social links
     *
     * @param string $filepath
     * @param string $displayName
     * @param string $url
     * @return bool
     */
    public function updateSocialLinks(string $filename, string $displayName, string $url): bool
    {
        $json = json_encode([
            'displayName' => $displayName,
            'url' => $url
        ]);
        file_put_contents(__DIR__ . "/../../social/$filename.json", $json);
        return true;
    }
}
