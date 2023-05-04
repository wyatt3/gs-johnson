<?php

namespace Tests\Unit\Services;

use App\Facades\AdminService;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AdminServiceTest extends TestCase
{
    public function testUpdateResume()
    {
        Storage::fake('storage');
        $image = UploadedFile::fake()->image($this->faker->word() . '.pdf');
        $response = AdminService::updateResume($image);
        $this->assertTrue($response);
    }

    public function testUpdateSocialLinks()
    {
        $filename = $this->faker->word();
        $displayName = $this->faker->word();
        $url = $this->faker->url();
        $response = AdminService::updateSocialLinks($filename, $displayName, $url);
        $this->assertTrue($response);

        $json = json_decode(file_get_contents(__DIR__ . "/../../../social/$filename.json"));
        $this->assertEquals($json->displayName, $displayName);
        $this->assertEquals($json->url, $url);
    }
}
