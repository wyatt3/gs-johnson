<?php

namespace Database\Factories;

use App\Models\ProjectCategory;
use App\Models\ProjectMedia;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
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

    public function withMedia(): static
    {
        return $this->afterCreating(function ($project) {
            ProjectMedia::factory()->for($project)->count(2)->create();
        });
    }
}
