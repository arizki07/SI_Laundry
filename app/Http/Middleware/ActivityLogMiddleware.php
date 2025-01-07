<?php

namespace App\Http\Middleware;

use App\Models\LogsModel;
use Illuminate\Http\Request;
use Closure;

class ActivityLogMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $excludedPrefixes = ['getCategories', 'getProduk', 'getCustomer', 'getReferensi', 'getStatus', 'getSales', 'getResi', 'getLogs', 'getFaqs', 'getPemasukan'];

        foreach ($excludedPrefixes as $prefix) {
            if ($request->is("{$prefix}/*") || $request->is($prefix)) {
                return $next($request);
            }
        }
        $response = $next($request);
        $activity = $this->generateActivityDescription($request);
        LogsModel::create([
            'user_id' => auth()->check() && auth()->id() ? auth()->id() : 'Guest',
            'ip_address' => $request->ip(),
            'method' => $request->method(),
            'path' => $request->path(),
            'status' => $response->getStatusCode(),
            'activity' => $activity,
        ]);

        return $response;
    }

    private function generateActivityDescription(Request $request): string
    {
        $method = $request->method();
        if (in_array($method, ['POST', 'PUT', 'PATCH'])) {
            $payload = $request->except(['password', 'password_confirmation']);
            $data = [
                'message' => "Mengirim data ke {$request->path()} dengan payload:",
                'payload' => $payload,
            ];
            return json_encode($data, JSON_PRETTY_PRINT);
        }

        if ($method === 'DELETE') {
            return "Menghapus data di {$request->path()}";
        }

        if ($method === 'GET') {
            $queryParams = $request->query();
            return "Mengakses {$request->path()}" . (empty($queryParams) ? '' : ' dengan query: ' . json_encode($queryParams, JSON_PRETTY_PRINT));
        }

        return "Mengakses {$request->path()}";
    }
}
