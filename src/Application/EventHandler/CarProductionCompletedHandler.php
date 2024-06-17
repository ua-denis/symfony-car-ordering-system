<?php

namespace App\Application\EventHandler;

use App\Domain\Event\CarProductionCompletedEvent;
use Psr\Log\LoggerInterface;

class CarProductionCompletedHandler
{
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function __invoke(CarProductionCompletedEvent $event): void
    {
        $this->logger->info('Car production completed', ['car' => $event->getCar()]);
    }
}