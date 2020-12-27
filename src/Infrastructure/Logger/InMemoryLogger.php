<?php

namespace TodoAPI\Infrastructure\Logger;

use TodoAPI\Domain\LoggerInterface;
use TodoAPI\Domain\Todos\EventInterface;

class InMemoryLogger implements LoggerInterface
{
    private $queue = [];

    /**
     * {@inheritDoc}
     */
    public function log(EventInterface $event): void
    {
        $this->queue[] = $event;
    }
}
