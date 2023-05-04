<?php

namespace Tests\Unit;

use App\Facades\ProjectService;
use App\Models\Project;
use App\Services\ProjectMediaService;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class ProjectServiceTest extends TestCase
{
    public function testCreateProject()
    {
        $this->mock(ProjectMediaService::class, function ($mock) {
            $mock->shouldReceive('createProjectMedia')->once();
        });

        $project = Project::factory()->make();
        $image = UploadedFile::fake()->image($this->faker->word() . '.jpg');

        ProjectService::createProject(
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
        $this->mock(ProjectMediaService::class, function ($mock) {
            $mock->shouldReceive('createProjectMedia')->once();
        });
        $image = UploadedFile::fake()->image($this->faker->word() . '.jpg');
        $project = Project::factory()->create();
        $newProject = Project::factory()->make();

        $response = ProjectService::updateProject(
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

        $project = ProjectService::updateProjectOrder($project, $newOrder);

        $this->assertEquals($newOrder, $project->order);
    }

    public function testDeleteProject()
    {
        $project = Project::factory()->create();

        $response = ProjectService::deleteProject($project);

        $this->assertTrue($response);
    }
}
