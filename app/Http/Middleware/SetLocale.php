<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    public function handle(Request $request, Closure $next): Response
    {
        $supportedLocales = config('app.supported_locales', ['en']);
        $sessionLocale = $request->session()->get('locale', config('app.locale'));
        $locale = in_array($sessionLocale, $supportedLocales, true)
            ? $sessionLocale
            : config('app.locale');

        app()->setLocale($locale);

        return $next($request);
    }
}
