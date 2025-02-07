<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ArticleRating;
use App\Models\History;
use Illuminate\Support\Facades\Auth;

class ArticleRatingController extends Controller
{
    public function articlesRate(Request $request, $articleId)
    {
        $existingRating = ArticleRating::where('user_id', Auth::id())
            ->where('article_id', $articleId)
            ->first();

        if ($existingRating) {
            $existingRating->update(['rating' => $request->rating]);
        } else {
            ArticleRating::create([
                'user_id' => Auth::id(),
                'article_id' => $articleId,
                'rating' => $request->rating,
            ]);
        }

        return back();
    }
}
