<?php

namespace Tests\Unit;

use App\Facades\ProjectService;
use App\Models\Project;
use Tests\TestCase;

class ProjectServiceTest extends TestCase
{
    public function testCreateProject()
    {
        $project = Project::factory()->make();

        ProjectService::createProject(
            $project->title,
            $project->description,
            $project->projectCategory,
            $project->order
        );

        $this->assertDatabaseHas('projects', [
            'title' => $project->title,
            'description' => $project->description,
            'category_id' => $project->projectCategory->getKey(),
            'order' => $project->order
        ]);
    }

    public function testEditProject()
    {
        $project = Project::factory()->create();
        $newProject = Project::factory()->make();

        $response = ProjectService::editProject(
            $project,
            $newProject->title,
            $newProject->description,
            $newProject->projectCategory,
            $newProject->order
        );

        $project->refresh();
        $this->assertEquals($project->toArray(), $response->toArray());
    }

    public function testDeleteProject()
    {
        $project = Project::factory()->create();

        $response = ProjectService::deleteProject($project);

        $this->assertTrue($response);
    }
}
