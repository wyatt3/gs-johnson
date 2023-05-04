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

    public function testPostAdminUpdateResume()
    {
        $this->mock(AdminService::class, function ($mock) {
            $mock->shouldReceive('updateResume')->once();
        });
        $this->actingAs($this->user);
        $response = $this->post(route('admin.resume.update'), [
            'resume' => UploadedFile::fake()->image($this->faker->word() . '.pdf')
        ]);

        $response->assertStatus(302);
    }

    public function testPostAdminUpdateSocialLink()
    {
        $this->mock(AdminService::class, function ($mock) {
            $mock->shouldReceive('updateSocialLink')->once();
        });
        $this->actingAs($this->user);
        $response = $this->post(route('admin.social.update'), [
            'filename' => $this->faker->word(),
            'displayName' => $this->faker->word(),
            'url' => $this->faker->url()
        ]);

        $response->assertStatus(302);
    }
}
