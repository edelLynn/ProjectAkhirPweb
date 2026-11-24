<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Pemakaian di route: ->middleware('role:admin') atau 'role:admin,mahasiswa'
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $user = $request->user();

        // Belum login, atau role tidak termasuk yang diizinkan -> 403 Forbidden
        abort_unless($user && in_array($user->role, $roles, true), 403);

        return $next($request);
    }
}
