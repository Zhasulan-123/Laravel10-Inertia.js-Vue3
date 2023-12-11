<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\File>
 */
class FileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_entered_name' => fake()->sentence,
            'original_file_name' => fake()->sentence,
            'size' => fake()->sentence,
            'extension' => fake()->sentence,

            // 'content' => fake()->text(500)
        ];
    }
}