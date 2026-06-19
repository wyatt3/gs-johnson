<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Services\ProjectCategoryService;
use Tests\TestCase;

class DeletionTest extends TestCase
{
    private ProjectCategoryService $projectCategoryService;
    public function setUp(): void
    {
        parent::setUp();
        $this->projectCategoryService = resolve(ProjectCategoryService::class);
    }

    public function testDeletes()
    {
        $project = Project::factory()->withMedia()->create();

        $this->projectCategoryService->deleteProjectCategory($project->projectCategory);

        $this->assertDatabaseMissing('project_categories', [
            'id' => $project->projectCategory->getKey()
        ]);

        $this->assertDatabaseMissing('projects', [
            'id' => $project->getKey()
        ]);

        $this->assertDatabaseMissing('project_media', [
            'project_id' => $project->getKey()
        ]);
    }
}
