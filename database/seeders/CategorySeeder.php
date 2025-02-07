<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = [
            [
                'name' => 'Intelligence Artificielle',
                'description' => 'Découvrez les avancées en IA et ses applications modernes.',
                'image' => 'categories/ia1.png',
                'bgImg'=>'categories/ia2.png',
            ],
            [
                'name' => 'Internet des Objets',
                'description' => 'Connectez le monde physique au numérique avec IoT.',
                'image' => 'categories/ob1.png',
                'bgImg'=> 'categories/ob2.png',
            ],
            [
                'name' => 'Cybersécurité',
                'description' => 'Protégez vos données et votre vie numérique.',
                'image' => 'categories/cs1.png',
                'bgImg'=> 'categories/cs2.png',
            ],
            [
                'name' => 'Réalité Virtuelle',
                'description' => 'Explorez de nouveaux mondes grâce à la réalité virtuelle.',
                'image' => 'categories/vr1.png',
                'bgImg'=> 'categories/vr2.png',
            ],
            [
                'name' => 'Réalité Augmentée',
                'description' => 'Fusionnez le monde réel et virtuel avec AR.',
                'image' => 'categories/ar1.png',
                'bgImg'=> 'categories/ar2.png',
            ],
            [
                'name' => 'Blockchain',
                'description' => 'Explorez la technologie blockchain et ses applications dans les cryptomonnaies.',
                'image' => 'categories/bc1.png',
                'bgImg'=> 'categories/bc2.png',
            ],
            [
                'name' => 'Réseaux 5G',
                'description' => 'Découvrez l\'avenir de la connexion rapide et des technologies associées à la 5G.',
                'image' => 'categories/g1.png',
                'bgImg'=> 'categories/g2.png',
            ],
            [
                'name' => 'Automatisation',
                'description' => 'Comment les robots et l\'automatisation influencent l\'industrie et les services.',
                'image' => 'categories/rob1.png',
                'bgImg'=> 'categories/rob2.png',
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
