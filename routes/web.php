<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EditorController;
use App\Http\Controllers\ArticleController;

// الصفحة الرئيسية (Accueil)
Route::get('/', function () {
    return view('Accueil');
})->name('accueil.page');

// صفحة العرض التقديمي
Route::get('/presentation', function () {
    return view('Presentation');
})->name('presentation');

// صفحة الفئات
Route::get('/categories', function () {
    return view('Categorie');
})->name('categories');

//////////////////////////////////////////////////////////////////////////////////////////
//------------------les categories ------------------------------
Route::get('/categories/ia', function () {
    return view('Category.IA');
})->name('categories.ia');

Route::get('/categories/iot', function () {
    return view('Category.IoT');
})->name('categories.iot');

Route::get('/categories/cyber', function () {
    return view('Category.Cyber');
})->name('categories.cyber');

Route::get('/categories/vr', function () {
    return view('Category.VR');
})->name('categories.vr');

Route::get('/categories/ar', function () {
    return view('Category.AR');
})->name('categories.ar');

Route::get('/categories/blockchain', function () {
    return view('Category.Blockchain');
})->name('categories.blockchain');

Route::get('/categories/5g', function () {
    return view('Category.R5G');
})->name('categories.5g');

Route::get('/categories/robot', function () {
    return view('Category.robot');
})->name('categories.robot');

//////////////////////////////////////////**CategoryController////////////////////////////////////////////

use App\Http\Controllers\CategoryController;

Route::get('/categorie-data', [CategoryController::class, 'getCategoriesData']);

//تقييم فئة 
Route::post('/categories/{categoryId}/rate', [CategoryController::class, 'store'])->name('categories.rate');
/*<form method="POST" action="{{ route('categories.rate', $categoryId) }}">
    @csrf
    <label for="rating">تقييم:</label>
    <input type="number" name="rating" min="1" max="5" required>
    <button type="submit">إضافة التقييم</button>
</form>
 */

// Routes للمقالات
Route::prefix('articles')->group(function () {
    Route::post('/{id}/reject', [ArticleController::class, 'reject'])->name('articles.reject');
    Route::post('/{id}/propose', [ArticleController::class, 'propose'])->name('articles.propose');
});

//////////////////////////////////////////////////////////////////////////////////////

// Route لتسجيل الدخول (GET)
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// Routes للمصادقة (Authentication)
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
// Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

use Illuminate\Support\Facades\Auth;

Route::get('/logout', function () {
    Auth::logout();
    return redirect('/login')->with('success', 'Vous êtes déconnecté.');
})->name('logout');


// Routes محمية بالـ middleware 'auth'
Route::middleware(['auth'])->group(function () {
    // Route للمشرفين (Managers)
    Route::middleware(['manager'])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    });

    // Route للمحررين (Editors)
    Route::middleware(['editor'])->group(function () {
        Route::get('/editor', [EditorController::class, 'index'])->name('editor.page');
    });
});

use App\Http\Controllers\SubscriptionController;
// Routes pour les abonnements
Route::prefix('subscriptions')->group(function () {
    Route::delete('/{id}', [SubscriptionController::class, 'delete'])->name('subscriptions.delete');
});


use App\Http\Controllers\MessageController;

Route::prefix('messages')->group(function () {
    Route::delete('/{id}', [MessageController::class, 'delete'])->name('messages.delete');
});

/////////////////////////////////     editeur     ///////////////////////////////////////////
// Routes للمحررين (Editors)
Route::middleware(['auth', 'editor'])->group(function () {
    Route::get('/editor', [EditorController::class, 'index'])->name('editor.page');
    Route::post('/editor/articles/accept/{id}', [EditorController::class, 'acceptArticle'])->name('editor.articles.accept');
    Route::post('/editor/articles/reject/{id}', [EditorController::class, 'rejectArticle'])->name('editor.articles.reject');
    Route::post('/editor/issues/publish/{id}', [EditorController::class, 'publishIssue'])->name('editor.issues.publish');
    Route::post('/editor/issues/unpublish/{id}', [EditorController::class, 'unpublishIssue'])->name('editor.issues.unpublish');
    Route::post('/editor/users/ban/{id}', [EditorController::class, 'banUser'])->name('editor.users.ban');
    Route::post('/editor/users/unban/{id}', [EditorController::class, 'unbanUser'])->name('editor.users.unban');
    Route::post('/editor/users/assign-editor/{id}', [EditorController::class, 'assignEditorRole'])->name('editor.users.assign-editor');
    Route::post('/editor/users/remove-editor/{id}', [EditorController::class, 'removeEditorRole'])->name('editor.users.remove-editor');
});
//////////////////////////////////////////////
Route::get('/article/{id}', [ArticleController::class, 'viewArticle'])->name('article.view');


////////////////*img profile :
use App\Http\Controllers\UserController;
Route::get('/photoProfil', [UserController::class, 'getProfilePicture']);

/////////////////////////////////////////////////////////////////////////////////
use App\Http\Controllers\NotificationController;
Route::get('/get-notifications', [NotificationController::class, 'getNotifications']);
