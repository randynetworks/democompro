<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Ambil locale dari localStorage jika ada
        if ($request->hasHeader('x-locale')) {
            $locale = $request->header('x-locale');
            app()->setLocale($locale);
        } else {
            // Ambil locale dari session atau default dari env jika tidak ada
            $locale = session()->get('locale', config('app.locale'));

            // ambil dari env aja
            // $locale = config('app.locale');
            app()->setLocale($locale);
        }

        return $next($request);
    }
}
