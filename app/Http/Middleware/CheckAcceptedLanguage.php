<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAcceptedLanguage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->session()->has('locale')) {
            // If locale is already set in session, do nothing.
            return $next($request);
        }

        $availableLocales = config('app.locales', []);
        $appLocale = config('app.locale');
        $acceptLanguage = $request->header('Accept-Language');

        $preferredLanguage = null;
        if ($acceptLanguage) {
            $preferredLanguage = explode('-', explode(',', $acceptLanguage)[0])[0];
        }

        // If `Accept-Language` is set and its primary value *is* present in `config('app.locales')` (but *not* `config('app.locale')`)
        if ($preferredLanguage && array_key_exists($preferredLanguage, $availableLocales) && $preferredLanguage !== $appLocale) {
            $request->session()->put('suggested_locale', $preferredLanguage);
        } else if (!$request->session()->has('suggested_locale')) {
            // If `Accept-Language` is not set, or if it's set but its primary value is *not* `config('app.locale')`, and it's *not* present in `config('app.locales')`
            $request->session()->put('locale', $appLocale);
        }

        return $next($request);
    }
}