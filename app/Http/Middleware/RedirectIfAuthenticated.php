<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, ...$guards)
    {
        // Якщо користувач вже залогінений
        if (Auth::check()) {
            if (Auth::user()->is_admin) {
                return redirect('/admin');
            } else {
                return redirect('/dashboard');
            }
        }
        return $next($request);
    }
}
