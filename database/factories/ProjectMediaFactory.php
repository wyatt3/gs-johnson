<?php

namespace Database\Factories;

use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectMediaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'project_id' => Project::factory(),
            'order' => $this->faker->numberBetween(1, 10),
            'path' => $this->faker->image('public/storage/media', 1, 1, null, false)
        ];
    }
}
