<?php

namespace TodoAPI\Application\Todos;

use TodoAPI\Domain\Todos\TodoServiceFactory;

abstract class AbstractWriterTodosHandler
{
    protected $serviceFactory;

    public function __construct(
        TodoServiceFactory $serviceFactory
    ) {
        $this->serviceFactory = $serviceFactory;
    }
}
