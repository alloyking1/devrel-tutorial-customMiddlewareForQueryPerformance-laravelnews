<?php

namespace App\Providers;

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
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        addSubscriber(new MongoCommandSubscriber());
    }
}
