<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            UserSeeder::class,
            CategorySeeder::class,
            IssueSeeder::class,
            ArticleSeeder::class,
            ArticleRatingSeeder::class,
            CategoryRatingSeeder::class,
            SubscriptionSeeder::class,
            ConversationSeeder::class,
            MessageSeeder::class,
            NotificationSeeder::class,
            StatisticSeeder::class,
            CategoryManagerSeeder::class,
        ]);
    }
}