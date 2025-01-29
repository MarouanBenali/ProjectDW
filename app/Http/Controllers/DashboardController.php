<?php

namespace App\Http\Controllers;
use App\Models\Subscription;
use App\Models\Category;
use App\Models\Conversation;
use App\Models\CategoryManager;
use App\Models\Statistic;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller{
    public function index(){
    $user = Auth::user(); // Récupérer l'utilisateur actuel

    // Récupérer les catégories gérées par l'utilisateur actuel
    $managedCategories = CategoryManager::where('user_id', $user->id)->pluck('category_id');

    // Récupérer les catégories complètes en fonction des IDs
    $categories = Category::whereIn('id', $managedCategories)->with('articles.user')->get();

    // Récupérer les abonnements associés aux catégories gérées par l'utilisateur
    $subscriptions = Subscription::whereIn('category_id', $managedCategories)
    ->with('user') // Récupérer la relation utilisateur
    ->join('users', 'subscriptions.user_id', '=', 'users.id') // Joindre la table des utilisateurs
    ->orderBy('users.name', 'asc') // Trier par le nom de l'utilisateur de manière ascendante
    ->select('subscriptions.*') // Sélectionner uniquement les colonnes des abonnements pour éviter les conflits
    ->get();

    // Récupérer les conversations liées aux articles gérés par l'utilisateur
    $conversations = Conversation::whereIn('article_id', $categories->pluck('articles.*.id')->flatten())
        ->with('user')
        ->get();

    // Calculer les statistiques
    $statistics = [
        'articles_count' => $categories->pluck('articles')->flatten()->count(), // Compter le nombre d'articles
        'subscribers_count' => $subscriptions->count(), // Compter le nombre d'abonnés
        'views_count' => Statistic::whereIn('article_id', $categories->pluck('articles.*.id')->flatten())->sum('views_count'), // Calculer le nombre total de vues
        'likes_count' => Statistic::whereIn('article_id', $categories->pluck('articles.*.id')->flatten())->sum('likes_count'), // Calculer le nombre total de likes
    ];

    // Passer les données à la vue
    return view('dashboard', compact('categories', 'subscriptions', 'conversations', 'statistics'));
}
}
