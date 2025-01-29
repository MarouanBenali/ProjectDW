<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Article;
use App\Models\Issue;
use App\Models\Category;
use App\Models\User;
use App\Models\Subscription;
use App\Models\Conversation;
use App\Models\Notification;
use App\Models\Statistic;

class EditorController extends Controller
{
    public function index()
    {
        // Récupérer les articles proposés pour la publication
        $proposedArticles = Article::where('status', 'proposed')->get();

        // Récupérer tous les numéros
        $issues = Issue::all();

        // Récupérer les statistiques générales
        $statistics = [
            'articles_count' => Article::count(),
            'subscribers_count' => Subscription::count(),
            'views_count' => Statistic::sum('views_count'),
            'likes_count' => Statistic::sum('likes_count'),
        ];

        // Récupérer tous les utilisateurs
        $users = User::all();

        // Récupérer toutes les conversations
        $conversations = Conversation::with('user')->get();

        // Récupérer toutes les catégories
        $categories = Category::all();

        // Passer les données à la vue
        return view('editor', compact(
            'proposedArticles',
            'issues',
            'statistics',
            'users',
            'conversations',
            'categories'
        ));
    }

    // Accepter un article proposé
    public function acceptArticle(Request $request, $id)
    {
        $article = Article::findOrFail($id); // Récupérer l'article
        $article->status = 'published'; // Changer le statut de l'article
        $article->save(); // Sauvegarder les modifications

        // Envoyer une notification à l'utilisateur
        Notification::create([
            'user_id' => $article->user_id,
            'message' => 'Votre article a été accepté : ' . $article->title,
            'type' => 'admin',
        ]);

        // Retourner un message de succès
        return redirect()->back()->with('success', 'Article accepté avec succès.');
    }

    // Refuser un article proposé
    public function rejectArticle(Request $request, $id)
    {
        $article = Article::findOrFail($id); // Récupérer l'article
        $article->status = 'cancelled'; // Changer le statut de l'article
        $article->save(); // Sauvegarder les modifications

        // Envoyer une notification à l'utilisateur
        Notification::create([
            'user_id' => $article->user_id,
            'message' => 'Votre article a été rejeté : ' . $article->title,
            'type' => 'admin',
        ]);

        // Retourner un message de succès
        return redirect()->back()->with('success', 'Article rejeté avec succès.');
    }

    // Publier un numéro
    public function publishIssue(Request $request, $id)
    {
        $issue = Issue::findOrFail($id); // Récupérer le numéro
        $issue->status = 'published'; // Changer le statut du numéro
        $issue->save(); // Sauvegarder les modifications

        return redirect()->back()->with('success', 'Numéro publié avec succès.');
    }

    // Annuler la publication d'un numéro
    public function unpublishIssue(Request $request, $id)
    {
        $issue = Issue::findOrFail($id); // Récupérer le numéro
        $issue->status = 'unpublished'; // Changer le statut du numéro
        $issue->save(); // Sauvegarder les modifications

        return redirect()->back()->with('success', 'Numéro annulé avec succès.');
    }

    // Bannir un utilisateur
    public function banUser(Request $request, $id)
    {
        $user = User::findOrFail($id); // Récupérer l'utilisateur
        $user->is_banned = true; // Marquer l'utilisateur comme banni
        $user->save(); // Sauvegarder les modifications

        return redirect()->back()->with('success', 'Utilisateur banni avec succès.');
    }

    // Annuler le bannissement d'un utilisateur
    public function unbanUser(Request $request, $id)
    {
        $user = User::findOrFail($id); // Récupérer l'utilisateur
        $user->is_banned = false; // Marquer l'utilisateur comme non banni
        $user->save(); // Sauvegarder les modifications

        return redirect()->back()->with('success', 'Bannissement de l\'utilisateur annulé avec succès.');
    }

    // Attribuer le rôle d'éditeur à un utilisateur
    public function assignEditorRole(Request $request, $id)
    {
        $user = User::findOrFail($id); // Récupérer l'utilisateur
        $user->role = 'editor'; // Changer le rôle de l'utilisateur
        $user->save(); // Sauvegarder les modifications

        return redirect()->back()->with('success', 'Rôle d\'éditeur attribué à l\'utilisateur avec succès.');
    }

    // Retirer le rôle d'éditeur d'un utilisateur
    public function removeEditorRole(Request $request, $id)
    {
        $user = User::findOrFail($id); // Récupérer l'utilisateur
        $user->role = 'subscriber'; // Changer le rôle de l'utilisateur
        $user->save(); // Sauvegarder les modifications

        return redirect()->back()->with('success', 'Rôle d\'éditeur retiré de l\'utilisateur avec succès.');
    }
}
