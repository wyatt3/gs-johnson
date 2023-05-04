<?php

namespace Tests\Unit\Controllers;

use App\Models\ProjectMedia;
use App\Services\ProjectMediaService;
use Tests\TestCase;

class ProjectMediaControllerTest extends TestCase
{
    public function testPostUpdateProjectMediaOrder()
    {
        $media = ProjectMedia::factory()->create();
        $this->mock(ProjectMediaService::class, function ($mock) use ($media) {
            $mock->shouldReceive('updateProjectMediaOrder')->once()->andReturn($media);
        });

        $this->actingAs($this->user);
        $response = $this->post('/api/project-media/update-order/', [
            'id' => $media->getKey(),
            'order' => $this->faker->randomDigitNotNull
        ]);

        $response->assertStatus(200);
    }

    public function testPostDeleteProjectMedia()
    {
        $media = ProjectMedia::factory()->create();
        $this->mock(ProjectMediaService::class, function ($mock) {
            $mock->shouldReceive('deleteProjectMedia')->once();
        });

        $this->actingAs($this->user);
        $response = $this->post('/api/project-media/delete/', [
            'id' => $media->getKey(),
        ]);

        $response->assertStatus(200);
    }
}
