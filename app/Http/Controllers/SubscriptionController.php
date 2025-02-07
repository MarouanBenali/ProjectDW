<?php
namespace App\Http\Controllers;
use App\Models\Subscription;
use App\Models\History;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller{
    public function index()
    {
        $subscriptions = Auth::user()->subscriptions;
        $userHistory = Auth::user()->history;

        $subscriptionsData = $subscriptions->map(function ($subscription) {
            return (object) [
                'category_id' => $subscription->category_id,
                'category_name' => $subscription->category->name,
                'category_description' => $subscription->category->description,
                'category_image' => asset('storage/' . $subscription->category->image),
                'bgImg' => asset('storage/' . $subscription->category->bgImg),
                'AvgRating' => $subscription->category->ratings->avg('rating'),
            ];
        });

        $userHistory = History::where('user_id', Auth::id())
            ->orderBy('updated_at', 'desc')->get();

        $historyData = $userHistory->map(function ($history) {
            return (object) [
                'article' => $history->article,
                'action' => $history->action,
                'article_title' => $history->article->title,
            ];
        });

        $articlesWeek = Article::whereIn('category_id', $subscriptions->pluck('category_id'))
            ->whereBetween('created_at', [now()->subWeek(), now()])->get();

        return view('subscriber', [
            'subscriptions' => $subscriptionsData,
            'history' => $historyData,
            'articleWeek'=> $articlesWeek,
        ]);
    }



    public function getSubscriptions()
    {
        $user = auth()->user();
        if (!$user) {
            return response()->json([]);
        }

        $subscriptions = $user->subscriptions->pluck('category_id');
        return response()->json($subscriptions);
    }


    // Supprimer un abonnement
    public function delete($id)
    {
        $subscription = Subscription::findOrFail($id);
        $subscription->delete();
        return redirect()->back()->with('success', 'Abonnement supprimé avec succès.');
    }

    public function DeSabonner($categoryId)
    {
        $user = auth()->user();
        if (!$user) {
            return redirect()->route('login');
        }

        $subscription = Subscription::where('user_id', $user->id)
            ->where('category_id', $categoryId)->first();

        if ($subscription) {
            $subscription->delete();
        } else {
            Subscription::create([
                'user_id' => $user->id,
                'category_id' => $categoryId,
            ]);
        }
        return redirect()->back();
    }
}
