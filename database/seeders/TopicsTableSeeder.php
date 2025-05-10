<?php

namespace Database\Seeders;

use App\Models\Topic;
use App\Models\Reply;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TopicsTableSeeder extends Seeder
{
    public function run(): void
    {
        // Create users if none exist
        if (User::count() === 0) {
            User::factory()->count(10)->create();
        }

        $users = User::all();



        // Create 20 topics
        Topic::factory()->count(20)->create()->each(function ($topic) use ($users) {
            // Assign a random user as topic creator
            $topic->user_id = $users->random()->id;
            $topic->views_count = rand(0, 500);
            $topic->save();

            $topic->users()->attach(
                $users->random(rand(1, 4))->pluck('id')->toArray()
            );

            // Create 2 to 10 replies for each topic
            Reply::factory()->count(rand(2, 10))->create([
                'topic_id' => $topic->id,
                'user_id' => $users->random()->id,
            ]);
        });
    }
}
