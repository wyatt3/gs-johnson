<?php

namespace Tests\Unit\Controllers;

use App\Models\Project;
use App\Models\ProjectCategory;
use App\Services\ProjectService;
use Tests\TestCase;

class ProjectControllerTest extends TestCase
{
    public function testGetProjects()
    {
        $response = $this->get('/api/projects');

        $response->assertStatus(200);
    }

    public function testGetProjectsInterface()
    {
        $this->actingAs($this->user);
        $response = $this->get(route('admin.projects.index'));

        $response->assertStatus(200);
    }

    public function testGetCreateProject()
    {
        $this->actingAs($this->user);
        $response = $this->get(route('admin.projects.create'));

        $response->assertStatus(200);
    }

    public function testPostCreateProject()
    {
        $this->mock(ProjectService::class, function ($mock) {
            $mock->shouldReceive('createProject')->once();
        });
        $this->actingAs($this->user);
        $response = $this->post(route('admin.projects.create'), [
            'title' => $this->faker->word(),
            'description' => $this->faker->sentence(),
            'category_id' => ProjectCategory::factory()->create()->getKey(),
            'uploadedFiles' => []
        ]);

        $response->assertStatus(302);
    }

    public function testGetEditProject()
    {
        $project = Project::factory()->create();
        $this->actingAs($this->user);
        $response = $this->get(route('admin.projects.edit', ['id' => $project->getKey()]));

        $response->assertStatus(200);
    }

    public function testPostUpdateProject()
    {
        $project = Project::factory()->create();
        $this->mock(ProjectService::class, function ($mock) {
            $mock->shouldReceive('updateProject')->once();
        });
        $this->actingAs($this->user);
        $response = $this->post(route('admin.projects.update'), [
            'id' => $project->getKey(),
            'title' => $this->faker->word(),
            'description' => $this->faker->sentence(),
            'category_id' => ProjectCategory::factory()->create()->getKey(),
            'uploadedFiles' => []
        ]);

        $response->assertStatus(302);
    }

    public function testPostUpdateProjectOrder()
    {
        $project = Project::factory()->create();
        $this->mock(ProjectService::class, function ($mock) use ($project) {
            $mock->shouldReceive('updateProjectOrder')->once()->andReturn($project);
        });
        $this->actingAs($this->user);
        $response = $this->post('api/projects/update-order', [
            'id' => $project->getKey(),
            'order' => $this->faker->randomDigit()
        ]);

        $response->assertStatus(200);
    }

    public function testPostDeleteProject()
    {
        $project = Project::factory()->create();
        $this->mock(ProjectService::class, function ($mock) {
            $mock->shouldReceive('deleteProject')->once()->andReturnTrue();
        });
        $this->actingAs($this->user);
        $response = $this->post('api/projects/delete', [
            'id' => $project->getKey()
        ]);

        $response->assertStatus(200);
    }
}
