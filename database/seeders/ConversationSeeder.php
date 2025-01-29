<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Conversation;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class ConversationSeeder extends Seeder
{
    public function run()
    {
        $articles = Article::all();
        $users = User::all();

      
        if ($articles->isEmpty() || $users->isEmpty()) {
            $this->command->info('No articles or users found. Skipping conversation seeding.');
            return;
        }

        foreach ($articles as $article) {
         
            $randomUsers = $users->random(min(5, $users->count()))->unique();

            foreach ($randomUsers as $user) {
                Conversation::create([
                    'article_id' => $article->id,
                    'user_id' => $user->id,
                    'created_at' => Carbon::now(), 
                    'updated_at' => Carbon::now(), 
                ]);
            }
        }
    }
}