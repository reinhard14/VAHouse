<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        Log::info('Middleware IsAdmin executed');
        $SUPER_ADMIN = 1;
        $ADMIN = 2;

        if (auth()->check() && auth()->user()->role_id != $SUPER_ADMIN && auth()->user()->role_id != $ADMIN) {
            abort(403);
        }

        return $next($request);
    }
}
