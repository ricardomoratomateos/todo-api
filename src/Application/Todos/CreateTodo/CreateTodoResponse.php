<?php

namespace TodoAPI\Application\Todos\CreateTodo;

class CreateTodoResponse
{
    /** @var bool $wasCreated */
    private $wasCreated;

    public function __construct(bool $wasCreated)
    {
        $this->wasCreated = $wasCreated;
    }

    public function wasCreated(): bool
    {
        return $this->wasCreated;
    }
}
