<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Category;
use App\Models\Statistic;
use App\Models\User;
use Illuminate\Database\Seeder;

class StatisticSeeder extends Seeder
{
    public function run()
    {
        $articles = Article::all();
        $users = User::where('role', 'subscriber')->get();
        $categories = Category::all();

        foreach ($articles as $article) {
            Statistic::create([
                'user_id' => $users->random()->id,
                'article_id' => $article->id,
                'category_id' => $categories->random()->id,
                'views_count' => rand(100, 1000),
                'comments_count' => rand(5, 50),
                'subscribers_count' => rand(10, 100),
                'likes_count' => rand(20, 200),
            ]);
        }
    }
}