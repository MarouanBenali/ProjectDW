<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\CategoryManager;
use App\Models\User;
use Illuminate\Database\Seeder;

class CategoryManagerSeeder extends Seeder
{
    public function run()
    {
        $categories = Category::all();
        $managers = User::where('role', 'manager')->get();

        foreach ($categories as $category) {
            CategoryManager::create([
                'user_id' => $managers->random()->id,
                'category_id' => $category->id,
            ]);
        }
    }
}