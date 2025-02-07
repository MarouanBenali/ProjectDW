<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(){
        View::composer('layouts.header', function ($view) {
            $notifications = Auth::check()
                ? Notification::where('user_id', Auth::id())->get()
                : collect([]);
            $view->with('notifications', $notifications);
        });
    }
}
