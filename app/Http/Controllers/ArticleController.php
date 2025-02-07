<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{History, Content, Notification, Article, CategoryManager};
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'intro' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'subtitles' => 'required|array|min:1',
            'subtitles.*' => 'required|string',
            'contents' => 'required|array|min:1',
            'contents.*' => 'required|string|min:100',
        ]);

        $imagePath = $request->file('image')->store('Article', 'public');

        $article = Article::create([
            'user_id' => Auth::id(),
            'category_id' => $request->categoryId,
            'intro' => $request->intro,
            'image' => $imagePath,
            'title' => $request->title,
        ]);

        foreach ($request->subtitles as $index => $subtitle) {
            Content::create([
                'article_id' => $article->id,
                'subtitle' => $subtitle,
                'content' => $request->contents[$index],
            ]);
        }

        return redirect()->route('subscriber');
    }

    // Rejeter un article
    public function rejectArticle($id)
    {
        $article = Article::findOrFail($id);
        $article->delete();
        $this->sendNotification($article->user_id, 'Votre article a été refuser : ' . $article->title);
        return redirect()->back();
    }

    // Proposer un article pour publication
    public function proposeArticle($id)
    {
        $article = Article::findOrFail($id); // Recherche de l'article par son identifiant (id)
        $article->update(['status' => 'Retenu']); // Mise à jour de l'état de l'article
        $this->sendNotification($article->user_id, 'Votre article a été propose a editeur : ' . $article->title);
        return redirect()->back();
    }

    public function acceptArticle(Request $request, $id)
    {
        $article = Article::findOrFail($id); // Récupérer l'article
        $article->status = 'Publie'; // Changer le statut de l'article
        $article->numero = $request->numero;
        $article->save(); // Sauvegarder les modifications
        $this->sendNotification($article->user_id, 'Votre article a été accepté : ' . $article->title);
        return redirect()->back();
    }

    public function ArticleAccess($articleId)
    {
        $article = Article::findOrFail($articleId);
        $article->access = $article->access === 'public' ? 'private' : 'public';
        $article->save();
        return redirect()->back();
    }

    public function ArticleActivation($articleId)
    {
        $article = Article::findOrFail($articleId);
        $article->activation = $article->activation === 'active' ? 'inactive' : 'active';
        $article->save();
        return back();
    }

    // Télécharger l'article sous forme de fichier HTML
    public function viewArticle($id)
    {
        $article = Article::with(['user', 'contents', 'conversations.user'])->findOrFail($id);
        $userRating = auth()->check() ? $article->ratings()->where('user_id', auth()->id())->value('rating') : null;
        $MoyRating = $article->ratings()->avg('rating'); // Calcul du rating moyen
        $ratingsCount = $article->ratings()->count(); // Nombre de notes
        $categoryManager = CategoryManager::where('category_id', $article->category_id)
            ->where('user_id', Auth::id())
            ->first();
        if (Auth::user()) {
            $history = History::updateOrCreate(
                [
                    'user_id' => Auth::id(),
                    'article_id' => $article->id,
                ]
            );
            $history->touch();
            $history->save();
        }

        return view('Article', [
            'article' => $article,
            'userRating' => $userRating,
            'MoyRating' => $MoyRating,
            'ratingsCount' => $ratingsCount,
            'categoryManager' => $categoryManager
        ]);
    }


    public function addConversation(Request $request, $articleId)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        $article = Article::findOrFail($articleId);

        // Ajouter une nouvelle conversation
        $article->conversations()->create([
            'user_id' => auth()->id(),
            'content' => $request->content,
        ]);
        return redirect()->route('viewArticle', ['id' => $articleId]);
    }
    public function sendNotification($userId, $message)
    {
        Notification::create([
            'user_id' => $userId,
            'message' => $message,
            'type' => 'admin',
        ]);
    }
}
