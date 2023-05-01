<?php

namespace Tests\Feature;

use App\Facades\ProjectCategoryService;
use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DeletionTest extends TestCase
{
    public function testDeletes()
    {
        $project = Project::factory()->withMedia()->create();

        ProjectCategoryService::deleteProjectCategory($project->projectCategory);

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
