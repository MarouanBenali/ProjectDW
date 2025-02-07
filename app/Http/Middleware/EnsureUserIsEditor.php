<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureUserIsEditor{
    public function handle(Request $request, Closure $next){
        if (Auth::check() && Auth::user()->role === 'editor') {
            return $next($request);
        }
        return redirect('/');
    }
}