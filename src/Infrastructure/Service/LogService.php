<?php

namespace App\Infrastructure\Service;

use App\Contracts\Service\LogServiceInterface;
use Psr\Log\LoggerInterface;

class LogService implements LogServiceInterface
{
    private static ?LogService $instance = null;
    private LoggerInterface $logger;

    private function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public static function getInstance(LoggerInterface $logger): LogService
    {
        if (self::$instance === null) {
            self::$instance = new LogService($logger);
        }

        return self::$instance;
    }

    public function info(string $message, array $context = []): void
    {
        $this->logger->info($message, $context);
    }

    public function error(string $message, array $context = []): void
    {
        $this->logger->error($message, $context);
    }
}