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
                'image' => 'img/ia1.png',
                'nbr_visitors' => 1200,
                'link' => '/categories/ia',
            ],
            [
                'name' => 'Internet des Objets',
                'description' => 'Connectez le monde physique au numérique avec IoT.',
                'image' => 'img/ob1.png',
                'nbr_visitors' => 950,
                'link' => '/categories/iot',
            ],
            [
                'name' => 'Cybersécurité',
                'description' => 'Protégez vos données et votre vie numérique.',
                'image' => 'img/cs1.png',
                'nbr_visitors' => 1500,
                'link' => '/categories/cyber',
            ],
            [
                'name' => 'Réalité Virtuelle',
                'description' => 'Explorez de nouveaux mondes grâce à la réalité virtuelle.',
                'image' => 'img/vr1.png',
                'nbr_visitors' => 1100,
                'link' => '/categories/vr',
            ],
            [
                'name' => 'Réalité Augmentée',
                'description' => 'Fusionnez le monde réel et virtuel avec AR.',
                'image' => 'img/ar1.png',
                'nbr_visitors' => 2000,
                'link' => '/categories/ar',
            ],
            [
                'name' => 'Blockchain et Cryptomonnaies',
                'description' => 'Explorez la technologie blockchain et ses applications dans les cryptomonnaies.',
                'image' => 'img/bc1.png',
                'nbr_visitors' => 1300,
                'link' => '/categories/blockchain',
            ],
            [
                'name' => 'Réseaux 5G',
                'description' => 'Découvrez l\'avenir de la connexion rapide et des technologies associées à la 5G.',
                'image' => 'img/g1.png',
                'nbr_visitors' => 1400,
                'link' => '/categories/5g',
            ],
            [
                'name' => 'Le monde des robots et de l\'automatisation',
                'description' => 'Comment les robots et l\'automatisation influencent l\'industrie et les services.',
                'image' => 'img/rob1.png',
                'nbr_visitors' => 1800,
                'link' => '/categories/robot',
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
