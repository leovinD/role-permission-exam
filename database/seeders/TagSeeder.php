<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Str;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = ['Laravel', 'PHP', 'Web Development', 'MySQL', 'JavaScript'];

        foreach ($tags as $name) {
            Tag::create([
                'tag_name' => $name,
                'tag_slug' => Str::slug($name),
                'tag_desc' => "This tag covers topics related to {$name}.",
            ]);
        }
    }
}
