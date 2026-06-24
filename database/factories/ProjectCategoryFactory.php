<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProjectCategory>
 */
class ProjectCategoryFactory extends Factory
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
            'name' => $this->faker->word(),
            'description' => $this->faker->sentence(),
            'image' => UploadedFile::fake()->image($fileName)->storeAs('/', $fileName, 'categories'),
            'order' => $this->faker->numberBetween(1, 100),
        ];
    }
}
