<?php

namespace Tests\Unit\Controllers;

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
}
