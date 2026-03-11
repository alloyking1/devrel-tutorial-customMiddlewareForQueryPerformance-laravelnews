<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Services\QueryMonitorService;

class PerformanceMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $start = microtime(true);
        $response = $next($request);
        $requestDuration = (microtime(true) - $start) * 1000;

        $monitor = app(QueryMonitorService::class);

        $route = optional($request->route())->getName() ?? 'unknown';
        $monitor->persist($route, $requestDuration);

        return $response;
    }
}
