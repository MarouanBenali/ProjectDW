<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Response; // Importation de la classe Response
use App\Models\Article;

class ArticleController extends Controller
{
    // Rejeter un article
    public function reject($id)
    {
        $article = Article::findOrFail($id); // Recherche de l'article par son identifiant (id)
        $article->delete(); // Suppression de l'article de la base de données

        return redirect()->back()->with('success', 'Article deleted successfully.');
    }

    // Proposer un article pour publication
    public function propose($id)
    {
        $article = Article::findOrFail($id); // Recherche de l'article par son identifiant (id)
        $article->update(['status' => 'proposed']); // Mise à jour de l'état de l'article

        return redirect()->back()->with('success', 'Article proposed for publication.');
    }

    // Télécharger l'article sous forme de fichier HTML
    public function viewArticle($id)
    {
        $article = Article::findOrFail($id); 

        // Contenu HTML de l'article
        $htmlContent = "
        <!DOCTYPE html>
        <html lang='fr'>
        <head>
            <meta charset='UTF-8'>
            <title>{$article->title}</title>
        </head>
        <body>
            <h1>{$article->title}</h1>
            <p>{$article->content}</p>
            <p><strong>Auteur:</strong> {$article->user->name}</p>
        </body>
        </html>
        ";

        // Définition du nom du fichier
        $fileName = "article_{$article->id}.html";

        // Téléchargement du fichier
        return Response::make($htmlContent, 200, [
            'Content-Type' => 'text/html',
            'Content-Disposition' => 'inline; filename="' . $fileName . '"',
            // 'Content-Disposition' => 'attachment; filename="' . $fileName . '"', possibilité de téléchargement
        ]);
    }
}
