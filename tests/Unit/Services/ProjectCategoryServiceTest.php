<?php

namespace Tests\Unit\Services;

use App\Models\ProjectCategory;
use App\Services\ProjectCategoryService;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
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
        Storage::fake('categories');

        $name = $this->faker->word();
        $description = $this->faker->sentence();
        $order = $this->faker->randomDigit();

        $category = $this->projectCategoryService->createProjectCategory($name, $description, UploadedFile::fake()->image('test.png'), $order);

        $this->assertDatabaseHas('project_categories', [
            'name' => $name,
            'description' => $description,
            'order' => $order
        ]);

        Storage::disk('categories')->assertExists($category->image);
    }

    public function testEditProjectCategory()
    {
        Storage::fake('categories');

        $category = ProjectCategory::factory()->create();
        $newName = $this->faker->word();
        $newDescription = $this->faker->sentence();
        $newOrder = $this->faker->randomDigit();

        $response = $this->projectCategoryService->editProjectCategory($category, $newName, $newDescription, $newOrder, UploadedFile::fake()->image('test.png'));

        $this->assertDatabaseHas('project_categories', [
            'id' => $category->getKey(),
            'name' => $newName,
            'description' => $newDescription,
            'order' => $newOrder
        ]);

        Storage::disk('categories')->assertExists($response->image);
    }

    public function testDeleteProjectCategory()
    {
        Storage::fake('categories');

        $category = ProjectCategory::factory()->create();

        $response = $this->projectCategoryService->deleteProjectCategory($category);

        $this->assertTrue($response);

        Storage::disk('categories')->assertMissing($category->image);
    }
}
