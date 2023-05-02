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
            ->count(5)
            ->create();
        Project::factory()
            ->for(ProjectCategory::factory())
            ->count(5)
            ->create();
        ProjectCategory::factory()
            ->count(5)
            ->create();
    }
}
