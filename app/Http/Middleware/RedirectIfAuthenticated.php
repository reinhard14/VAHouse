<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        Log::info('Middleware RedirectIfAuth executed');

        $guards = empty($guards) ? [null] : $guards;
        Log::info('Guards:', ['guards' => $guards]);

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                return redirect(RouteServiceProvider::HOME);
            }
            Log::info('Guard instance:', ['guard' => $guard]);
            Log::info('Authenticated user:', [
                'user' => Auth::user() ? Auth::user()->toArray() : 'No user authenticated',
            ]);

        }

        Log::info('Next request:', ['request' => $next($request)]);
        return $next($request);

    }
}
