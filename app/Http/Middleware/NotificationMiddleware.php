<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\LogsModel;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class NotificationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $logs = LogsModel::latest()->take(20)->get();

        view()->share('logs', $logs);

        return $next($request);
    }
}
