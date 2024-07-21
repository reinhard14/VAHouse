<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
        Log::info('IsAdmin middleware');
        Log::info('IsAdmin Headers before processing:', $response->headers->all());
        $SUPER_ADMIN = 1;
        $ADMIN = 2;

        if (auth()->check() && auth()->user()->role_id != $SUPER_ADMIN && auth()->user()->role_id != $ADMIN) {
            abort(403);
        }
        $response = $next($request);
        Log::info('IsAdmin Headers after processing:', $response->headers->all());
        Log::info('go next.');
        return $next($request);
    }
}
