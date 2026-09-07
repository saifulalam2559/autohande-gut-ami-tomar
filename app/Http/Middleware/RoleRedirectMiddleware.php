<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleRedirectMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if ($user && $user->status === 'active' && in_array($user->role, ['admin', 'customer', 'seller'])) {
            // Get the current route name
            $currentRoute = $request->route()->getName();

            // Define dashboard routes
            $dashboardRoutes = [
                'admin' => 'admin.dashboard',
                'seller' => 'seller.dashboard',
                'customer' => 'customer.dashboard',
            ];

            // List of routes that require redirection (e.g., home page)
            $publicRoutes = [ 'login', 'fronthome'];

            // Redirect only if the user is on a public route, not on their dashboard or other pages
            if (in_array($currentRoute, $publicRoutes) && isset($dashboardRoutes[$user->role])) {
                return redirect()->route($dashboardRoutes[$user->role]);
            }

            return $next($request); // Allow access to other pages inside the dashboard
        }

        // If user doesn't meet conditions, log them out and redirect to home
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('logout')->with('error', 'Access denied. Please log in again.');
    }
}
