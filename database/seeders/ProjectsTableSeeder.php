<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\ProjectCategory;
use Illuminate\Database\Seeder;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Project::factory()
            ->for(ProjectCategory::factory())
            ->withMedia()
            ->count(2)
            ->create();
        Project::factory()
            ->for(ProjectCategory::factory())
            ->withMedia()
            ->count(2)
            ->create();
    }
}
