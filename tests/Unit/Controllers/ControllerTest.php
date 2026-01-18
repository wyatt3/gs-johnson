<?php

namespace Tests\Unit\Controllers;

use App\Services\AdminService;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class ControllerTest extends TestCase
{
    public function testGetIndex()
    {
        $response = $this->get(route('home'));

        $response->assertStatus(200);
    }

    public function testGetAdminIndex()
    {
        $this->actingAs($this->user);
        $response = $this->get(route('admin'));

        $response->assertStatus(200);
    }
}
