<?php

namespace Tests\Unit\Controllers;

use App\Models\ProjectCategory;
use App\Services\ProjectCategoryService;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class ProjectCategoryControllerTest extends TestCase
{
    public function testGetProjectCategoriesInterface()
    {
        $this->actingAs($this->user);
        $response = $this->get(route('admin'));

        $response->assertStatus(200);
    }

    public function testGetProjectCategories()
    {
        $response = $this->get('/api/project-categories');

        $response->assertStatus(200);
    }

    public function testPostCreateProjectCategory()
    {
        $this->mock(ProjectCategoryService::class, function ($mock) {
            $mock->shouldReceive('createProjectCategory')->once()->andReturn(ProjectCategory::factory()->create());
        });
        $this->actingAs($this->user);
        $response = $this->post('api/project-categories/create', [
            'name' => $this->faker->word(),
            'description' => $this->faker->sentence(),
            'image' => UploadedFile::fake()->image('test.png'),
            'order' => $this->faker->randomDigit()
        ]);

        $response->assertStatus(200);
    }

    public function testPostEditProjectCategory()
    {
        $projectCategory = ProjectCategory::factory()->create();
        $this->mock(ProjectCategoryService::class, function ($mock) use ($projectCategory) {
            $mock->shouldReceive('editProjectCategory')->once()->andReturn($projectCategory);
        });
        $this->actingAs($this->user);
        $response = $this->post('api/project-categories/update', [
            'id' => $projectCategory->getKey(),
            'name' => $this->faker->word(),
            'description' => $this->faker->sentence(),
            'order' => $this->faker->randomDigit()
        ]);

        $response->assertStatus(200);
    }

    public function testPostDeleteProjectCategory()
    {
        $projectCategory = ProjectCategory::factory()->create();
        $this->mock(ProjectCategoryService::class, function ($mock) {
            $mock->shouldReceive('deleteProjectCategory')->once()->andReturnTrue();
        });
        $this->actingAs($this->user);
        $response = $this->post('api/project-categories/delete', [
            'id' => $projectCategory->getKey()
        ]);

        $response->assertStatus(200);
    }
}
