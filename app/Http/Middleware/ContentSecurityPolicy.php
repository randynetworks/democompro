<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ContentSecurityPolicy
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Tambahkan header Content Security Policy
        $response->headers->set('Content-Security-Policy', "default-src 'self'; script-src 'self' https://trusted.cdn.com; style-src 'self' 'unsafe-inline';");

        return $response;
    }
}
