<?php

namespace Database\Seeders;

use App\Models\CategoryRating;
use Illuminate\Database\Seeder;

class CategoryRatingSeeder extends Seeder
{
    public function run()
    {
        $ratings = [
            ['user_id' => 1, 'category_id' => 1, 'rating' => 5],
            ['user_id' => 2, 'category_id' => 1, 'rating' => 4],
            ['user_id' => 3, 'category_id' => 1, 'rating' => 3],
            ['user_id' => 4, 'category_id' => 1, 'rating' => 5],
            ['user_id' => 5, 'category_id' => 1, 'rating' => 2],

            ['user_id' => 1, 'category_id' => 2, 'rating' => 3],
            ['user_id' => 2, 'category_id' => 2, 'rating' => 5],
            ['user_id' => 3, 'category_id' => 2, 'rating' => 4],
            ['user_id' => 4, 'category_id' => 2, 'rating' => 3],
            ['user_id' => 5, 'category_id' => 2, 'rating' => 5],

            ['user_id' => 1, 'category_id' => 3, 'rating' => 4],
            ['user_id' => 2, 'category_id' => 3, 'rating' => 2],
            ['user_id' => 3, 'category_id' => 3, 'rating' => 5],
            ['user_id' => 4, 'category_id' => 3, 'rating' => 3],
            ['user_id' => 5, 'category_id' => 3, 'rating' => 4],

            ['user_id' => 1, 'category_id' => 4, 'rating' => 5],
            ['user_id' => 2, 'category_id' => 4, 'rating' => 3],
            ['user_id' => 3, 'category_id' => 4, 'rating' => 4],
            ['user_id' => 4, 'category_id' => 4, 'rating' => 2],
            ['user_id' => 5, 'category_id' => 4, 'rating' => 5],

            ['user_id' => 1, 'category_id' => 5, 'rating' => 2],
            ['user_id' => 2, 'category_id' => 5, 'rating' => 4],
            ['user_id' => 3, 'category_id' => 5, 'rating' => 3],
            ['user_id' => 4, 'category_id' => 5, 'rating' => 5],
            ['user_id' => 5, 'category_id' => 5, 'rating' => 3],

            ['user_id' => 1, 'category_id' => 6, 'rating' => 3],
            ['user_id' => 2, 'category_id' => 6, 'rating' => 5],
            ['user_id' => 3, 'category_id' => 6, 'rating' => 4],
            ['user_id' => 4, 'category_id' => 6, 'rating' => 3],
            ['user_id' => 5, 'category_id' => 6, 'rating' => 2],

            ['user_id' => 1, 'category_id' => 7, 'rating' => 4],
            ['user_id' => 2, 'category_id' => 7, 'rating' => 3],
            ['user_id' => 3, 'category_id' => 7, 'rating' => 5],
            ['user_id' => 4, 'category_id' => 7, 'rating' => 4],
            ['user_id' => 5, 'category_id' => 7, 'rating' => 5],

            ['user_id' => 1, 'category_id' => 8, 'rating' => 5],
            ['user_id' => 2, 'category_id' => 8, 'rating' => 4],
            ['user_id' => 3, 'category_id' => 8, 'rating' => 3],
            ['user_id' => 4, 'category_id' => 8, 'rating' => 5],
            ['user_id' => 5, 'category_id' => 8, 'rating' => 4],
        ];

        foreach ($ratings as $rating) {
            CategoryRating::create($rating);
        }
    }
}
