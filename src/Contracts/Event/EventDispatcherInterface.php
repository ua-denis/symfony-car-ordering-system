<?php

namespace App\Contracts\Event;

use App\Domain\Event\Event;

interface EventDispatcherInterface
{
    public function dispatch(Event $event): void;
}