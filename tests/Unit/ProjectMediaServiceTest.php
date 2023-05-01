<?php

namespace Tests\Unit;

use App\Facades\ProjectMediaService;
use App\Models\Project;
use App\Models\ProjectMedia;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ProjectMediaServiceTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    public function testCreateProjectMedia()
    {
        Storage::fake('media');
        $project = Project::factory()->create();
        $file = UploadedFile::fake()->image('test.jpg');
        $order = $this->faker->numberBetween(1, 10);

        $response = ProjectMediaService::createProjectMedia($project, $file, $order);

        $this->assertInstanceOf(ProjectMedia::class, $response);
        $this->assertDatabaseHas('project_media', [
            'project_id' => $project->getKey(),
            'path' => $response->path,
            'order' => $order
        ]);
    }

    public function testDeleteProjectMedia()
    {
        Storage::fake('media');
        $media = ProjectMedia::factory()->create();

        $response = ProjectMediaService::deleteProjectMedia($media);

        $this->assertTrue($response);
    }
}
