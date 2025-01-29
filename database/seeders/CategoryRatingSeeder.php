<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\CategoryRating;
use App\Models\User;
use Illuminate\Database\Seeder;

class CategoryRatingSeeder extends Seeder
{
    // La méthode run est utilisée pour insérer des évaluations de catégories par les utilisateurs
    public function run()
    {
        // Récupération des utilisateurs ayant le rôle "subscriber"
        $users = User::where('role', 'subscriber')->get();
        
        // Récupération de toutes les catégories
        $categories = Category::all();

        // Boucle à travers toutes les catégories
        foreach ($categories as $category) {
            // Pour chaque catégorie, créer 30 évaluations
            for ($i = 1; $i <= 30; $i++) {
                // Sélection aléatoire d'un utilisateur
                $user = $users->random();

                // Vérification si l'évaluation existe déjà, sinon création avec une note aléatoire entre 3 et 5
                CategoryRating::firstOrCreate(
                    ['user_id' => $user->id, 'category_id' => $category->id], // Condition d'unicité (utilisateur et catégorie)
                    ['rating' => rand(3, 5)] // Valeur aléatoire de la note (entre 3 et 5)
                );
            }
        }
    }
}
