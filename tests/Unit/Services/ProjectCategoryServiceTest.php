<?php

namespace Tests\Unit\Services;

use App\Facades\ProjectCategoryService;
use App\Models\ProjectCategory;
use Tests\TestCase;

class ProjectCategoryServiceTest extends TestCase
{

    public function setUp(): void
    {
        parent::setUp();
    }

    public function testCreateProjectCategory()
    {
        $category = ProjectCategory::factory()->make();

        ProjectCategoryService::createProjectCategory($category->name, $category->order);

        $this->assertDatabaseHas('project_categories', [
            'name' => $category->name,
            'order' => $category->order
        ]);
    }

    public function testeditProjectCategory()
    {
        $category = ProjectCategory::factory()->create();
        $newCategory = ProjectCategory::factory()->make();

        $response = ProjectCategoryService::editProjectCategory($category, $newCategory->name, $newCategory->order);

        $category->refresh();
        $this->assertEquals($category->toArray(), $response->toArray());
    }

    public function testDeleteProjectCategory()
    {
        $category = ProjectCategory::factory()->create();

        $response = ProjectCategoryService::deleteProjectCategory($category);

        $this->assertTrue($response);
    }
}
