<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CategoryRating;

use Illuminate\Support\Facades\Auth;

class CategoryRatingController extends Controller
{
    public function CategoryRate(Request $request, $CategoryId){ 
        $existingRating = CategoryRating::where('user_id', Auth::id())
            ->where('category_id', $CategoryId)
            ->first();

        if ($existingRating) {
            $existingRating->update(['rating' => $request->rating]);
        } else {
            CategoryRating::create([
                'user_id' => Auth::id(),
                'category_id' => $CategoryId,
                'rating' => $request->rating,
            ]);
        }

        return back();
    }
}
