<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\User;
use App\Models\Notification;

class EditorController extends Controller{
    public function index(){
        // Récupérer les articles proposés pour la publication
        $proposedArticles = Article::where('status', 'Retenu')->get();
        $users = User::all(); 
        $numeros = Article::select('category_id', 'numero', 'numero_published')
            ->groupBy('category_id', 'numero', 'numero_published')
            ->orderBy('category_id', 'asc')
            ->orderBy('numero', 'asc')
            ->get();
            
        return view('editor', compact(
            'proposedArticles',
            'numeros',
            'users',
        ));
    }
}
