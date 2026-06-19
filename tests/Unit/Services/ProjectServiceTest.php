<?php

namespace Tests\Unit\Services;

use App\Models\Project;
use App\Services\ProjectMediaService;
use App\Services\ProjectService;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class ProjectServiceTest extends TestCase
{
    private ProjectService $projectService;
    private $mockProjectMediaService;

    public function setUp(): void
    {
        parent::setUp();
        $this->mockProjectMediaService = $this->mock(ProjectMediaService::class);
        $this->projectService = resolve(ProjectService::class);
    }

    public function testCreateProject()
    {
        $this->mockProjectMediaService->shouldReceive('createProjectMedia')->once();

        $project = Project::factory()->make();
        $image = UploadedFile::fake()->image($this->faker->word() . '.jpg');

        $this->projectService->createProject(
            $project->title,
            $project->description,
            $project->projectCategory,
            $project->order,
            [$image]
        );

        $this->assertDatabaseHas('projects', [
            'title' => $project->title,
            'description' => $project->description,
            'category_id' => $project->projectCategory->getKey(),
            'order' => $project->order
        ]);
    }

    public function testUpdateProject()
    {
        $this->mockProjectMediaService->shouldReceive('createProjectMedia')->once();
        $image = UploadedFile::fake()->image($this->faker->word() . '.jpg');
        $project = Project::factory()->create();
        $newProject = Project::factory()->make();

        $response = $this->projectService->updateProject(
            $project,
            $newProject->title,
            $newProject->description,
            $newProject->projectCategory,
            [$image]
        );

        $project->refresh();
        $this->assertEquals($project->toArray(), $response->toArray());
    }

    public function testUpdateProjectOrder()
    {
        $project = Project::factory()->create();
        $newOrder = $this->faker->numberBetween(1, 10);

        $project = $this->projectService->updateProjectOrder($project, $newOrder);

        $this->assertEquals($newOrder, $project->order);
    }

    public function testDeleteProject()
    {
        $project = Project::factory()->create();

        $response = $this->projectService->deleteProject($project);

        $this->assertTrue($response);
    }
}
