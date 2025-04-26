<?php

namespace Database\Seeders;

use App\Models\Tag;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::factory(10)->create();
        $categories = Category::all();
        $tags = Tag::all();

        if ($categories->count() < 5 || $tags->count() < 5) {
            $this->command->warn('Make sure you have at least 5 categories and 5 tags.');
            return;
        }

        $categoryCount = $categories->count();

        foreach ($users as $index => $user) {
            for ($i = 0; $i < 5; $i++) {
                $category = $categories[$i % $categoryCount]; // Rotate categories
                $title = "Post {$i} by {$user->name}";
                $content = collect(range(1, 3))->map(fn () => fake()->paragraph(10, true))->implode("\n\n");

                $post = Post::create([
                    'category_id' => $category->id,
                    'title' => Str::headline($title),
                    'slug' => Str::slug($title) . '-' . Str::random(5),
                    'content' => $content,
                    'user_id' => $user->id,
                    'is_published' => true,
                    'published_at' => now()->subMonths(3)->addDays(rand(0, 90)),
                ]);

                // Attach 5 random tags
                $post->tags()->attach($tags->random(5)->pluck('id')->toArray());
            }
        }
    }
}
