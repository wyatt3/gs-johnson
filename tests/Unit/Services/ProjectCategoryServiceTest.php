<?php

namespace Tests\Unit\Services;

use App\Models\ProjectCategory;
use App\Services\ProjectCategoryService;
use Tests\TestCase;

class ProjectCategoryServiceTest extends TestCase
{
    private ProjectCategoryService $projectCategoryService;

    public function setUp(): void
    {
        parent::setUp();
        $this->projectCategoryService = resolve(ProjectCategoryService::class);
    }

    public function testCreateProjectCategory()
    {
        $category = ProjectCategory::factory()->make();

        $this->projectCategoryService->createProjectCategory($category->name, $category->order);

        $this->assertDatabaseHas('project_categories', [
            'name' => $category->name,
            'order' => $category->order
        ]);
    }

    public function testeditProjectCategory()
    {
        $category = ProjectCategory::factory()->create();
        $newCategory = ProjectCategory::factory()->make();

        $response = $this->projectCategoryService->editProjectCategory($category, $newCategory->name, $newCategory->order);

        $category->refresh();
        $this->assertEquals($category->toArray(), $response->toArray());
    }

    public function testDeleteProjectCategory()
    {
        $category = ProjectCategory::factory()->create();

        $response = $this->projectCategoryService->deleteProjectCategory($category);

        $this->assertTrue($response);
    }
}
