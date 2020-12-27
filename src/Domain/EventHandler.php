<?php

namespace TodoAPI\Domain;

use TodoAPI\Domain\Todos\EventInterface;

class EventHandler
{
    private static $logger = null;

    private function __construct()
    {
    }

    public static function handle(EventInterface $event): void
    {
        if (self::$logger) {
            self::$logger->log($event);
        }
    }

    public static function setLogger(LoggerInterface $logger)
    {
        self::$logger = $logger;
    }
}
