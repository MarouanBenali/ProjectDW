<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\{DashboardController, ConversationController,EditorController, ArticleController, CategoryController, SubscriptionController, UserController, NotificationController, ArticleRatingController, NumeroController, CategoryRatingController};
//============================================ Routes publiques =====================================================
Route::get('/', fn() => view('Accueil'))->name('accueil.page');
Route::get('/presentation', fn() => view('Presentation'))->name('presentation');
Route::get('/categories', fn() => view('Categorie'))->name('categories');
Route::get('/login',fn()=>view('auth.login'))->name('login');

//============================================== Routes Auth ========================================================
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::get('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');
Route::middleware(['auth'])->group(function () {
    //--------Manager-----------
    Route::middleware(['manager'])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::post('/articles/{id}/reject', [ArticleController::class, 'rejectArticle'])->name('articles.reject');
        Route::post('/articles/{id}/propose', [ArticleController::class, 'proposeArticle'])->name('articles.propose');
        Route::post('/conversations/{conversationId}', [ConversationController::class, 'destroy'])->name('deleteConversation');
    });
    //----------Editor----------
    Route::middleware(['editor'])->group(function () {
        Route::get('/editor', [EditorController::class, 'index'])->name('editor.page');
        Route::post('/AddCategorie', [CategoryController::class, 'AddCat'])->name('categories.AddCat');
        Route::get('/DelCategorie/{id}', [CategoryController::class, 'destroy']);
        Route::post('/editor/articles/accept/{id}', [ArticleController::class, 'acceptArticle'])->name('acceptArticle');
        Route::post('/editor/articles/reject/{id}', [ArticleController::class, 'rejectArticle'])->name('rejectArticle');
        Route::post('/editor/numero/publish/{num}/{category_id}', [NumeroController::class, 'publishNumero'])->name('publishNumero');
        Route::post('/editor/users/ban/{id}', [UserController::class, 'DeBanUser'])->name('DeBanUser');
        Route::post('/user/{id}/assign-role', [UserController::class, 'assignRole'])->name('assignRole');
        Route::get('/AddCategorie', fn() => view('addCategory'))->name('AddCategorie');
    });
    //--------Subscriber---------
    Route::get('/subscriber', fn() => view('subscriber'))->name('subscriber');
    Route::get('/subscriber', [SubscriptionController::class, 'index'])->name('subscriber');
    //---------Add Article--------
    Route::get('/AddArticle/{categoryId}', fn($categoryId) => view('addArticle', ['categoryId' => $categoryId]))->name('AddArticle');
    
});

//============================================ Routes Category ======================================================
Route::get('/categorie-data', [CategoryController::class, 'getCategoriesData']);
Route::post('/subscribe/{categoryId}', [CategoryController::class, 'subscribe'])->name('categories.subscribe');
Route::get('/Explorer/{categoryId}', [CategoryController::class, 'showCategory'])->name('category.show');
Route::post('/CategoryRate/{id}', [CategoryRatingController::class, 'CategoryRate'])->name('CategoryRate');

//============================================ Routes Article ======================================================
Route::post('/assign-number/{article}', [NumeroController::class, 'assignNumber'])->name('assignNumber');
Route::post('/articlesRate/{articleId}', [ArticleRatingController::class, 'articlesRate'])->name('articlesRate');
Route::get('/articles/show/{id}', [ArticleController::class, 'viewArticle'])->name('viewArticle');
Route::post('/article/{id}/comment', [ArticleController::class, 'addConversation'])->name('addConversation');
Route::get('/article/{categoryId}',[ArticleController::class,'AjouterArticle'])->name('AjouterArticle');
Route::post('/storeArticle', [ArticleController::class, 'store'])->name('storeArticle');

//============================================== Routes User =============================================================
Route::get('/getInfoUser', [UserController::class, 'getInfoUser']);
Route::post('/updatePicture', [UserController::class, 'updatePicture'])->name('updatePicture');

//============================================ Routes Notification ======================================================
Route::get('/get-notifications', [NotificationController::class, 'getNotifications']);

//============================================ Routes Subscription ======================================================
Route::delete('/subscriptions/{id}', [SubscriptionController::class, 'delete'])->name('subscriptions.delete');
Route::get('/getSubscriptions', [SubscriptionController::class, 'getSubscriptions'])->name('getSubscriptions');
Route::get('/DeSabonner/{categoryId}', [SubscriptionController::class, 'DeSabonner'])->name('DeSabonner');

