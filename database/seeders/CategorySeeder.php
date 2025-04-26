<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Str;
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Technology Trends',
            'Health & Wellness',
            'Travel & Adventure',
            'Food & Recipes',
            'Personal Development',
        ];

        foreach ($categories as $name) {
            Category::create([
                'cat_name' => $name,
                'cat_slug' => Str::slug($name),
                'cat_desc' => "This is the description for {$name} category.",
            ]);
        }
    }
}
