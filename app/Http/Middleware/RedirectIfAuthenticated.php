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
     * @param  string|null  $guard
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $guard = null)
    {
        Log::info('RedirectIfAuth middleware started');
        if (Auth::guard($guard)->check()) {
            $user = Auth::guard($guard)->user();
            Log::info('User is authenticated', ['user_id' => $user->id, 'role_id' => $user->role_id]);

            switch ($user->role_id) {
                case 1:
                    Log::info('Redirecting to admin dashboard');
                    return redirect()->route('admin.dashboard');
                case 2:
                    Log::info('Redirecting to admin dashboard');
                    return redirect()->route('admin.dashboard');
                case 3:
                    Log::info('Redirecting to user dashboard');
                    return redirect()->route('user.dashboard');
                default:
                    Log::warning('Unknown role ID', ['role_id' => $user->role_id]);
                    return redirect()->route('home');
            }
        } else {
            Log::info('User is not authenticated');
        }
        $response = $next($request);

        Log::info('RedirectIfAuth Headers after processing:', $response->headers->all());
        Log::info('RedirectIfAuth middleware proceeding to next middleware');
        return $next($request);
    }
}
