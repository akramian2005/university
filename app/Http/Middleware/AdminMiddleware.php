<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if (!$user || !$user->is_admin) {
            // Если не админ, можно перенаправить или выбросить 403
            abort(403, 'Unauthorized.');
        }

        return $next($request);
    }
}
