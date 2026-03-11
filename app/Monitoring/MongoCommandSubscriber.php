<?php

namespace App\Monitoring;

use MongoDB\Driver\Monitoring\CommandSubscriber;
use MongoDB\Driver\Monitoring\CommandStartedEvent;
use MongoDB\Driver\Monitoring\CommandSucceededEvent;
use MongoDB\Driver\Monitoring\CommandFailedEvent;
use App\Services\QueryMonitorService;

class MongoCommandSubscriber implements CommandSubscriber
{
    protected array $startTimes = [];

    public function commandStarted(CommandStartedEvent $event): void
    {
        $this->startTimes[$event->getRequestId()] = microtime(true);
    }

    public function commandSucceeded(CommandSucceededEvent $event): void
    {
        $requestId = $event->getRequestId();

        if (!isset($this->startTimes[$requestId])) {
            return;
        }

        $duration = (microtime(true) - $this->startTimes[$requestId]) * 1000;

        $command = $event->getCommandName();
        $database = $event->getDatabaseName();

        $monitor = app(QueryMonitorService::class);

        $monitor->record(
            $database,
            $command,
            $duration
        );

        unset($this->startTimes[$requestId]);
    }

    public function commandFailed(CommandFailedEvent $event): void
    {
        // Clean up tracked start time when a MongoDB command fails.
        unset($this->startTimes[$event->getRequestId()]);
    }
}