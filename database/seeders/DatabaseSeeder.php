<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        
        $user = User::first();

        Category::factory()
            ->state(new Sequence([
                'name' => 'Work & Stuff'
            ], [
                'name' => 'Other Tasks'
            ]))
            ->for($user)
            ->create();

        Task::factory(15)
            ->for($user)
            ->for(Category::first())
            ->create();

        collect([
            "Communication",
            "Organization",
            "Research",
            "Creative",
            "Administrative",
            "Problem Solving",
            "Project Management",
            "Learning and Development",
            "Health and Fitness",
            "Home and Chores",
            "Education",
            "Entertainment",
            "Networking",
            "Financial Management",
            "Travel and Exploration"
        ])->map(fn (string $category) => [
            'name' => $category,
            'user_id' => $user->getKey(),
            'slug' => str($category)->slug(),
        ])->tap(fn (Collection $categories) 
            => Category::insert($categories->toArray())
        );
    }
}
