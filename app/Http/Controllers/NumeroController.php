<?php
namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class NumeroController extends Controller{

    public function publishNumero($num, $category_id)
    {
        $newStatus = Article::where('numero', $num)
                          ->where('category_id', $category_id)
                          ->first()->numero_published == 'unpublished' ? 'published' : 'unpublished';
    
        Article::where('numero', $num)
               ->where('category_id', $category_id)
               ->update(['numero_published' => $newStatus]);
    
        return redirect()->back();
    }

    public function assignNumber(Request $request, $articleId)
    {
        $article = Article::find($articleId);
        $article->numero_id = $request->numero;  
        $article->save();
    
        return redirect()->back();
    }
    
}
?>