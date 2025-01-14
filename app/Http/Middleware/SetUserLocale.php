<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class SetUserLocale
{
    public function handle($request, Closure $next)
    {
        // Vérifie si l'utilisateur est connecté
        if (Auth::check()) {
            $language = Auth::user()->language ?? config('app.locale');
            App::setLocale($language);
        }

        return $next($request);
    }
}
