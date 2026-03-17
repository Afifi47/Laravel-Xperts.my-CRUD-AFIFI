<?php
// app/Http/Middleware/SecurityHeadersMiddleware.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * SecurityHeadersMiddleware
 *
 * Adds security-related HTTP headers to all responses.
 * Protects against:
 * - Clickjacking (X-Frame-Options)
 * - MIME-type sniffing (X-Content-Type-Options)
 * - XSS attacks (X-XSS-Protection, legacy browser support)
 * - Referrer leakage (Referrer-Policy)
 */
class SecurityHeadersMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Prevent clickjacking — page cannot be embedded in iframes
        $response->headers->set('X-Frame-Options', 'DENY');

        // Prevent MIME-type sniffing — browser must respect Content-Type
        $response->headers->set('X-Content-Type-Options', 'nosniff');

        // Legacy XSS filter for older browsers
        $response->headers->set('X-XSS-Protection', '1; mode=block');

        // Control how much referrer info is sent with requests
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');

        // Prevent browsers from caching sensitive pages
        $response->headers->set('X-Permitted-Cross-Domain-Policies', 'none');

        return $response;
    }
}
