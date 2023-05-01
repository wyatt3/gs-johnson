<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\ProjectCategory;
use App\Models\ProjectMedia;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->word(),
            'description' => $this->faker->sentences(4, true),
            'category_id' => ProjectCategory::factory(),
            'order' => $this->faker->numberBetween(1, 100)
        ];
    }

    public function withMedia()
    {
        return $this->afterCreating(function (Project $project) {
            $media = ProjectMedia::factory()->count(2)->make();
            foreach ($media as $photo) {
                $project->media()->save($photo);
            }
        });
    }
}
