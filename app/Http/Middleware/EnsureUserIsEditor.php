<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureUserIsEditor
{
    public function handle(Request $request, Closure $next)
    {
        // التحقق من أن المستخدم مسجل الدخول وأن لديه دور "editor"
        if (Auth::check() && Auth::user()->role === 'editor') {
            return $next($request);
        }

        // إذا لم يكن المستخدم محررًا، قم بإعادة توجيهه إلى الصفحة الرئيسية مع رسالة خطأ
        return redirect('/')->with('error', 'Vous n\'avez pas accès à cette section.');
    }
}