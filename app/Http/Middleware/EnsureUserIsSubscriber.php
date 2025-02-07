<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureUserIsSubscriber
{
    public function handle(Request $request, Closure $next){
        if (Auth::check() && Auth::user()->role === 'subscriber') {
            return $next($request);
        }
        return redirect('/');
    }
}
