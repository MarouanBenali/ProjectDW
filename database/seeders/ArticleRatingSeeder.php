<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\ArticleRating;
use App\Models\User;
use Illuminate\Database\Seeder;

class ArticleRatingSeeder extends Seeder
{
    // La méthode run est utilisée pour insérer des données de test dans la table "article_ratings"
    public function run()
    {
        // Récupération des utilisateurs ayant le rôle "subscriber"
        $users = User::where('role', 'subscriber')->get();
        
        // Récupération de tous les articles
        $articles = Article::all();

        // Pour chaque article, on va ajouter des évaluations
        foreach ($articles as $article) {
            // Pour chaque article, on va ajouter 3 évaluations
            for ($i = 1; $i <= 3; $i++) {
                // Sélectionner un utilisateur aléatoire parmi les abonnés
                $user = $users->random();

                // Vérifier si l'évaluation a déjà été donnée par cet utilisateur pour cet article
                ArticleRating::firstOrCreate(
                    ['user_id' => $user->id, 'article_id' => $article->id], // Condition unique pour éviter les doublons
                    ['rating' => rand(3, 5)] // Si aucun enregistrement existant, ajouter une évaluation entre 3 et 5
                );
            }
        }
    }
}
