<?php

namespace Database\Factories;

use App\Enums\Priority;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(5),
            'priority' => fake()->randomElement(Priority::cases()),
            'description' => fake()->simpleMarkdown(),
            'user_id' => User::factory(),
            'category_id' => Category::factory(),
        ];
    }
}
