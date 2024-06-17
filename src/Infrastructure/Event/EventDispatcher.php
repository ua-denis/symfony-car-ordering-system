<?php

namespace App\Infrastructure\Event;

use App\Contracts\Event\EventDispatcherInterface;
use App\Domain\Event\Event;
use Psr\Log\LoggerInterface;

class EventDispatcher implements EventDispatcherInterface
{
    private LoggerInterface $logger;
    private array $handlers = [];

    public function __construct(LoggerInterface $logger, array $handlers)
    {
        $this->logger = $logger;
        $this->handlers = $handlers;
    }

    public function dispatch(Event $event): void
    {
        $eventName = get_class($event);
        if (isset($this->handlers[$eventName])) {
            foreach ($this->handlers[$eventName] as $handler) {
                $handler($event);
            }
        }

        $this->logger->info('Event dispatched', ['event' => $eventName]);
    }
}