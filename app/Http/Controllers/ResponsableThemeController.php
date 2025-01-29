<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Article;
use App\Models\Subscription;
use App\Models\Conversation;
use App\Models\Statistic;

class ResponsableThemeController extends Controller
{
    public function index()
    {
        // Récupérer le premier sujet (catégorie) géré par le responsable
        $category = Category::first();

        // Vérifier si une catégorie a été trouvée
        if (!$category) {
            return redirect()->back()->with('error', 'Aucune catégorie trouvée.');
        }

        // Récupérer les articles liés à cette catégorie
        $articles = $category->articles;

        // Récupérer les abonnements liés à cette catégorie
        $subscriptions = $category->subscriptions;

        // Récupérer les conversations liées aux articles de cette catégorie
        $conversations = Conversation::whereIn('article_id', $articles->pluck('id'))->get();

        // Calculer les statistiques des articles de cette catégorie
        $statistics = [
            'articles_count' => $articles->count(), // Nombre d'articles
            'subscribers_count' => $subscriptions->count(), // Nombre d'abonnés
            'views_count' => Statistic::whereIn('article_id', $articles->pluck('id'))->sum('views'), // Nombre total de vues
            'likes_count' => Statistic::whereIn('article_id', $articles->pluck('id'))->sum('likes'), // Nombre total de likes
        ];

        // Retourner la vue avec toutes les données récupérées
        return view('dashboard', compact('articles', 'subscriptions', 'conversations', 'statistics'));
    }
}
