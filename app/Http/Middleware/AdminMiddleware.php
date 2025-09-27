<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // تحقق إذا كان المستخدم مسجل دخوله وإذا كان دوره 'admin'
        if (Auth::check() && Auth::user()->role == 'admin') {
            return $next($request); // إذا كان أدمن، اسمح له بالمرور
        }

        // إذا لم يكن أدمن، أعد توجيهه للصفحة الرئيسية
        return redirect('/');
    }
}