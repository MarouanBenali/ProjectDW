<?php

namespace Database\Seeders;

use App\Models\CategoryManager;
use Illuminate\Database\Seeder;

class CategoryManagerSeeder extends Seeder
{
    public function run()
    {
        $managers = [
            [
                'user_id' => 21,
                'category_id' => 1,
            ],
            [
                'user_id' => 21,
                'category_id' => 2,
            ],
            [
                'user_id' => 21,
                'category_id' => 3,
            ],
            [
                'user_id' => 21,
                'category_id' => 4,
            ],
            [
                'user_id' => 21,
                'category_id' => 5,
            ],
            [
                'user_id' => 22,
                'category_id' => 6,
            ],
            [
                'user_id' => 22,
                'category_id' => 7,
            ],
            [
                'user_id' => 22,
                'category_id' => 8,
            ],
            [
                'user_id' => 22,
                'category_id' => 1,
            ],
            [
                'user_id' => 23,
                'category_id' => 5,
            ],
            [
                'user_id' => 23,
                'category_id' => 6,
            ],
            [
                'user_id' => 23,
                'category_id' => 7,
            ],
            [
                'user_id' => 23,
                'category_id' => 8,
            ],
            [
                'user_id' => 24,
                'category_id' => 1,
            ],
            [
                'user_id' => 24,
                'category_id' => 8,
            ],
            [
                'user_id' => 24,
                'category_id' => 1,
            ],
            [
                'user_id' => 24,
                'category_id' => 3,
            ],
            [
                'user_id' => 25,
                'category_id' => 1,
            ],
            [
                'user_id' => 25,
                'category_id' => 2,
            ],
            [
                'user_id' => 25,
                'category_id' => 7,
            ],
        ];

        foreach ($managers as $manager) {
            CategoryManager::create($manager);
        }
    }
}
