<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthorizeUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  mixed  ...$roles
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $user = $request->user(); // Get the authenticated user

        if (!$user) {
            abort(403, 'Unauthorized. Kamu perlu login untuk mengakses halaman ini.');
        }

        $user_role = $user->getRole(); // Get the user's role

        // Check if the user's role is in the allowed roles
        if (in_array($user_role, $roles)) {
            return $next($request); // Continue the request if authorized
        }

        // If the user doesn't have a valid role, show a 403 error
        abort(403, 'Forbidden. Kamu tidak punya akses ke halaman ini');
    }
}
