<?php

namespace App\Services;

use App\Models\PerformanceLog;

class QueryMonitorService
{
    protected array $queries = [];
    protected int $slowThreshold = 200; // ms

    public function record(string $collection, string $operation, float $duration): void
    {
        $this->queries[] = [
            'collection' => $collection,
            'operation' => $operation,
            'duration_ms' => $duration,
            'is_slow' => $duration > $this->slowThreshold
        ];
    }

    public function persist(string $route, float $requestDuration): void
    {
        foreach ($this->queries as $query) {
            PerformanceLog::create([
                'route' => $route,
                'collection' => $query['collection'],
                'operation' => $query['operation'],
                'duration_ms' => $query['duration_ms'],
                'request_duration' => $requestDuration,
                'is_slow' => $query['is_slow'],
                'created_at' => now()
            ]);
        }
    }
}