<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        $user = Auth::user();

        if ($user) {
            switch ($user->role_id) {
                case '1':
                    return route('admin.dashboard');
                case '2':
                    return route('admin.dashboard');
                case '3':
                    return route('user.dashboard');
                default:
                    return RouteServiceProvider::HOME;
            }
        }

        return $next($request);

    }
}
