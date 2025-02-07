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
        $j = 0;
        //Subscribers
        for ($i = 1; $i <= 20; $i++) {
            User::create([
                'name' => $faker->firstName . ' ' . $faker->lastName,
                'email' => "subscriber$i@gmail.com",
                'password' => Hash::make('111111111111'),
                'phone_number' => '1234567890',
                'profile_picture' => "profile_pictures/image ($j).jpg",
                'date_of_birth' => '1990-01-01',
                'gender' => 'male',
                'preferred_language' => 'fr',
                'role' => 'subscriber',
                'is_banned'=> 0,
            ]);
            $j++;
        }
        $j=6;
        // (Managers)
        for ($i = 1; $i <= 5; $i++) {
            User::create([
                'name' => $faker->firstName . ' ' . $faker->lastName,
                'email' => "manager$i@gmail.com",
                'password' => Hash::make('111111111111'),
                'phone_number' => '1234567890',
                'profile_picture' => "profile_pictures/image ($j).jpg",
                'date_of_birth' => '1985-01-01',
                'gender' => 'male',
                'preferred_language' => 'fr',
                'role' => 'manager',
                'is_banned'=> 0,
            ]);
            $j++;
        }

        //  (Editors)
        for ($i = 1; $i <= 5; $i++) {
            User::create([
                'name' => $faker->firstName . ' ' . $faker->lastName,
                'email' => "editor$i@gmail.com",
                'password' => Hash::make('111111111111'),
                'phone_number' => '1234567890',
                'profile_picture' => "profile_pictures/image ($j).jpg",
                'date_of_birth' => '1980-01-01',
                'gender' => 'male',
                'preferred_language' => 'fr',
                'role' => 'editor',
                'is_banned'=> 0,
            ]);
            $j++;
        }
    }
}