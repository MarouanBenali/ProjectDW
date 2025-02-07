<?php

namespace Database\Seeders;

use App\Models\ArticleRating;
use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ArticleRatingSeeder extends Seeder
{
    public function run()
{
    $faker = Faker::create();

    foreach (range(1, 100) as $index) {
        $article = Article::inRandomOrder()->first(); 
        $user = User::inRandomOrder()->first(); 

        if (!ArticleRating::where('user_id', $user->id)->where('article_id', $article->id)->exists()) {
            ArticleRating::create([
                'user_id' => $user->id,
                'article_id' => $article->id,
                'rating' => $faker->numberBetween(1, 5), 
            ]);
        }
    }
}

}
