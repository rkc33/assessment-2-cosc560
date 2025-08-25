<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminOnly
{
    public function handle(Request $request, Closure $next): Response
    {
        // If you added an is_admin column (recommended, see step 3)
        if (auth()->check() && auth()->user()->is_admin) {
            return $next($request);
        }

        // Fallback: allow the seeded admin by email if you didn’t add is_admin yet
        if (auth()->check() && auth()->user()->email === 'admin@example.com') {
            return $next($request);
        }

        abort(403, 'Only admin can access this area.');
    }
}
