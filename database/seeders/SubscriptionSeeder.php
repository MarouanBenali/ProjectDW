<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class SubscriptionSeeder extends Seeder
{
    public function run()
    {
        $users = User::where('role', 'subscriber')->get();

        $categories = Category::all();

    
        if ($users->isEmpty() || $categories->isEmpty()) {
            $this->command->info('No users or categories found. Skipping subscription seeding.');
            return;
        }


        $createdAt = Carbon::now()->subMonths(6); 
        $updatedAt = Carbon::now(); 

        foreach ($users as $user) {
            $randomCategories = $categories->random(min(3, $categories->count()))->unique();

            foreach ($randomCategories as $category) {
                Subscription::create([
                    'user_id' => $user->id,
                    'category_id' => $category->id,
                    'created_at' => $createdAt, 
                    'updated_at' => $updatedAt, 
                ]);

                $createdAt = $createdAt->addDay();
            }
        }
    }
}