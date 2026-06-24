<?php

namespace Database\Factories;

use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProjectMedia>
 */
class ProjectMediaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $fileName = $this->faker->word() . '.jpg';
        return [
            'project_id' => Project::factory(),
            'order' => $this->faker->numberBetween(1, 10),
            'path' => UploadedFile::fake()->image($fileName)->storeAs('/', $fileName, 'media'),
        ];
    }
}
