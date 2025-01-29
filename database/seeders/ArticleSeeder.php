<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Category;
use App\Models\Issue;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Faker\Factory as Faker;

class ArticleSeeder extends Seeder
{
    // La méthode run est utilisée pour insérer des données de test dans la table "articles"
    public function run()
    {
        // Utilisation de Faker pour générer des données fictives
        $faker = Faker::create();

        // Récupération des utilisateurs ayant le rôle "editor"
        $users = User::where('role', 'editor')->get();

        // Récupération de toutes les catégories
        $categories = Category::all();

        // Récupération de tous les numéros d'édition (issues)
        $issues = Issue::all();

        // Si les utilisateurs, catégories ou numéros sont vides, la génération des articles est interrompue
        if ($users->isEmpty() || $categories->isEmpty() || $issues->isEmpty()) {
            $this->command->info('No users, categories, or issues found. Skipping article seeding.');
            return;
        }

        // Définition d'une date de création par défaut (6 mois en arrière)
        $createdAt = Carbon::now()->subMonths(6); // Avant 6 mois à partir d'aujourd'hui

        // Génération de 30 articles
        for ($i = 0; $i < 30; $i++) {
            Article::create([
                'user_id' => $users->random()->id, // Utilisateur aléatoire ayant le rôle 'editor'
                'issue_id' => $issues->random()->id, // Numéro d'édition aléatoire
                'category_id' => $categories->random()->id, // Catégorie aléatoire
                'title' => $faker->sentence, // Titre aléatoire
                'content' => $faker->paragraphs(3, true), // Contenu aléatoire (3 paragraphes)
                'status' => $faker->randomElement(['published', 'draft']), // Statut aléatoire (publié ou brouillon)
                'visibility' => $faker->randomElement(['public', 'private']), // Visibilité aléatoire (public ou privé)
                'created_at' => $createdAt, // Date de création fixe
                'updated_at' => Carbon::now(), // Date de mise à jour actuelle
            ]);

            // Incrémentation de la date de création pour le prochain article (ajout de 1 jour)
            $createdAt = $createdAt->addDay();
        }
    }
}
