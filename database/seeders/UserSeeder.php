<?php
namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        //Subscribers
        for ($i = 1; $i <= 5; $i++) {
            User::create([
                'name' => $faker->name,
                'email' => "subscriber$i@gmail.com",
                'password' => Hash::make('111111111111'),
                'phone_number' => '1234567890',
                'profile_picture' => 'profile_pictures/user.png',
                'date_of_birth' => '1990-01-01',
                'gender' => 'male',
                'preferred_language' => 'fr',
                'role' => 'subscriber',
                'is_banned'=> 0,
            ]);
        }

        // (Managers)
        for ($i = 1; $i <= 5; $i++) {
            User::create([
                'name' => $faker->name,
                'email' => "manager$i@gmail.com",
                'password' => Hash::make('111111111111'),
                'phone_number' => '1234567890',
                'profile_picture' => 'profile_pictures/manager.png',
                'date_of_birth' => '1985-01-01',
                'gender' => 'male',
                'preferred_language' => 'fr',
                'role' => 'manager',
                'is_banned'=> 0,
            ]);
        }

        //  (Editors)
        for ($i = 1; $i <= 5; $i++) {
            User::create([
                'name' => $faker->name,
                'email' => "editor$i@gmail.com",
                'password' => Hash::make('111111111111'),
                'phone_number' => '1234567890',
                'profile_picture' => 'profile_pictures/editor.png',
                'date_of_birth' => '1980-01-01',
                'gender' => 'male',
                'preferred_language' => 'fr',
                'role' => 'editor',
                'is_banned'=> 0,
            ]);
        }
    }
}