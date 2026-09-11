<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        
        if (auth()->check() && auth()->user()->is_admin == 0) {
            return $next($request);
        }

        return redirect('/')->with('error', 'شما مدیر هستید و به صفحات شخصی کاربران عادی دسترسی ندارید.');
    }
}