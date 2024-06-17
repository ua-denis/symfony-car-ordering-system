<?php

namespace App\Application\EventHandler;

use App\Domain\Event\CarProductionStartedEvent;
use Psr\Log\LoggerInterface;

class CarProductionStartedHandler
{
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function __invoke(CarProductionStartedEvent $event): void
    {
        $this->logger->info('Car production started', ['car' => $event->getCar()]);
    }
}