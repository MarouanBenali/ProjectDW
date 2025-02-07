<?php

namespace Database\Seeders;

use App\Models\History;
use Illuminate\Database\Seeder;

class HistorySeeder extends Seeder
{
    public function run()
    {
        $histories = [
            ['user_id' => 1, 'article_id' => 1],
            ['user_id' => 2, 'article_id' => 1],
            ['user_id' => 3, 'article_id' => 2],
            ['user_id' => 4, 'article_id' => 2],
            ['user_id' => 1, 'article_id' => 3],
            ['user_id' => 2, 'article_id' => 3],
            ['user_id' => 3, 'article_id' => 4],
            ['user_id' => 4, 'article_id' => 4],
            ['user_id' => 1, 'article_id' => 5],
            ['user_id' => 2, 'article_id' => 5],
            ['user_id' => 3, 'article_id' => 6],
            ['user_id' => 4, 'article_id' => 6],
            ['user_id' => 1, 'article_id' => 7],
            ['user_id' => 2, 'article_id' => 7],
            ['user_id' => 3, 'article_id' => 8],
            ['user_id' => 4, 'article_id' => 8],
            ['user_id' => 1, 'article_id' => 9],
            ['user_id' => 2, 'article_id' => 9],
            ['user_id' => 3, 'article_id' => 1],
            ['user_id' => 4, 'article_id' => 1],
            ['user_id' => 1, 'article_id' => 10],
            ['user_id' => 2, 'article_id' => 12],
            ['user_id' => 3, 'article_id' => 16],
            ['user_id' => 4, 'article_id' => 13],
            ['user_id' => 1, 'article_id' => 11],
            ['user_id' => 2, 'article_id' => 13],
            ['user_id' => 3, 'article_id' => 17],
            ['user_id' => 4, 'article_id' => 19],
        ];

        foreach ($histories as $history) {
            History::create($history);
        }
    }
}
