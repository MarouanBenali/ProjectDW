<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CategoryRating;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show($id)
    {
        $category = Category::findOrFail($id); // Recherche de la catégorie par son identifiant (id)

        // Augmenter le nombre de visiteurs
        $category->increment('nbr_visitors');

        return view('categories.show', compact('category')); // Affichage de la vue de la catégorie
    }

    public function store(Request $request, $categoryId)
    {
        // Validation du rating (évaluation)
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5', // L'évaluation doit être un entier entre 1 et 5
        ]);

        // Ajouter ou mettre à jour l'évaluation de la catégorie
        $rating = CategoryRating::firstOrCreate(
            [
                'user_id' => auth()->user()->id, // Identifiant de l'utilisateur connecté
                'category_id' => $categoryId // Identifiant de la catégorie
            ],
            ['rating' => $validated['rating']] // Valeur de l'évaluation
        );

        // Obtenir la catégorie spécifique
        $category = Category::findOrFail($categoryId);

        // Calculer la moyenne des évaluations pour cette catégorie
        $category->calculateRating();

        // Redirection vers la page de la catégorie après l'ajout de l'évaluation
        return redirect()->route('categories.show', $categoryId);
    }

    public function getCategoriesData()
    {
        // Récupérer toutes les catégories avec les articles, évaluations, et statistiques
        $categories = Category::all();

        // Créer un tableau des données à renvoyer à l'interface utilisateur
        $categoriesData = $categories->map(function ($category) {
            // Calcul de la moyenne des évaluations pour la catégorie
            $totalRatings = $category->ratings->count(); // Nombre total d'évaluations
            $averageRating = $totalRatings > 0 ? $category->ratings->avg('rating') : 0; // Calcul de la moyenne des évaluations

            // Calcul du nombre d'articles dans la catégorie
            $totalArticles = $category->articles->count();

            // Nombre de visiteurs de la catégorie
            $totalVisitors = $category->nbr_visitors;

            return [
                'name' => $category->name, // Nom de la catégorie
                'description' => $category->description, // Description de la catégorie
                'image' => $category->image, // Image de la catégorie
                'rating' => $averageRating, // Moyenne des évaluations
                'totalRatings' => $totalRatings, // Nombre total d'évaluations
                'articles' => $totalArticles, // Nombre d'articles
                'visitors' => $totalVisitors, // Nombre de visiteurs
                'link' => $category->link, // Lien de la catégorie
            ];
        });

        // Retourner les données au format JSON
        return response()->json($categoriesData);
    }
}
