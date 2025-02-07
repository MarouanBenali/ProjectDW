<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Subscription;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller{
    public function AddCat(Request $request)
    {
        // Validating the input
        $validated = $request->validate([
            'name' => 'required|min:5|max:25',
            'description' => 'required|min:20|max:100',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'bgImg' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        // Storing the image
        $imagePath = $request->file('image')->store('categories', 'public');
        $hoverImgPath = $request->file('bgImg')->store('categories', 'public');

        // Creating the category
        $category = Category::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'image' => $imagePath,
            'bgImg' => $hoverImgPath,
        ]);

        // Redirect to the category list or show page
        return redirect()->route('categories', $category->id);
    }

    public function getCategoriesData(){
        // Récupérer toutes les catégories avec les articles, évaluations, et statistiques
        $categories = Category::all();
        // Créer un tableau des données à renvoyer à l'interface utilisateur
        $categoriesData = $categories->map(function ($category) {
            // Calcul de la moyenne des évaluations pour la catégorie
            $totalRatings = $category->ratings->count(); // Nombre total d'évaluations
            $averageRating = $totalRatings > 0 ? $category->ratings->avg('rating') : 0; // Calcul de la moyenne des évaluations

            // Calcul du nombre d'articles dans la catégorie
            $totalArticles = $category->articles->count();

            // Nombre de subscription de la catégorie
            $sup = $category->subscriptions->count();

            return [
                'id' => $category->id,
                'name' => $category->name, // Nom de la catégorie
                'description' => $category->description, // Description de la catégorie
                'image' => 'storage/' . $category->image, // Image de la catégorie
                'bgImg' => 'storage/' . $category->bgImg, // Image de fond de la catégorie
                'rating' => $averageRating, // Moyenne des évaluations
                'totalRatings' => $totalRatings, // Nombre total d'évaluations
                'articles' => $totalArticles, // Nombre d'articles
                'subscriptions' => $sup,
            ];
        });

        // Retourner les données au format JSON
        return response()->json($categoriesData);
    }

    

    public function destroy($id)
    {
        $category = Category::find($id);
        if ($category) {
            $category->delete();
        }
        return redirect()->route('categories');
    }

    public function subscribe($categoryId)
    {
        $user = auth()->user(); // Récupérer l'utilisateur authentifié
        if (!$user) {
            return redirect()->route('login')->with('error', 'Vous devez être connecté pour vous abonner à une catégorie.');
        }

        // Vérifier si l'utilisateur est déjà abonné
        $subscription = Subscription::where('user_id', $user->id)
            ->where('category_id', $categoryId)
            ->first();

        if (!$subscription) {
            Subscription::create([
                'user_id' => $user->id,
                'category_id' => $categoryId,
            ]);
        } else {
            $subscription->delete();
        }
        return redirect()->route('categories');
    }

    public function showCategory($categoryId)
    {
        $user = Auth::user();
        $category = Category::with(['articles' => function ($query) {
            $query->where('status', 'Publie')
                  ->where('numero_published', 'published');
        }])->findOrFail($categoryId);

        // Vérification de l'authentification et récupération de l'évaluation de l'utilisateur
        $userRating = auth()->check() ? $category->ratings()->where('user_id', auth()->id())->value('rating') : null;

        // Calcul de l'évaluation moyenne et du nombre de notes
        $MoyRating = $category->ratings()->avg('rating'); // Calcul du rating moyen
        $ratingsCount = $category->ratings()->count(); // Nombre de notes

        return view('Explorer', compact('category', 'user', 'userRating'));
    }


}
