<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use App\Models\Category;
use App\Models\CategoryManager;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
 public function index()
{
    $user = Auth::user(); // Récupérer l'utilisateur actuel

    // Récupérer les catégories gérées par l'utilisateur actuel
    $managedCategories = CategoryManager::where('user_id', $user->id)->pluck('category_id');

    // Récupérer les catégories avec les articles non publiés
    $categories = Category::with(['articles' => function($query) {
        $query->where('status', '!=', 'Publie'); // Articles non publiés
    }])
    ->whereIn('id', $managedCategories)
    ->get();

    // Récupérer les abonnements associés aux catégories gérées par l'utilisateur
    $subscriptions = Subscription::whereIn('category_id', $managedCategories)
        ->orderBy('users.name', 'asc') // Trier par le nom de l'utilisateur de manière ascendante
        ->join('users', 'subscriptions.user_id', '=', 'users.id') // Joindre la table des utilisateurs
        ->select('subscriptions.*', 'users.name') // Sélectionner uniquement les colonnes nécessaires
        ->get();

    // Passer les données à la vue
    return view('dashboard', compact('categories', 'subscriptions'));
}
}
