<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\ForumCategory;
use App\Models\Topic;
use App\Models\Reply;
use App\Models\Tag;

class ForumSeeder extends Seeder
{
    public function run()
    {
        // Create Users
        User::factory()->count(10)->create();

        // Create Categories
        $categories = ForumCategory::factory()->count(5)->create();


        // Create Topics
        $categories->each(function ($category) {
            Topic::factory()->count(10)->create([
                'forum_category_id' => $category->id,
                'user_id' => User::inRandomOrder()->first()->id,
                'views_count' => rand(0, 100),
            ])->each(function ($topic) {
                // Attach random tags

                // Create Replies
                Reply::factory()->count(rand(2, 6))->create([
                    'topic_id' => $topic->id,
                    'user_id' => User::inRandomOrder()->first()->id,
                ]);
            });
        });
    }
}
