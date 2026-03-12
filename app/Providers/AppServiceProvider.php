<?php

namespace App\Providers;

use App\Services\QueryMonitorService;
use Illuminate\Support\ServiceProvider;
use function MongoDB\Driver\Monitoring\addSubscriber;
use App\Monitoring\MongoCommandSubscriber;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Share one monitor instance per request lifecycle.
        $this->app->singleton(QueryMonitorService::class, function () {
            return new QueryMonitorService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        addSubscriber(new MongoCommandSubscriber());
    }
}
