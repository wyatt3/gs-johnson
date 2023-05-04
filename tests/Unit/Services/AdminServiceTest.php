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
}
