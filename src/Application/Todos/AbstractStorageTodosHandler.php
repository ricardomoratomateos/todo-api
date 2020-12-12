<?php
namespace TodoAPI\Application\Todos;

use TodoAPI\Domain\Todos\ITodosStorage;

abstract class AbstractStorageTodosHandler
{
    /** @var ITodosStorage $storage */
    protected $storage;

    public function __construct(ITodosStorage $storage)
    {
        $this->storage = $storage;
    }
}
