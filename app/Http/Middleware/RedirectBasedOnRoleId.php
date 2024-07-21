<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RedirectBasedOnRoleId
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
        Log::info('Middleware RedirectBasedOnRoleId executed');
        if (Auth::check()) {
            $user = Auth::user();

            switch ($user->role_id) {
                case 1:
                case 2:
                    return redirect()->route('admin.dashboard');
                case 3:
                    return redirect()->route('user.dashboard');
            }
        }
        $response = $next($request);
        Log::info('RedirectBasedOnRoleId Middleware RedirectBasedOnRoleId go Next');
        Log::info('Headers after processing:', $response->headers->all());
        return $next($request);
    }
}
