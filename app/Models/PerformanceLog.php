<?php

namespace App\Models;
use MongoDB\Laravel\Eloquent\Model;

class PerformanceLog extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'performance_logs';

    protected $fillable = [
        'route',
        'collection',
        'operation',
        'duration_ms',
        'request_duration',
        'is_slow',
        'created_at'
    ];
}
