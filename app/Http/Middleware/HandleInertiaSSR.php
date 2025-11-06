<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Symfony\Component\HttpFoundation\Response;

class HandleInertiaSSR
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Only enable SSR for specific routes that need SEO
        $ssrRoutes = [
            'home',
            'home.mobile',
            'legacy',
            'rsvp.create',
            'rsvp.confirmation',
        ];

        if ($request->route() && in_array($request->route()->getName(), $ssrRoutes)) {
            // Enable SSR for these routes
            Inertia::setRootView('wedding');

            // Force SSR for better SEO in all environments
            Inertia::share('ssr', true);

            // Ensure SSR is enabled in config
            config(['inertia.ssr.enabled' => true]);
        }

        return $next($request);
    }
}
