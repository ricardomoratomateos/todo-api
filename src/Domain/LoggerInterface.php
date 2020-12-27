<?php

namespace TodoAPI\Domain;

use TodoAPI\Domain\Todos\EventInterface;

interface LoggerInterface
{
    public function log(EventInterface $event): void;
}
